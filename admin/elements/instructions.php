<?php
/**
* Instructions form element
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