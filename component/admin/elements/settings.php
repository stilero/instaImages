<?php
/**
* Settings form element
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-10 Stilero Webdesign http://www.stilero.com
* @category Custom Form field
* @license    GPLv2
*/

// No direct access
defined('_JEXEC') or die;

class JElementSettings extends JElement
{
	/**
	 * Element name
	 *
	 * @var		string
	 */
	var	$_name = 'Settings';

	function fetchElement($name, $value, &$node, $control_name)
	{
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_instaimages'.DS.'tables');
		$app		= JFactory::getApplication();
		$db			= JFactory::getDbo();
		$doc		= JFactory::getDocument();
		$template	= $app->getTemplate();
                $language = JFactory::getLanguage();
                $language->load('com_instaimages', JPATH_ADMINISTRATOR, 'en-GB', true);
                $language->load('com_instaimages', JPATH_ADMINISTRATOR, null, true);
		$fieldName	= $control_name.'['.$name.']';
		$item = JTable::getInstance('settings', 'Table');
		if ($value) {
			$item->load($value);
		} else {
			$item->title = JText::_('Select a Settings');
		}

		$js = "
		function jSelectSettings_".$name."(id, title, catid, object) {
			document.getElementById(object + '_id').value = id;
			document.getElementById(object + '_name').value = title;
			SqueezeBox.close();
		}";
		$doc->addScriptDeclaration($js);

		$link = 'index.php?option=com_instaimages&amp;view=settings&amp;task=element&amp;tmpl=component&amp;function=jSelectSettings_'.$name;

		JHtml::_('behavior.modal', 'a.modal');
		$html = "\n".'<div class="fltlft"><input type="text" id="'.$name.'_name" value="'.htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8').'" disabled="disabled" /></div>';

		$html .= '<div class="button2-left"><div class="blank"><a class="modal" title="'.JText::_('Select a Settings').'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: 650, y: 375}}">'.JText::_('JSELECT').'</a></div></div>'."\n";
		$html .= "\n".'<input type="hidden" id="'.$name.'_id" name="'.$fieldName.'" value="'.(int)$value.'" />';

		return $html;
	}
}