<?php
/**
* Redirect URL form element
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-10 Stilero Webdesign http://www.stilero.com
* @category Custom Form field
* @license    GPLv2
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
* @since J1.6
*/
class JFormFieldRedirecturi extends JFormField {
    protected $type = 'redirecturi';

    protected function getInput(){
        $redirectUri = JURI::root().'administrator/components/com_instaimages/helpers/catcher.php';
        $htmlCode = '<input type="text" size="100%" id="'.$this->id.'" name="'.$this->name.'" value="'.$redirectUri.'"/>';
        return $htmlCode;
    }

    protected function getLabel(){
        $toolTip = JText::_("The Redirect URI to copy and paste during client registration on Instagram. Don't change this value unless you know what you're doing.");
        $text = JText::_('Redirect URI');
        $labelHTML = '<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.' <small>('.JTEXT::_('Copy This').')</small></label>';
        return $labelHTML;        }
}//End Class