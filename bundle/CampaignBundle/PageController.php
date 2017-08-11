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
		$userAPI = new \Lib\UserAPI();
    $data = new \stdClass();
    $data->openid = 'hhhhhhhh28399900';
    $data->nickname = 'fd';
    $data->city = '88in999g';
    $data->country = '999na';
  var_dump($userAPI->userSave($data));exit;
    //var_dump($userAPI->insertUser($data));exit;
		$helper->updateTable('user', $data, array(array('openid', '1223', '>'), array('nickname', '1223')));exit;
      	$request = $this->Request();
      	var_dump($request->getDomain());exit;
		setcookie('_user', '', time(), '/', $request->getDomain());
		$this->statusPrint('success');
	}
}