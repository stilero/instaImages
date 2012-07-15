<?php

// no direct access
defined('_JEXEC') or die('Restricted access');
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
