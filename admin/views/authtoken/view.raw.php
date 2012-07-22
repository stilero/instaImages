<?php 
/**
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-jul-10 Stilero Webdesign http://www.stilero.com
* @category Views
* @license    GPLv2
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
 
 
class InstaimagesViewAuthtoken  extends JView {

	public function display($tpl = null){
            define('LIB_PATH', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_instaimages'.DS.'lib'.DS);
            $instaClass = LIB_PATH.'instaClass.php';
            require_once $instaClass;
            $app = &JFactory::getApplication('');
            /*
            $clientId = JRequest::getVar('client_id');
            $clientSecret = JRequest::getVar('client_secret');
            $authCode = JRequest::getVar('code');
            $redirectURI = JRequest::getVar('redirect_uri');
            */
            $params = & JComponentHelper::getParams('com_instaimages');
            $clientId = $params->get('client_id');
            $clientSecret = $params->get('client_secret');
            $authCode = JRequest::getVar('code');
            //$redirectURI = JRequest::getVar('redirect_uri');
            $redirectURI = $params->get('redirect_uri');
            //$redirectURI = 'http://localhost/joomla_svn/';
             
            $config = array(
                'redirectURI'   =>  $redirectURI
            );
            
            $instagram = new instaClass($clientId, $clientSecret, $authCode,'', $config);
            $token  = $instagram->requestAccessToken($authCode);
            $this->assignRef( 'token', $token);
            parent::display();
	}
}
?>