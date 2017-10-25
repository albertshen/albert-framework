<?php

namespace WechatBundle;

use Core\Controller;
use Lib\WechatAPI;
use Lib\UserAPI;
use Lib\Redis;

class WechatController extends Controller
{

	public function callbackAction()
	{
		$request = $this->request;
		$fields = array(
			'redirect_uri' => array('notnull', '120'),
			'code' => array('notnull', '121'),
		);
		$request->validation($fields);
		$redirect_uri = $request->query->get('redirect_uri');
		$code = $request->query->get('code');
		$url = urldecode($redirect_uri);
		$wechatAPI = new WechatAPI();

		$access_token = $wechatAPI->getSnsAccessToken($code);

		if(isset($access_token->openid)) {
			$param = array();
			$userAPI = new UserAPI();
			if($access_token->scope == 'snsapi_base') {
				$user = $userAPI->userLogin($access_token->openid);
				if(!$user) {
					$userAPI->userRegister($access_token);
				}
			} 
			if($access_token->scope == 'snsapi_userinfo') {
				$user_info = $wechatAPI->getSnsUserInfo($access_token->openid, $access_token->access_token);
				$user = $userAPI->userLogin($user_info->openid);
				if(!$user) {
					$userAPI->userRegister($user_info);
				}
			}	
			$this->redirect($url);
		}
		return $this->Response(json_encode($access_token));
	}

	public function simulationLoginAction() {
		if(ENV == 'prod') {
			$this->statusPrint('you can not simulationLogin on prodution env');		
		} else {
			$request = $this->Request();
			$userAPI = new UserAPI();
			$openid = $request->query->get('openid');
			if($openid) {
				$user = $userAPI->userLogin($openid);
				if(!$user) {
					$user = $userAPI->userRegister($openid);
				}			
			}
			var_dump($user);exit;
			//$this->statusPrint('success');	
		}
	}

	public function clearCookieAction() {
		setcookie('_user', '', time(), '/');
		$this->statusPrint('success');
	}

	/**
	 * JSSDK JS
	 */
	public function jssdkConfigJsAction()
	{
		$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$debug = isset($_GET['debug']) ? (bool) $_GET['debug'] : false;
	  	$this->hostValid($url, JSSDK_ACCESS);
	  	$wechatAPI = new WechatAPI();
	  	$config = $wechatAPI->jssdkLongConfig($url, $debug);
	  	header("Content-type: application/json");
	  	return $this->Response($config);
	}

	public function hostValid($url, $type = OAUTH_ACCESS)
	{
		$parse_url = parse_url($url);
		if(!isset($parse_url['host'])) {
			$this->statusPrint('101', 'the host is invalid');
		}
		if(!in_array($parse_url['host'], (array)json_decode($type))) {
			$this->statusPrint('101', 'the host is invalid');
		}
	}


}
