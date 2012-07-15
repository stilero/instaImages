<?php
define( 'DS', DIRECTORY_SEPARATOR );
if (!defined('JPATH_BASE')){
    define('JPATH_BASE', '..'.DS.'..'.DS.'..'.DS.'..');
}
define('JPATH_LIBRARIES', JPATH_BASE . DS . 'libraries');
require_once JPATH_LIBRARIES . DS . 'import.php';
require_once '..'.DS.'lib'.DS.'instaClass.php';
$clientId = JRequest::getVar('client_id');
$clientSecret = JRequest::getVar('client_secret');
$authCode = JRequest::getVar('code');
$redirectURI = JRequest::getVar('redirect_uri');
$config = array(
    'redirectURI'   =>  $redirectURI
);
$instagram = new instaClass($clientId, $clientSecret, $authCode,'', $config);
$token  = $instagram->requestAccessToken($authCode);
print $token;
?>
