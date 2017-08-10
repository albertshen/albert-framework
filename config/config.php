<?php

define("BASE_URL", '');
define("TEMPLATE_ROOT", dirname(__FILE__) . '/../template');
define("VENDOR_ROOT", dirname(__FILE__) . '/../vendor');

//ENV
define("ENV", 'dev');

//User
define("USER_STORAGE", 'COOKIE');
define("USER_LOAD_MORE", true);

//Wechat Vendor
define("WECHAT_VENDOR", 'default'); // default | coach

//Wechat Vendor
define("CALLBACK_CODE", true); // true | false

//Wechat config info
define("TOKEN", 'xxx');
define("APPID", 'wx4868f82730292835');
define("APPSECRET", 'b994d3233e85e53712189f21880b83e3');
define("NOWTIME", date('Y-m-d H:i:s'));
define("AHEADTIME", '1000');

define("NONCESTR", '?????');
define("COACH_AUTH_URL", '?????'); 

//Redis config info
define("REDIS_HOST", '127.0.0.1');
define("REDIS_DBNAME", 1);
define("REDIS_PORT", '6379');

//Database config info
define("DBHOST", '127.0.0.1');
define("DBUSER", 'root');
define("DBPASS", '');
define("DBNAME", 'campaign');

//Wechat Authorize
define("CALLBACK", 'wechat/callback');
define("SCOPE", 'snsapi_base');

//Wechat Authorize Page
define("AUTHORIZE_URL", '[
	"/"
]');

//Account Access
define("OAUTH_ACCESS", '{
	"xxxx": "samesamechina.com" 
}');
define("JSSDK_ACCESS", '{
	"xxxx": "samesamechina.com",
	"dev": "127.0.0.1"
}');

define("ENCRYPT_KEY", '29FB77CB8E94B358');
define("ENCRYPT_IV", '6E4CAB2EAAF32E90');

define("WECHAT_TOKEN_PREFIX", 'wechat:token:');







