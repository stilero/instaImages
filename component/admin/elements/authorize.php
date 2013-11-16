<?php
/**
* Authorize form element
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
            $document = JFactory::getDocument();
            $language = JFactory::getLanguage();
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
            $document = JFactory::getDocument();
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
                    'href="#" '.
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