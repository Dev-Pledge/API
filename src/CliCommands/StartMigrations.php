<?php
require __DIR__ . '/../../vendor/autoload.php';
date_default_timezone_set( 'UTC' );
echo 'starting migrations!' . PHP_EOL;
$now = new \DateTime( 'now' );
echo '--';
echo $now->format( 'Y-m-d H:i:s' );
echo PHP_EOL;
$isThere = null;
while ( $isThere === null ) {
	echo 'trying DB...' . PHP_EOL;
	try {
		$dsn     = 'mysql:dbname=' . getenv( 'PHINX_DBNAME' ) . ';host=' . getenv( 'PHINX_DBHOST' );
		$db      = new \TomWright\Database\ExtendedPDO\ExtendedPDO( $dsn, getenv( 'PHINX_DBUSER' ), getenv( 'PHINX_DBPASS' ) );
		$isThere = $db->dbQuery( "SHOW TABLES;" );
	} catch ( PDOException $exception ) {
		echo $exception->getMessage() . PHP_EOL;
	}
	sleep( 1 );
}
echo 'go migrations go - - - ->' . PHP_EOL;
echo shell_exec( 'cd ' . __DIR__ . '/../../ && vendor/bin/phinx migrate -e development' ) . PHP_EOL;
echo shell_exec( 'cd ' . __DIR__ . '/../../ && php public/index.php /server/make/readme' ) . PHP_EOL;