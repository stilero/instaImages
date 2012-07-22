<?php
/**
* Authorizer Helper
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-10 Stilero Webdesign http://www.stilero.com
* @category Helper standalone Joomla app
* @license    GPLv2
*/

define( 'DS', DIRECTORY_SEPARATOR );
define('_JEXEC', 1);
if (!defined('JPATH_BASE')){
    define('JPATH_BASE', '..'.DS.'..'.DS.'..'.DS.'..');
}
define('JPATH_LIBRARIES', JPATH_BASE . DS . 'libraries');
require_once JPATH_LIBRARIES . DS . 'import.php';

// no direct access
defined('_JEXEC') or die('Restricted access');

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