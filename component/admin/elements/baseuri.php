<?php
/**
* Base URL form element
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
    class JElementBaseuri extends JElement{
        private $config;

        function fetchElement($name, $value, &$node, $control_name){
            $moduleAbsPath = JPATH_SITE.DS.'modules'.DS.'mod_instagram'.DS;
            $htmlCode = '<input type="hidden" id="' . $control_name.$name . '" name="' . $control_name.'['.$name.']' . '" value="' . $moduleAbsPath . '" />';
            return $htmlCode;
        }
    }//End Class J1.5
}else{
    /**
    * @since J1.6
    */
    class JFormFieldBaseuri extends JFormField {
        protected $type = 'baseuri';

        protected function getInput(){
            $moduleAbsPath = JPATH_SITE.DS.'modules'.DS.'mod_instagram'.DS;
            $htmlCode = '<input type="hidden" id="'.$this->id.'" name="'.$this->name.'" value="'.$moduleAbsPath.'"/>';
            return $htmlCode;
        }
        
        protected function getLabel(){
            return;
        }
    }//End Class
}