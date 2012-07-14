<?php
/**
* @version		$Id:controller.php  1 2012-07-14Z  $
* @package		Instaimages
* @subpackage 	Controllers
* @copyright	Copyright (C) 2012, . All rights reserved.
* @license #
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * Variant Controller
 *
 * @package    
 * @subpackage Controllers
 */
class InstaimagesController extends JController
{

	protected $_viewname = 'item';
	protected $_mainmodel = 'item';
	protected $_itemname = 'Item';    
	protected $_context = "com_instaimages";
	/**
	 * Constructor
	 */
		 
	public function __construct($config = array ()) {
		
		parent :: __construct($config);

		if(isset($config['viewname'])) $this->_viewname = $config['viewname'];
		if(isset($config['mainmodel'])) $this->_mainmodel = $config['mainmodel'];
		if(isset($config['itemname'])) $this->_itemname = $config['itemname']; 

		JRequest :: setVar('view', $this->_viewname);

	}

	public function display() {
		
		$document =& JFactory::getDocument();
	
		$viewType	= $document->getType();
		$view = & $this->getView($this->_viewname,$viewType);
		$model = & $this->getModel($this->_mainmodel);
	
		$view->setModel($model,true);		
		$view->display();
	}
	

}// class
  	

  
?>