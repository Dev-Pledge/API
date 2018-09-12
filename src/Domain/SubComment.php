<?php


namespace DevPledge\Domain;


class SubComment extends Comment {

	public function toAPIMap(): \stdClass {
		$data = parent::toAPIMap();
		unset( $data->last_five_replies );

		return $data;
	}

}