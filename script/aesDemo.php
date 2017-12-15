<?php
define('SITE_URL', dirname(dirname(__FILE__)));
require_once SITE_URL . "/vendor/autoload.php";
require_once SITE_URL . "/config/config.php";

use Lib\Helper;

$helper = new Helper();

$string = 'eyJjdCI6IkM0OXRRbzRRb0IrOHhnRE5VNHFsV3Vmcmh3eFA0b0RlWTZVTC9id2lwTnNTOWIvMzBGSzF1RGkySlBsQ1RXRHJGTVA3SkRJa2Vac3ZPWnpjZGRwMVg3MkQxdThoRDlVSWV4a2d0eVNxUERDQXJ6UGdSbGZXbk9seWtacjVMWWlUIiwiaXYiOiJkNWVmOWNiYzQxMmQyZWYxNjdhNjA1MzUyMDQ0MTY3MCIsInMiOiI1ZTNhNzAwMGJlODk2MGI5In0=';
// $encrypted = '{"ct":"U5PhwL6eoGR5rBMezecJNZf93J9EbabS36wxUR4WlUl56u/7AP4KzhGDXzjI9fCVVtSnjp1i2Gb2RA+LpZMl5mEI7eEUct1i5LQCL3mQTpdHZer3IArY+cwXwovM3QZO","iv":"bad1dfa82dae96aeb5dbb457c84a9bab","s":"5791b1bdf0e359f4"}';
//$encrypted = cryptoJsAesEncrypt("cool", "value to encrypt");
$encrypted = base64_decode($string);
$decrypted = $helper->cryptoJsAesDecrypt("123456", $encrypted);
var_dump($decrypted);
