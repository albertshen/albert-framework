<?php

namespace CampaignBundle;

use Core\Controller;
use Lib\WechatAPI;

class PageController extends Controller
{
	public function indexAction() {
		global $user;
		//var_dump($user);exit;
		$wechatAPI = new WechatAPI();
		$config = $wechatAPI->jssdkShortConfig($this->request->getUrl(TRUE));
		return $this->render('index', array('config' => $config));
	}

	public function clearCookieAction() {
      	$request = $this->Request();
		setcookie('_user', '', time(), '/', $request->getDomain());
		$this->statusPrint('success');
	}
}