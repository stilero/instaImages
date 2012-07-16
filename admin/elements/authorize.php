<?php
/**
* Description of instaModule
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-10 Stilero Webdesign http://www.stilero.com
* @category Custom Form field
* @license    GPLv2
*
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
* This file is part of authorize.
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
    class JElementAuthorize extends JElement{
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
    class JFormFieldAuthorize extends JFormField {
        protected $type = 'authorize';
        private $config;

        protected function getInput(){
            JHTML::_('behavior.modal', 'a.lightbox');
            $document =& JFactory::getDocument();
            $language =& JFactory::getLanguage();
            $language->load('com_instaimages', JPATH_ADMINISTRATOR, 'en-GB', true);
            $language->load('com_instaimages', JPATH_ADMINISTRATOR, null, true);
            $assetsPath = JURI::root(true).'/administrator/components/com_instaimages/assets/';
            $this->config = array(
                'jsAsset'       =>      'js/checkclientinfo.js',
                'images'   =>      $assetsPath.'images'.DS
            );
            $this->addTranslationJS();
            $document->addScript($assetsPath.$this->config['jsAsset']);
            return $this->connectButton($this->id);
        }
        
        protected function getLabel(){
  
            $toolTip = JText::_('Connect with Instagram');
            $text = JText::_('Connect');
            $labelHTML = '<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.'</label>';
            return $labelHTML;
        }
        /*
        private function getParams(){
            $module = JModuleHelper::getModule('instagram');
            $params = new JRegistry();
            $params->loadString($module->params);
            return $params;
        }
        
        private function instructions(){
            $htmlCode =
                '<span class="readonly mod-desc">'.
                    JText::_('COM_INSTAIMAGES_AUTHORIZE_INSTR').
                    '</span>';
            return $htmlCode;
        }
        */
        private function addTranslationJS(){
            $document =& JFactory::getDocument();
            $jsTranslationStrings = 'var COM_INSTAIMAGES_JS_SUCCESS = "'.JText::_('App Connected to Instagram. Save to Complete Settings.').'";';
            $jsTranslationStrings .= 'var COM_INSTAIMAGES_JS_FAILURE = "'.JText::_('Instagram Authorization failed with the following error').'";';
            $document->addScriptDeclaration($jsTranslationStrings);        
        }
        
        private function connectButton($id){
            $buttonImage = $this->config['images'].'connect-button.png';
            $htmlCode = 
                    '<div class="width-100 fltlft">'.
                    '<div class="blank">'.
                    '<a '.
                    'id="'.$id.'" '.
                    'title="'.JText::_('Authorize App').'" '.
                    'href="'.$link.'" '.
                    'target="_blank" >'.
                    '<img src="'.$buttonImage.'" />'.
                    '</a>'.
                    '</div>'.
                    '</div>'
                    ;
            return $htmlCode;
        }
    }//End Class
}