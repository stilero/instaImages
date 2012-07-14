<?php
/**
* @version		$Id: #name#.php 111 2012-02-24 18:37:06Z michel $
* @package		Instaimages
* @subpackage 	Controllers
* @copyright	Copyright (C) 2012, . All rights reserved.
* @license #
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * InstaimagesImagepicker Controller
 *
 * @package    Instaimages
 * @subpackage Controllers
 */
class InstaimagesControllerImagepicker extends InstaimagesController
{
	/**
	 * Constructor
	 */
	protected $_viewname = 'imagepicker'; 
	 
	public function __construct($config = array ()) 
	{
		parent :: __construct($config);
		JRequest :: setVar('view', $this->_viewname);

	}
	
	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_instaimages&view=imagepicker' );
		
		$model = $this->getModel('imagepicker');

		$model ->checkin();
	}	
	
	function edit() 
	{
		$document =& JFactory::getDocument();

		$viewType	= $document->getType();
		$viewType	= $document->getType();
		$viewName	= JRequest::getCmd( 'view', $this->_viewname);
				
		$view = & $this->getView( $viewName, $viewType);
		
		//Some Code here
		
		$view->setLayout('form');
		JRequest::setVar( 'hidemainmenu', 1 );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar( 'view', $this->_viewname);
		JRequest::setVar( 'edit', true );
				
		$view->display();
	}
	

	/**
	 * stores the item
	 */
	function save() 
	{
		// Check for request forgeries
		JRequest :: checkToken() or jexit('Invalid Token');
		
		//Do something
		
		
		switch ($this->getTask())
		{
			case 'apply':
				$link = 'index.php?option=com_instaimages&view=imagepicker.&task=edit&cid[]=1' ;
				break;

			case 'save':
			default:
				$link = 'index.php?option=com_instaimages&view=imagepicker';
				break;
		}
        
		$this->setRedirect($link, $msg);
	}
		
	
}// class
?>