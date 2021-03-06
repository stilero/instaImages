<?php
/**
 * @version		$Id:controller.php 1 2012-07-14Z  $
 * @package    Instaimages
 * @subpackage Controllers
 * @copyright  	Copyright (C) 2012, . All rights reserved.
 * @author     Daniel Eliasson Stilero Webdesign
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * Instaimages Standard Controller
 *
 * @package Instaimages   
 * @subpackage Controllers
 */
class InstaimagesController extends JControllerLegacy
{

	protected $_viewname = 'item';
	protected $_mainmodel = 'item';
	protected $_itemname = 'Item';    

	/**
	 * Constructor
	 */
		 
	public function __construct($config = array ()) 
	{
		
		parent :: __construct($config);
		
		if (isset($config['viewname'])) $this->_viewname = $config['viewname'];
		if (isset($config['mainmodel'])) $this->_mainmodel = $config['mainmodel'];
		if (isset($config['itemname'])) $this->_itemname = $config['itemname']; 		
		JRequest :: setVar('view', $this->_viewname);

	}
	
	/*
	 * Overloaded Method display
	 */
	public function display($cachable = false, $urlparams = false){

		switch($this->getTask())
		{
			case 'add'     :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view', $this->_viewname);
				JRequest::setVar( 'edit', false );

			} break;
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view', $this->_viewname);
				JRequest::setVar( 'edit', true );

			} break;
		}
		parent :: display();
	}

 	/**
	 *stores the item and returnss to previous page 
	 *
	 */

	function apply() 
	{
		$this-> save();
	}

	/**
	 * stores the item
	 */
	function save() 
	{
		// Check for request forgeries
		JRequest :: checkToken() or jexit('Invalid Token');
		
		$db = & JFactory::getDBO();  

		$post = JRequest :: getVar('jform', array(), 'post', 'array');
		$cid = JRequest :: getVar('cid', array (
			0
		), 'post', 'array');
		$post['id'] = (int) $cid[0];	
		
		$model = $this->getModel($this->_mainmodel);
		if ($model->store($post)) {
			$msg = JText :: _($this->_itemname .' Saved');
		} else {
			$msg = $model->getError(); 
		}
        
		switch ($this->getTask())
		{
			case 'apply':
				$link = 'index.php?option=com_instaimages&view='.$this->_viewname.'&task=edit&cid[]='.$model->getId() ;
				break;

			case 'save':
			default:
				$link = 'index.php?option=com_instaimages&view='.$this->_viewname;
				break;
		}
        

		$this->setRedirect($link, $msg);
	}

	/**
	 * remove an item
	 */		
	function remove() 
	{
		
		// Check for request forgeries
		JRequest :: checkToken() or jexit('Invalid Token');

		$db = & JFactory::getDBO();  
		$cid = JRequest :: getVar('cid', array (), 'post', 'array');
		JArrayHelper :: toInteger($cid);
		$msg = JText::_($this->_itemname.' deleted');
		if (count($cid) < 1) {
			JError :: raiseError(500, JText :: _('Select a '.$this->_itemname.' to delete'));
		}
    	$model = $this->getModel($this->_mainmodel);			
		if (!$model->delete($cid)) {
				$msg = $model->getError(); 
		}		
		$link = 'index.php?option=com_instaimages&view='.$this->_viewname;
		$this->setRedirect($link, $msg);
	}

}// class
  
?>