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
	public static function addSubmenu($vName = 'settings')
	{
        
		JSubMenuHelper::addEntry(
			JText::_('Settings'),
			'index.php?option=com_instaimages&view=settings',
			($vName == 'settings')
		);

		JSubMenuHelper::addEntry(
			JText::_('Imagepicker'),
			'index.php?option=com_instaimages&view=imagepicker',
			($vName == 'imagepicker')
		);

	}
	
	/**
	 * 
	 * Get the Extensions for Categories
	 */
	public static function getExtensions() 
	{
				
		$jv = new JVersion();
		$alt_libdir = ($jv->RELEASE < 1.6) ? JPATH_ADMINISTRATOR.DS.'components'.DS.'com_instaimages' : null;
		JLoader::import('joomla.utilities.xmlelement', $alt_libdir);
		
		$xml = simplexml_load_file(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_instaimages'.DS.'elements'.DS.'extensions.xml', 'JXMLElement');		        
		$elements = $xml->xpath('extensions');
		$extensions = $xml->extensions->xpath('descendant-or-self::extension');
		
		return $extensions;
	} 	
}

/**
 * Utility class for categories
 *
 * @static
 * @package 	Joomla.Framework
 * @subpackage	HTML
 * @since		1.5
 */
abstract class JHtmlInstaimages
{
	/**
	 * @var	array	Cached array of the category items.
	 */
	protected static $items = array();
	
	/**
	 * Returns the options for extensions list
	 * 
	 * @param string $ext - the extension
	 */
	public static function extensions($ext) 
	{
		$extensions = InstaimagesHelper::getExtensions();
		$options = array();
		
		foreach ($extensions as $extension) {   
		
			$option = new stdClass();
			$option->text = JText::_(ucfirst($extension->name));
			$option->value = 'com_instaimages.'.$extension->name;
			$options[] = $option;			
		}		
		return JHtml::_('select.options', $options, 'value', 'text', $ext, true);
	}
	
	/**
	 * Returns an array of categories for the given extension.
	 *
	 * @param	string	The extension option.
	 * @param	array	An array of configuration options. By default, only published and unpulbished categories are returned.
	 *
	 * @return	array
	 */
	public static function categories($extension, $cat_id,$name="categories",$title="Select Category", $config = array('attributes'=>'class="inputbox"','filter.published' => array(0,1)))
	{

			$config	= (array) $config;
			$db		= &JFactory::getDbo();

			jimport('joomla.database.query');
			$query	= new JQuery;

			$query->select('a.id, a.title, a.level');
			$query->from('#__instaimages_categories AS a');
			$query->where('a.parent_id > 0');

			// Filter on extension.
			if($extension)
			    $query->where('extension = '.$db->quote($extension));
			
			$attributes = "";
			
			if (isset($config['attributes'])) {
				$attributes = $config['attributes'];
			}
			
			// Filter on the published state
			if (isset($config['filter.published'])) {
				
				if (is_numeric($config['filter.published'])) {
					
					$query->where('a.published = '.(int) $config['filter.published']);
					
				} else if (is_array($config['filter.published'])) {
					
					JArrayHelper::toInteger($config['filter.published']);
					$query->where('a.published IN ('.implode(',', $config['filter.published']).')');
					
				}
			}

			$query->order('a.lft');

			$db->setQuery($query);
			$items = $db->loadObjectList();
			
			// Assemble the list options.
			self::$items = array();
			self::$items[] = JHtml::_('select.option', '', JText::_($title));
			foreach ($items as &$item) {
								
				$item->title = str_repeat('- ', $item->level - 1).$item->title;
				self::$items[] = JHtml::_('select.option', $item->id, $item->title);
			}

		return  JHtml::_('select.genericlist', self::$items, $name, $attributes, 'value', 'text', $cat_id, $name);
		//return self::$items;
	}
}