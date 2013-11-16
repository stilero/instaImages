<?php
/**
 * Settings controller for Instaimages
 *
 * @version  1.0
 * @version $Id$
 * @author Daniel Eliasson (joomla at stilero.com)
 * @copyright  (C) 2012-jul-15 Stilero Webdesign http://www.stilero.com
 * @license	GPLv3 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * InstaimagesSettings Controller
 *
 * @package    Instaimages
 * @subpackage Controllers
 */
class InstaimagesControllerSettings extends InstaimagesController
{
	/**
	 * Constructor
	 */
	protected $_viewname = 'settings'; 
	 
	public function __construct($config = array ()) 
	{
		parent :: __construct($config);
		JRequest :: setVar('view', $this->_viewname);

	}
//        
//	public function publish() 
//	{
//		// Check for request forgeries
//		JRequest :: checkToken() or jexit('Invalid Token');
//
//		$cid = JRequest :: getVar('cid', array (), 'post', 'array');
//		JArrayHelper :: toInteger($cid);
//
//		if (count($cid) < 1) {
//			JError :: raiseError(500, JText :: _('Select an item to publish'));
//		}
//
//		$model = $this->getModel('settings');
//		if (!$model->publish($cid, 1)) {
//			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
//		}
//
//		$this->setRedirect('index.php?option=com_instaimages&view=settings');
//	}
//
//	public function unpublish() 
//	{
//		// Check for request forgeries
//		JRequest :: checkToken() or jexit('Invalid Token');
//
//		$cid = JRequest :: getVar('cid', array (), 'post', 'array');
//		JArrayHelper :: toInteger($cid);
//
//		if (count($cid) < 1) {
//			JError :: raiseError(500, JText :: _('Select an item to unpublish'));
//		}
//
//		$model = $this->getModel('settings');
//		if (!$model->publish($cid, 0)) {
//			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
//		}
//
//		$this->setRedirect('index.php?option=com_instaimages&view='.$this->_viewname);
//	}
//	public function orderup() 
//	{
//		// Check for request forgeries
//		JRequest :: checkToken() or jexit('Invalid Token');
//
//		$model = $this->getModel('settings');
//		$model->move(-1);
//
//		$this->setRedirect('index.php?option=com_instaimages&view='.$this->_viewname);
//	}
//
//	public function orderdown() 
//	{
//		// Check for request forgeries
//		JRequest :: checkToken() or jexit('Invalid Token');
//
//		$model = $this->getModel('settings');
//		$model->move(1);
//
//		$this->setRedirect('index.php?option=com_instaimages&view='.$this->_viewname);
//	}
//
//	public function saveorder() 
//	{
//		// Check for request forgeries
//		JRequest :: checkToken() or jexit('Invalid Token');
//
//		$cid = JRequest :: getVar('cid', array (), 'post', 'array');
//		$order = JRequest :: getVar('order', array (), 'post', 'array');
//		JArrayHelper :: toInteger($cid);
//		JArrayHelper :: toInteger($order);
//
//		$model = $this->getModel('settings');
//		$model->saveorder($cid, $order);
//
//		$msg = JText :: _('New ordering saved');
//		$this->setRedirect('index.php?option=com_instaimages&view='.$this->_viewname, $msg);
//	}	
}// class
?>