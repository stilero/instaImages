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
class InstaimagesControllerImages extends InstaimagesController
{
	/**
	 * Constructor
	 */
	protected $_viewname = 'images'; 
	 
	public function __construct($config = array ()) 
	{
		parent :: __construct($config);
		JRequest :: setVar('view', $this->_viewname);

	}
		
	
}// class
?>