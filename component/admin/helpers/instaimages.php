<?php
/**
 * @version		$Id: #component#.php 96 2011-08-11 06:59:32Z michel $
 * @package		Joomla.Framework
 * @subpackage		HTML
 * @copyright	Copyright (C) 2005 - 2009 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_instaimages'.DS.'helpers'.DS.'query.php');

class InstaimagesHelper
{
	
	/*
	 * Submenu for Joomla 1.6
	 */
	public static function addSubmenu($vName = 'recentimages')
	{
        
		JSubMenuHelper::addEntry(
			JText::_('Recent images'),
			'index.php?option=com_instaimages&view=recentimages',
			($vName == 'recentimages')
		);
                
               
	}	
}