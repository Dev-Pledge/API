<?php
require __DIR__ . '/../../vendor/autoload.php';
echo 'starting migrations' . PHP_EOL;
$isThere = null;
while ( $isThere === null ) {
	try {
		$dsn     = 'mysql:dbname=' . getenv( 'PHINX_DBNAME' ) . ';host=' . getenv( 'PHINX_DBHOST' );
		$db      = new \TomWright\Database\ExtendedPDO\ExtendedPDO( $dsn, getenv( 'PHINX_DBUSER' ), getenv( 'PHINX_DBPASS' ) );
		$isThere = $db->dbQuery( "SHOW TABLES;" );
	} catch ( PDOException $exception ) {
		echo $exception->getMessage() . PHP_EOL;
	}
	sleep( 1 );
}
//echo 'cd ' . __DIR__ . '/../../ && vendor/bin/phinx migrate -e development' . PHP_EOL;

echo 'go migrations go - - - ->' . PHP_EOL;
echo shell_exec( 'cd ' . __DIR__ . '/../../ && vendor/bin/phinx migrate -e development' ) . PHP_EOL;