<?php 
/**
* @version		$Id: view.html.php 111 2012-02-24 18:37:06Z michel $
* @package		Instaimages
* @subpackage 	Views
* @copyright	Copyright (C) 2012, . All rights reserved.
* @license #
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
 
 
class InstaimagesViewAuthtoken  extends JView {

	public function display($tpl = null){
            $libPath = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_instaimages'.DS.'lib'.DS.'instaClass.php';
            require_once $libPath;
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