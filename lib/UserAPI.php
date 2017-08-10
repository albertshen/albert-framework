<?php

namespace Lib;

use Core\Response;
use Core\Router;

class UserAPI extends Base {

  private $_pdo;

  public function __construct() {
    $this->_pdo = PDO::getInstance();
  }

  public function userLoad($openid = 0){
    if($openid) {
      if($user = $this->findUserByOpenid($openid)) {
        return $user;
      } else {
        return FALSE;
      }
    } else {
      if($_user = $this->isUserLogin()){
        $data = new \stdClass();
        $data->uid = $_user->uid;
        $data->openid = $_user->openid;
        return $data;
      } else {
        return (object) array('uid' => '0', 'openid' => '0');
      }
    }
  }

  public function userLogin($openid){
    $user = $this->findUserByOpenid($openid);
    if($user) {
      return $this->userLoginFinalize($user);
    }
    return FALSE;
  }

  public function isUserLogin() {
    if(USER_STORAGE == 'COOKIE') {
      if(isset($_COOKIE['_user'])) {
        return $this->decodeUser($_COOKIE['_user']);
      }
    } else {
      if(isset($_SESSION['_user'])) {
        return json_decode($_SESSION['_user']);
      }
    }
    return FALSE;
  }

  public function userLoginFinalize($user) {
    if(USER_STORAGE == 'COOKIE') {
      $domain = $_SERVER['HTTP_HOST'];
      $port = strpos($domain, ':');
      if ( $port !== false ) $domain = substr($domain, 0, $port);
      setcookie('_user', $this->encodeUser($user), time() + 3600 * 24 * 100, '/', $domain);
    } else {
      $_SESSION['_user'] = json_encode($user);
    }
    return $user;
  }

  public function userRegister($userinfo){
    $userinfo = new \stdClass();
    $user = $this->insertUser($userinfo);
    return $this->userLoginFinalize($user);
  }

  public function oauthAction($redirect_uri) {
    $wechatAPI = new WechatAPI();
    $param['redirect_uri'] = $redirect_uri;
    $router = new Router();
    $callback = $router->generateUrl(CALLBACK, $param, true);
    $url = $wechatAPI->getAuthorizeUrl($callback);
    $response = new Response();
    $response->redirect($url);  
  }

  public function encodeUser($data) {
    $help = new Help();
    $data = base64_encode($help->aes128_cbc_encrypt(ENCRYPT_KEY, json_encode($data), ENCRYPT_IV));
    return $data;
  }

  public function decodeUser($string) {
    $string = base64_decode($string, TRUE);
    $help = new Help();
    $data = $help->aes128_cbc_decrypt(ENCRYPT_KEY, $string, ENCRYPT_IV);
    $user = json_decode($data);
    return $user;
  }
 
  /**
   * Create user in database
   */
  public function insertUser($userinfo){
    $nowtime = NOWTIME;
    $openid = isset($userinfo->openid) ? $userinfo->openid : '';
    $nickname = isset($userinfo->nickname) ? $userinfo->nickname : '';
    $sex = isset($userinfo->sex) ? $userinfo->sex : '';
    $city = isset($userinfo->city) ? $userinfo->city : '';
    $province = isset($userinfo->province) ? $userinfo->province : '';
    $country = isset($userinfo->country) ? $userinfo->country : '';
    $headimgurl = isset($userinfo->headimgurl) ? $userinfo->headimgurl : '';
    $sql = "INSERT INTO `user` SET `openid` = :openid, `nickname` = :nickname, `sex` = :sex, `city` = :city, `province` = :province, `country` = :country, `headimgurl` = :headimgurl, `created` = :created, `updated` = :updated";
    $query = $this->_pdo->prepare($sql);   
    $res = $query->execute(
      array(
        ':openid' => $openid,
        ':nickname' => $nickname,
        ':sex' => $sex,
        ':city' => $city,
        ':province' => $province,
        ':country' => $country,
        ':headimgurl' => $headimgurl,
        ':created' => $nowtime,
        ':updated' => $nowtime,
      )
    );    
    if($res) {
      return $this->findUserByUid($this->_pdo->lastinsertid());
    }
    return NULL;
  }

  /**
   * Find user in database
   */
  public function findUserByOpenid($openid){
    $sql = "SELECT `uid`, `openid`, `nickname`, `sex`, `city`, `province`, `headimgurl`, `country` FROM `user` WHERE `openid` = :openid";
    $query = $this->_pdo->prepare($sql);    
    $query->execute(array(':openid' => $openid));
    $row = $query->fetch(\PDO::FETCH_ASSOC);
    if($row) {
      return  (Object) $row;
    }
    return NULL;
  }

  /**
   * Create user in database
   */
  public function findUserByUid($uid){
    $sql = "SELECT `uid`, `openid`, `nickname`, `sex`, `city`, `province`, `headimgurl`, `country` FROM `user` WHERE `uid` = :uid";
    $query = $this->_pdo->prepare($sql);    
    $query->execute(array(':uid' => $uid));
    $row = $query->fetch(\PDO::FETCH_ASSOC);
    if($row) {
      return (Object) $row;
    }
    return NULL;
  }

  /**
   * Update user in database
   */  
  public function updateUser($userinfo) {
    $nowtime = NOWTIME;
    $sql = "UPDATE `user` SET `nickname` = :nickname, `sex` = :sex, `city` = :city, `province` = :province, `country` = :country, `unionid` = :unionid, `headimgurl` = :headimgurl, `updated` = :updated WHERE `openid` = :openid";    
    $query = $this->_pdo->prepare($sql);    
    $res = $query->execute(
      array(
        ':openid' => $userinfo->openid,
        ':nickname' => $userinfo->nickname,
        ':sex' => $userinfo->sex,
        ':city' => $userinfo->city,
        ':province' => $userinfo->province,
        ':country' => $userinfo->country,
        ':headimgurl' => $userinfo->headimgurl,
        ':unionid' => $userinfo->unionid,
        ':updated' => $nowtime,
      )
    );
    if($res) {
      return true;
    }
    return false;
  }
}