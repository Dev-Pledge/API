<?php

namespace DevPledge\Integrations\Curl;

/**
 * Class CurlRequest
 * @package DevPledge\Integrations\Curl
 */
class CurlRequest {
	/**
	 * @var null | string  | bool
	 */
	protected $response;

	protected $userPassword;

	protected $password;

	protected $headersInResponse = false;

	protected $sslVersion;
	/**
	 * @var array
	 */
	protected $receivedHeaders = array();
	/**
	 * @var bool
	 */
	protected $jsonEncodeData = false;
	/**
	 * @var bool
	 */
	protected $httpCode;
	/**
	 * @var int
	 */
	protected $error = 0;
	/**
	 * @var bool
	 */
	protected $httpCodeSuccess;

	/**
	 * @var bool
	 */
	protected $httpCodeError;
	/**
	 * cookie save path
	 * @var string
	 */
	protected $cookies = 'generic';
	/**
	 * @var bool
	 */
	protected $useCookies = false;
	/**
	 * @var array
	 */
	protected $headers = array( "Content-type: multipart/form-data" );
	/**
	 * @var bool
	 */
	protected $post = true;
	/**
	 * @var string | null
	 */
	protected $method;
	/**
	 * @var bool
	 */
	protected $binary = false;
	/**
	 * @var string
	 */
	protected $url;
	/**
	 * @var array
	 */
	protected $data = array();
	/**
	 * @var int
	 */
	protected $initCount = 0;
	/**
	 * @var \Exception | null
	 */
	protected $httpCodeErrorException;
	/**
	 * @var \Closure | null
	 */
	protected $handleAnyErrorFunction;

	protected $curlCallbacks = array();


	public function __construct( $url, $data = array(), $init = false ) {
		$this->setUrl( $url )->setData( $data );
		if ( $init ) {
			$this->init();
		}
	}

	/**
	 * @param \Closure $callback
	 *
	 * @return $this
	 */
	public function addCurlCallback( \Closure $callback ) {
		$this->curlCallbacks[] = $callback;

		return $this;
	}

	/**
	 * @param $ch
	 *
	 * @return $this
	 */
	protected function doCurlCallbacks( $ch ) {
		if ( count( $this->curlCallbacks ) ) {
			foreach ( $this->curlCallbacks as $callback ) {
				if ( is_callable( $callback ) ) {
					call_user_func_array( $callback, array( $ch, $this ) );
				}
			}
		}

		return $this;
	}

	/**
	 * @return CurlRequest
	 */
	public function patch() {
		return $this->setMethod( 'PATCH' );
	}

	/**
	 * @return CurlRequest
	 */
	public function put() {
		return $this->setMethod( 'PUT' );
	}

	/**
	 * @return CurlRequest
	 */
	public function delete() {
		return $this->setMethod( 'DELETE' );
	}

	/**
	 * @return CurlRequest
	 */
	public function get() {
		return $this->setMethod( 'GET' );
	}

	/**
	 * @return CurlRequest
	 */
	public function post() {
		return $this->setMethod( 'POST' );
	}

