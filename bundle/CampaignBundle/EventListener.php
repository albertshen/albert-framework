<?php

namespace CampaignBundle;

use Core\Event;
use Lib\PDO;

class EventListener
{
	public function extendUser(Event $event)
	{
		global $user;	
		$info = $this->getUserInfo($user->uid);
		$user->nickname = $info->nickname; //add some additional field 
	}

	public function getUserInfo($uid)
	{
		$pdo = PDO::getInstance();
		$info = new \stdClass();
		$info->nickname = 'Albert';
		return $info;
		//do some query
	}
}