<?php

echo 'starting migrations' . PHP_EOL;
sleep( 2 );
echo 'cd ' . __DIR__ . '/../../ && vendor/bin/phinx migrate -e development'.PHP_EOL;
sleep( 2 );
echo 'go migrations go - - - ->' . PHP_EOL;
echo shell_exec( 'cd ' . __DIR__ . '/../../ && vendor/bin/phinx migrate -e development' ) . PHP_EOL;