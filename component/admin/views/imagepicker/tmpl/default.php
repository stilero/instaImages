<?php
/**
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-jul-10 Stilero Webdesign http://www.stilero.com
* @category Views Template
* @license    GPLv2
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

JToolBarHelper::title( JText::_( 'Images' ), 'mediamanager.png' );
?>
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
