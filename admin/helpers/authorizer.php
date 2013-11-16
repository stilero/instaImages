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
$currentDirectory = dirname(__FILE__);
$dirParts = explode(DS, $currentDirectory);
$reversedParts = array_reverse($dirParts);
$newDirs = array();
for($i=4;$i<count($reversedParts);$i++){
    $newDirs[] = $reversedParts[$i];
}
$revNewDirs = array_reverse($newDirs);
$basePath = implode(DS, $revNewDirs);

define('_JEXEC', 1);
if (!defined('JPATH_BASE')){
    define('JPATH_BASE', $basePath);
}

define('JPATH_LIBRARIES', JPATH_BASE . DS . 'libraries');
require_once JPATH_LIBRARIES . DS . 'import.legacy.php';
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once JPATH_BASE . DS .'administrator'.DS.'components'.DS.'com_instaimages' .DS.'lib'.DS.'instaClass.php';

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