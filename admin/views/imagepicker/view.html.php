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
		
		if ($this->getLayout() == 'form') {
		
			$this->_displayForm($tpl);		
			return;
		}
		
		parent::display();
	}
	
	/**
	 *  Displays the form
 	 * @param string $tpl   
     */
	public function _displayForm($tpl)
	{
		global  $alt_libdir;
					
		parent::display($tpl);
	}
}
?>