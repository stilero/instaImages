<?php
/**
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-jul-10 Stilero Webdesign http://www.stilero.com
* @license    GPLv2
*/

//--No direct access
defined('_JEXEC') or die('Resrtricted Access');
if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}
// Require the base controller
require_once( JPATH_COMPONENT.DS.'controller.php' );

jimport('joomla.application.component.model');
require_once( JPATH_COMPONENT.DS.'models'.DS.'model.php' );
// Component Helper
jimport('joomla.application.component.helper');

//add Helperpath to JHTML
JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers');

//include Helper
require_once(JPATH_COMPONENT.DS.'helpers'.DS.'instaimages.php');

//Use the JForms, even in Joomla 1.5 
$jv = new JVersion();
$GLOBALS['alt_libdir'] = ($jv->RELEASE < 1.6) ? JPATH_COMPONENT_ADMINISTRATOR : null;

//set the default view
$controller = JRequest::getWord('view', 'recentimages');
//$controller = JRequest::getWord('view', 'settings');

//add submenu for 1.6
if ($jv->RELEASE > 1.5) {
	InstaimagesHelper::addSubmenu($controller);	
}



$ControllerConfig = array();

// Require specific controller if requested
if ( $controller) {   
   $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
   $ControllerConfig = array('viewname'=>strtolower($controller),'mainmodel'=>strtolower($controller),'itemname'=>ucfirst(strtolower($controller)));
   if ( file_exists($path)) {
       require_once $path;
   } else {       
	   $controller = '';	   
   }
}

// Create the controller
$classname    = 'InstaimagesController'.$controller;
$controller   = new $classname($ControllerConfig );

// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller
$controller->redirect();