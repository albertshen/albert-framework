<?php

namespace CampaignBundle;

use Core\Controller;

class PageController extends Controller
{
	public function indexAction() {
		global $user;
		var_dump($user);exit;
		$RedisAPI = new \Lib\RedisAPI();
		$config = $RedisAPI->jssdkConfig($this->request->getUrl(TRUE));
		return $this->render('index', array('config' => $config));
	}

	public function clearCookieAction() {
		$domain = $_SERVER['HTTP_HOST'];
		$port = strpos($domain, ':');
		if ( $port !== false ) $domain = substr($domain, 0, $port);
		setcookie('_user', '', time(), '/', $domain);
		$this->statusPrint('success');
	}
}