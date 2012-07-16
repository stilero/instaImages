<?php
/**
* Description of instaModule
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-12 Stilero Webdesign http://www.stilero.com
* @category Custom Form field
* @license    GPLv2
*
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
* This file is part of instructions.
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
    class JElementInstructions extends JElement{
        private $config;

        function fetchElement($name, $value, &$node, $control_name){
            $document =& JFactory::getDocument();
            $this->config = array(
                'jsAsset'       =>      'js/jsFile.js',
                'cssAsset'      =>      'assets/cssFile.css'
            );
            $base_path = JURI::root(true).'/plugins/content/';
            $document->addScript($base_path.$this->config['jsAsset']);
            $document->addStyleSheet($base_path.$this->config['cssAsset']);
            $htmlCode = '<textarea  id="' . $control_name.$name . '" name="' . $control_name.'['.$name.']' . '" value="' . $value . '" rows="5" cols="30" ></textarea>';
            return $htmlCode;
        }
    }//End Class J1.5
}else{
    /**
    * @since J1.6
    */
    class JFormFieldInstructions extends JFormField {
        protected $type = 'instructions';
        private $config;

        protected function getInput(){
            //JHTML::_('behavior.modal', 'a.modal');
            $linktext = JText::_('Register your Application.');
            $instagramURI = 'http://instagram.com/developer/clients/register/';
            //$handler = ' rel="'. "{handler: 'iframe', size:{ x:800, y:650}}".'"';
            //$class = ' class="modal"';
            $htmlCode = 
                    '<div class="width-100 fltlft">'.
                    '<div class="blank">'.
                    '<a id="'.$this->id.'"'.$class.' target="_blank"'.$handler.' href="'.$instagramURI.'" title="'.$linktext.'">'.
                        $linktext.
                    '</a>'.
                    '</div>'.
                    '</div>'
                    ;
            return $htmlCode;
        }
        
        protected function getLabel(){
            
            $toolTip = JText::_('Register your application and create an Instagram Client to use the Instagram API.');
            $text = JText::_('First step');
            $labelHTML = '<label id="'.$this->id.'-lbl" class="hasTip" title="'.$text.'::'.$toolTip.'" for="'.$this->id.'">'.$text.'</label>';
            return $labelHTML;
        }
    }//End Class
}