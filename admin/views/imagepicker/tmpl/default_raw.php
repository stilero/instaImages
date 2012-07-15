<?php

// no direct access
defined('_JEXEC') or die('Restricted access');
$assetsPath = JURI::base().'components'.DS.'com_instaimages'.DS.'assets'.DS;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js" type="text/javascript"></script>
        <?php
        $document =& JFactory::getDocument();
        //JHtml::_('behavior.framework', true);
        $js =  $assetsPath.'js'.DS.'imagepicker.js';
        $css = $assetsPath.'css'.DS.'style.css';
        ?>
        <script src="<?php print $js; ?>" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php print $css; ?>" type="text/css" />
    </head>
    <body>
        <div class="contentpane">
                <?php 
                $imageCount = '20';
                $imageThumbSize = '150';
                $i = 1; 
                foreach ($this->images as $image) {
                    if ($i++ > $imageCount){
                        break;
                    }
                    if(!empty($image)){
                        print '<div class="instaimagecont">';
                        print '<a class="instaimage" href="'.$image['full'].'" title="'.$image['caption'].'" ><img src="'.$image['thumb'].'" alt="image1" height="'.$imageThumbSize.'" width="'.$imageThumbSize.'" /></a>
        ';
                        print '</div>';
                    }
                } 
                ?>
        </div>
    </body>
</html>