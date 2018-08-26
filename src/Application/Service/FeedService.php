<?php

namespace DevPledge\Application\Service;


use DevPledge\Integrations\Integrations;

class FeedService {

	public function send(\stdClass $data){
		$t = json_encode($data);

		shell_exec('php '.Integrations::getBaseDir().'/sendfeed.php "'.addslashes( $t).'" > /dev/null 2>/dev/null &');
	}

}