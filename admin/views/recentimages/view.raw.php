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
            $params = & JComponentHelper::getParams('com_instaimages');
            $images = & $this->get('UserImages');
            $this->assignRef( 'images', $images);
            parent::display('raw');
	}
	
}
?>