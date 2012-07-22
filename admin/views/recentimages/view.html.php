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
 
 
class InstaimagesViewRecentimages  extends JView {

	public function display($tpl = null) 
	{
            $app = &JFactory::getApplication('');
            $lang	= JFactory::getLanguage();
            $document =& JFactory::getDocument();
            JHtml::_('behavior.framework');
            JHtml::_('behavior.framework', true);
            define('ASSETS_URI', JURI::root( true ).'/administrator/components/com_instaimages/assets/');
            $jsLazyLoad =  ASSETS_URI.'js/lazyload.js';
            $cssMain = ASSETS_URI.'css/style.css';
            $document->addScript($jsLazyLoad);
            $document->addStyleSheet($cssMain);
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