	public function init() {
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $this->getUrl() );
		if ( count( $this->getData() ) && $this->isPost() ) {
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $this->getData() );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
			if ( $sslVersion = $this->getSslVersion() ) {
				curl_setopt( $ch, CURLOPT_SSLVERSION, $sslVersion );
			}
			curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		} elseif ( count( $this->getData() ) && strpos( $this->getUrl(), '?' ) === false ) {
			if ( ! $this->isJsonEncodeData() ) {
				curl_setopt( $ch, CURLOPT_URL, $this->getUrl() . '?' . http_build_query( $this->getData() ) );
			}
		} elseif ( count( $this->getData() ) ) {
			if ( ! $this->isJsonEncodeData() ) {
				curl_setopt( $ch, CURLOPT_URL, $this->getUrl() . '&' . http_build_query( $this->getData() ) );
			}
		}
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

		curl_setopt( $ch, CURLOPT_HTTPHEADER, $this->getHeaders() );

		if ( $this->isBinary() ) {
			curl_setopt( $ch, CURLOPT_BINARYTRANSFER, 1 );
		}
		if ( $method = $this->getMethod() ) {
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method );
		}
		$receivedHeaders = array();
		curl_setopt( $ch, CURLOPT_HEADERFUNCTION, function ( $ch, $header ) use ( &$receivedHeaders ) {
			$len    = strlen( $header );
			$header = explode( ':', $header, 2 );
			if ( count( $header ) < 2 ) { // ignore invalid headers
				return $len;
			}
			$name = strtolower( trim( $header[0] ) );
			if ( ! array_key_exists( $name, $receivedHeaders ) ) {
				$receivedHeaders[ $name ] = [ trim( $header[1] ) ];
			} else {
				$receivedHeaders[ $name ][] = trim( $header[1] );
			}

			return $len;
		} );
		if ( $userPassword = $this->getUserPassword() ) {
			curl_setopt( $ch, CURLOPT_USERPWD, $userPassword );
		}
		if ( $password = $this->getPassword() ) {
			curl_setopt( $ch, CURLOPT_PASSWORD, $password );
		}
		if ( $this->isUseCookies() ) {
			curl_setopt( $ch, CURLOPT_COOKIEJAR, $this->getCookies() . ".cookies" );
		}
		if ( $this->isHeadersInResponse() ) {
			curl_setopt( $ch, CURLOPT_HEADER, 1 );
		}
		$this->response        = curl_exec( $ch );
		$this->error           = curl_errno( $ch );
		$this->httpCode        = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		$this->receivedHeaders = $receivedHeaders;
		$this->processHttpCode();
		$this->initCount ++;

		$this->doCurlCallbacks( $ch );

		curl_close( $ch );

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMethod() {
		return isset( $this->method ) ? $this->method : false;
	}

	/**
	 * @param $method
	 *
	 * @return $this
	 */
	public function setMethod( $method ) {
		$method  = strtoupper( $method );
		$allowed = array( 'GET', 'PUT', 'POST', 'DELETE', 'PATCH' );
		if ( in_array( $method, $allowed ) ) {
			if ( $method == 'GET' ) {
				$this->setPost( false );
			}
			$this->method = $method;
		}

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isJsonEncodeData() {
		return $this->jsonEncodeData;
	}

	/**
	 * @param $jsonEncodeData bool
	 *
	 * @return $this
	 */
	public function setJsonEncodeData( $jsonEncodeData ) {
		$this->jsonEncodeData = $jsonEncodeData;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getReceivedHeaders() {
		return $this->receivedHeaders;
	}

	/**
	 * @param $key
	 * @param bool $defaultValue
	 *
	 * @return bool|mixed|string
	 */
	public function getReceivedHeader( $key, $defaultValue = false ) {
		$headers = $this->getHeaders();
		if ( isset( $headers[ $key ] ) ) {
			return $headers[ $key ];
		}

		return $defaultValue;
	}

	/**
	 * @return bool
	 */
	public function isUseCookies() {
		return $this->useCookies;
	}

	/**
	 * @param bool $useCookies
	 */
	public function setUseCookies( $useCookies ) {
		$this->useCookies = $useCookies;
	}

	/**
	 * @param null | string $cookieName
	 *
	 * @return $this
	 */
	public function useCookies( $cookieName = null ) {
		if ( isset( $cookieName ) ) {
			$this->setCookies( $cookieName );
		}
		$this->setUseCookies( true );

		return $this;
	}

	/**
	 * @return string | bool
	 */
	public function getUserPassword() {
		return isset( $this->userPassword ) ? $this->userPassword : false;
	}

	/**
	 * @param $userPassword
	 *
	 * @return $this
	 */
	public function setUserPassword( $userPassword ) {
		if ( is_string( $userPassword ) || is_numeric( $userPassword ) ) {
			$this->userPassword = $userPassword;
		}

		return $this;
	}

	/**
	 * @return string | bool
	 */
	public function getPassword() {
		return isset( $this->password ) ? $this->password : false;
	}

	/**
	 * @param $password
	 *
	 * @return $this
	 */
	public function setPassword( $password ) {
		if ( is_string( $password ) || is_numeric( $password ) ) {
			$this->password = $password;
		}

		return $this;
	}

	/**
	 * @return int | bool
	 */
	public function getSslVersion() {
		return isset( $this->sslVersion ) ? $this->sslVersion : false;
	}

	/**
	 * @param int $sslVersion
	 *
	 * @return $this
	 */
	public function setSslVersion( $sslVersion ) {
		if ( is_numeric( $sslVersion ) ) {
			$this->sslVersion = $sslVersion;
		}

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isHeadersInResponse() {
		return isset( $this->headersInResponse ) ? $this->headersInResponse : false;
	}

	/**
	 * @return $this
	 */
	public function getHeadersInResponse() {
		$this->headersInResponse = true;

		return $this;
	}

	/**
	 * @param $headersInResponse
	 *
	 * @return $this
	 */
	public function setHeadersInResponse( $headersInResponse ) {
		$this->headersInResponse = $headersInResponse;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isError() {
		return (bool) $this->error;
	}

	public function getErrorNumber() {
		return $this->error;
	}


	protected function processHttpCode() {
		$httpCode = $this->getHttpCode();
		if ( $httpCode ) {
			if ( substr( $httpCode, 0, 1 ) == 1 || substr( $httpCode, 0, 1 ) == 2 ) {
				$this->httpCodeSuccess = true;
				$this->httpCodeError   = false;
			}
			if ( substr( $httpCode, 0, 1 ) == 3 || substr( $httpCode, 0, 1 ) == 4 || substr( $httpCode, 0, 1 ) == 5 ) {
				$this->httpCodeSuccess = false;
				$this->httpCodeError   = true;
			}
		}

		if ( $this->isHttpCodeError() && $this->getHttpCodeErrorException() ) {
			throw $this->getHttpCodeErrorException();
		}

	}

	protected function processAnyError() {
		if ( ( $this->isHttpCodeError() || $this->isError() ) && $this->getHandleAnyErrorFunction() ) {
			call_user_func_array( $this->getHandleAnyErrorFunction(), array( $this ) );
		}
	}

	/**
	 * @param bool $refresh
	 *
	 * @return mixed
	 */
	public function getResponse( $refresh = false ) {
		if ( $refresh ) {
			$this->init();
		} else if ( ! $this->isDone() ) {
			$this->init();
		} else if ( ! isset( $this->httpCode ) ) {
			$this->init();
		}

		return $this->response;
	}

	/**
	 * @return bool
	 */
	public function isJsonResponse() {
		$response = $this->getDecodedJsonResponse();
		if ( is_object( $response ) || is_array( $response ) || $response === true ) {
			return true;
		}

		return false;
	}

	/**
	 * @return bool
	 */
	public function isPost() {
		return $this->post;
	}

	/**
	 * @param $post
	 *
	 * @return $this
	 */
	public function setPost( $post ) {
		$this->post = $post;

		return $this;
	}

	/**
	 * @return string | bool
	 */
	public function getHttpCode() {
		return isset( $this->httpCode ) ? $this->httpCode : false;
	}

	/**
	 * @return array
	 */
	public function getHeaders() {
		return $this->headers;
	}

	/**
	 * @param $headers
	 *
	 * @return $this
	 */
	public function setHeaders( $headers ) {
		if ( is_array( $headers ) && count( $headers ) ) {
			$readyHeaders = [];
			foreach ( $headers as $key => $value ) {
				if ( is_string( $key ) ) {
					$keyString      = trim( str_replace( ':', '', $key ) );
					$readyHeaders[] = $keyString . ': ' . trim( $value );
				} else {
					$readyHeaders[] = $value;
				}
			}
			$this->headers = $readyHeaders;
		}

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isBinary() {
		return $this->binary;
	}

	/**
	 * @param $binary
	 *
	 * @return $this
	 */
	public function setBinary( $binary ) {
		$this->binary = $binary;

		return $this;
	}

	/**
	 * @return CurlRequest
	 */
	public function binary() {
		return $this->setBinary( true );
	}

	/**
	 * @return array | string
	 */
	public function getData() {

		$data = isset( $this->data ) ? $this->data : array();
		if ( $this->isJsonEncodeData() ) {
			return \json_encode( $data );
		} else {
			return $data;
		}
	}

	/**
	 * @param $data
	 *
	 * @return $this
	 */
	public function setData( $data ) {
		$this->data = $data;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param $url
	 *
	 * @return $this
	 */
	public function setUrl( $url ) {
		$this->url = $url;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCookies() {
		return $this->cookies;
	}

	/**
	 * /**
	 * @param $cookies
	 *
	 * @return $this
	 */
	public function setCookies( $cookies ) {
		$this->cookies = $cookies;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDone() {
		return (bool) $this->initCount;
	}

	/**
	 * @param bool $assoc
	 * @param int $depth
	 * @param int $options
	 *
	 * @return mixed
	 */
	public function getDecodedJsonResponse( $assoc = false, $depth = 512, $options = 0 ) {
		return \json_decode( $this->getResponse(), $assoc, $depth, $options );
	}

	/**
	 * @return bool
	 */
	public function isHttpCodeSuccess() {
		return isset( $this->httpCodeSuccess ) ? $this->httpCodeSuccess : false;
	}

	/**
	 * @return bool
	 */
	public function isHttpCodeError() {
		return isset( $this->httpCodeError ) ? $this->httpCodeError : false;
	}

	/**
	 * @return \Exception | bool
	 */
	public function getHttpCodeErrorException() {
		return ( $this->httpCodeErrorException instanceof \Exception ) ? $this->httpCodeErrorException : false;
	}

	/**
	 * @param \Exception $httpCodeErrorException
	 *
	 * @return $this
	 */
	public function setHttpCodeErrorException( \Exception $httpCodeErrorException ) {
		$this->httpCodeErrorException = $httpCodeErrorException;

		return $this;
	}

	/**
	 * @return \Closure | bool
	 */
	public function getHandleAnyErrorFunction() {
		return is_callable( $this->handleAnyErrorFunction ) ? $this->handleAnyErrorFunction : false;
	}

	/**
	 * @param \Closure $handleAnyErrorFunction
	 *
	 * @return $this
	 */
	public function setHandleAnyErrorFunction( \Closure $handleAnyErrorFunction ) {
		$this->handleAnyErrorFunction = $handleAnyErrorFunction;

		return $this;
	}

	/**
	 * @return $this
	 */
	public function jsonEncodeSendData() {
		$this->setJsonEncodeData( true );

		return $this;
	}

	/**
	 * @return $this
	 */
	public function noHeaders() {
		$this->setHeaders( array() );

		return $this;
	}


}