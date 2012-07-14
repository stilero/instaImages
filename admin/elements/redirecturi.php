<?php
/**
* Description of instaModule
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-11 Stilero Webdesign http://www.stilero.com
* @category Custom Form field
* @license    GPLv2
*
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
* This file is part of redirecturi.
*
* instaModule is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* instaModule is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with instaModule.  If not, see <http://www.gnu.org/licenses/>.
*
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
            $htmlCode = '<input type="text" size="30" id="'.$this->id.'" name="'.$this->name.'" value="'.$moduleAbsPath.'"/>';
            return $htmlCode;
        }
        
        protected function getLabel(){
            $toolTip = JText::_(COM_INSTAIMAGES_REDIRECT_URI_DESC);
            $text = JText::_(COM_INSTAIMAGES_REDIRECT_URI);
            $labelHTML = '<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.' <small>('.JTEXT::_(COM_INSTAIMAGES_REDIRECT_URI_SMALL).')</small></label>';
            return $labelHTML;        }
    }//End Class
}