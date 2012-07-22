<?php 
/**
* Authcode View
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-jul-10 Stilero Webdesign http://www.stilero.com
* @category Views
* @license    GPLv2
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
 
 
class InstaimagesViewAuthcode  extends JView {

	public function display($tpl = null) 
	{
		$app = &JFactory::getApplication('');
                $authCode = JRequest::getVar('code');
		$this->assignRef( 'authcode', $authCode);
		parent::display();
	}
}
?>