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
 
 
class InstaimagesViewImagepicker  extends JViewLegacy {

	public function display($tpl = null) 
	{
            $app = &JFactory::getApplication('');
            $lang	= JFactory::getLanguage();
            $document =& JFactory::getDocument();
            JHtml::_('behavior.framework', true);
            define('ASSETS_PATH', JURI::base().'components'.DS.'com_instaimages'.DS.'assets'.DS);
            define('JS_PATH', ASSETS_PATH.'js'.DS);
            define('CSS_PATH', ASSETS_PATH.'css'.DS);
            $document->addScript(JS_PATH.'imagepicker.js');
            $document->addStyleSheet(CSS_PATH.'style.css');
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