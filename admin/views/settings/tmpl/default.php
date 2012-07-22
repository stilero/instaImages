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

  JToolBarHelper::title( JText::_( 'SETTINGS' ), 'config.png' );
  JToolBarHelper::preferences('com_instaimages', '550', '570', 'Instagram Settings');  
?>
 	