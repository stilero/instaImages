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
 
 
class InstaimagesViewRecentimages  extends JView {

	public function display($tpl = null) 
	{
            $app = &JFactory::getApplication('');
            $lang	= JFactory::getLanguage();
            $document =& JFactory::getDocument();
            JHtml::_('behavior.framework');
            JHtml::_('behavior.framework', true);
            $assetsPath = JURI::root( true ).'/administrator/components/com_instaimages/assets/';
            $jsLazyLoad =  $assetsPath.'js/lazyload.js';
            $cssMain = $assetsPath.'css/style.css';
//            $jsPath =  $assetsPath.'js'.DS;
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