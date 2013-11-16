<?php
/**
 * Description of instaImages
 *
 * @version  1.0
 * @author Daniel Eliasson - joomla at stilero.com
 * @copyright  (C) 2012-jul-15 Stilero Webdesign http://www.stilero.com
 * @category Plugins
 * @license	GPLv2
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

// import library dependencies
//jimport('joomla.plugin.plugin');

class PlgButtonInstaimages extends JPlugin {

    protected $autoloadLanguage = true;

    public function __construct(&$subject, $config = array()) {
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }
    /**public function __construct(& $subject, $config){
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }**/
    
    /**
	 * Display the button
	 *
	 * @return array A two element array of (imageName, textToInsert)
	 */
	public function onDisplay($name, $asset, $author)
	{
            
            $app = JFactory::getApplication();
            $user = JFactory::getUser();
            $extension = $app->input->get('option');
            if ($asset == ''){
                $asset = $extension;
            }
            //$params = JComponentHelper::getParams('com_instaimages');
            
            if ($user->authorise('core.edit', $asset)
			||	$user->authorise('core.create', $asset)
			||	(count($user->getAuthorisedCategories($asset, 'core.create')) > 0)
			||	($user->authorise('core.edit.own', $asset) && $author == $user->id)
			||	(count($user->getAuthorisedCategories($extension, 'core.edit')) > 0)
			||	(count($user->getAuthorisedCategories($extension, 'core.edit.own')) > 0 && $author == $user->id))
		{
                $link = 'index.php?option=com_instaimages&amp;view=imagepicker&amp;format=raw&amp;e_name=' . $name;
                JHtml::_('behavior.modal');
                $button = new JObject;
                $button->modal = true;
                $button->class = 'btn';
                $button->link = $link;
                $button->text = JText::_('PLG_EDITORS-XTD_INSTAIMAGES_BTN_LABEL');
                $button->name = 'camera';
                $button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";
                return $button;
           }else{
                return false;
            }
	}

} //End Class