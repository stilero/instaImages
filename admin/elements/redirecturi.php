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
if(version_compare(JVERSION, '1.6.0', '<')){
    /**
    * @since J1.5
    */
    class JElementRedirecturi extends JElement{
        private $config;

        function fetchElement($name, $value, &$node, $control_name){
            $moduleAbsPath = JURI::root().'modules'.DS.'mod_instagram'.DS.'helpers'.DS.'catcher.php';
            $htmlCode = '<input type="hidden" id="' . $control_name.$name . '" name="' . $control_name.'['.$name.']' . '" value="' . $moduleAbsPath . '" />';
            return $htmlCode;
        }
    }//End Class J1.5
}else{
    /**
    * @since J1.6
    */
    class JFormFieldRedirecturi extends JFormField {
        protected $type = 'redirecturi';

        protected function getInput(){
            $moduleAbsPath = JURI::root();
            $htmlCode = '<input type="text" size="100%" id="'.$this->id.'" name="'.$this->name.'" value="'.$moduleAbsPath.'"/>';
            return $htmlCode;
        }
        
        protected function getLabel(){
            $toolTip = JText::_("The Redirect URI to copy and paste during client registration on Instagram. Don't change this value unless you know what you're doing.");
            $text = JText::_('Redirect URI');
            $labelHTML = '<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.' <small>('.JTEXT::_('Copy This').')</small></label>';
            return $labelHTML;        }
    }//End Class
}