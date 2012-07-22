<?php
/**
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-jul-10 Stilero Webdesign http://www.stilero.com
* @category Views
* @license    GPLv2
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

define('ASSETS_URI', JURI::root( true ).'/administrator/components/com_instaimages/assets/');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js" type="text/javascript"></script>
        <?php
        $document =& JFactory::getDocument();
        //JHtml::_('behavior.framework', true);
        $jsImgPicker =  ASSETS_URI.'js'.DS.'imagepicker.js';
        $jsLazyLoad =  ASSETS_URI.'js'.DS.'lazyload.js';
        $cssMain = ASSETS_URI.'css'.DS.'style.css';
        ?>
        <script src="<?php print $jsImgPicker; ?>" type="text/javascript"></script>
        <script src="<?php print $jsLazyLoad; ?>" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php print $cssMain; ?>" type="text/css" />
        <link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
        <link rel="stylesheet" href="templates/bluestork/css/template.css" type="text/css" />
    </head>
    <body>
        <div class="width-100 fltlft">
            <fieldset class="adminform">
                <legend>Choose image</legend>
                <ul class="adminformList">
                    <li>
                       <label class="hasTip" id="image_title-lbl" for="image_title">Image Title</label>
                       <input type="text" class="inputbox" size="100%" id="image_title" name="image_title" />
                    </li>
                    <li>
                        <label class="hasTip" id="image_desc-lbl" for="image_desc">Image Description</label>
                        <input type="text" class="inputbox" size="100%" id="image_desc" name="image_desc" />
                    </li>
                </ul>
                <div class="clr"></div>
                <input type="button" id="insert_btn" value="Insert" />
                <input type="button" id="cancel_btn" value="Cancel" />
                <input type="hidden" id="image_url" />
                <div class="clr"></div>

                    <?php 
                    $imageCount = '20';
                    $imageThumbSize = '125';
                    $i = 1; 
                    foreach ($this->images as $image) {
                        if ($i++ > $imageCount){
                            break;
                        }
                        if(!empty($image)){
                            print '<div class="instaimagecont">';
                            print '<a class="instaimage" href="'.$image['full'].'" title="'.$image['caption'].'" ><img data-src="'.$image['thumb'].'" src="#" alt="image1" height="'.$imageThumbSize.'" width="'.$imageThumbSize.'" /></a>';
                            print '</div>';
                        }
                    } 
                    ?>
                </fieldset>
        </div>
    </body>
</html>