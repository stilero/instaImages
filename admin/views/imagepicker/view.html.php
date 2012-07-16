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
 
 
class InstaimagesViewImagepicker  extends JView {

	public function display($tpl = null) 
	{
            $app = &JFactory::getApplication('');
            $lang	= JFactory::getLanguage();
            $document =& JFactory::getDocument();
            JHtml::_('behavior.framework', true);
            $assetsPath =  JURI::base().'components'.DS.'com_instaimages'.DS.'assets'.DS;
            $jsPath =  $assetsPath.'js'.DS;
            $cssPath =  $assetsPath.'css'.DS;
            $document->addScript($jsPath.'imagepicker.js');
            $document->addStyleSheet($cssPath.'style.css');
            $params = & JComponentHelper::getParams('com_instaimages');
            $accessToken = $params->get('access_token');
            if($accessToken == ""){
                parent::display('error');
            }
            $images = & $this->get('UserImages');
            $this->assignRef( 'images', $images);
            parent::display();
	}
	
}
?>