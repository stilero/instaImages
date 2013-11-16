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

JToolBarHelper::title( JText::_( 'Recent Images' ), 'mediamanager.png' );
JToolBarHelper::preferences('com_instaimages', '550', '570', 'Settings');  
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
                print '<a class="instaimage modal" href="'.$image['full'].'" title="'.$image['caption'].'" ><img data-src="'.$image['thumb'].'" src="#" alt="image1" height="'.$imageThumbSize.'" width="'.$imageThumbSize.'" /></a>';
                print '</div>';
            }
         } 
         ?>
</div>
