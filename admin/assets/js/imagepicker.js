/**
 * @version     $Id$
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
window.addEvent('domready', function(){
    //var tag;
    var editor = 'jform_articletext';
    var titleBox = 'image_title';
    var descBox = 'image_desc';
    var imgURLBox = 'image_url';
    var insertBtn = 'insert_btn';
    var cancelBtn = 'cancel_btn';
    var size='200';
    
    $$('.instaimage').addEvent('click', function(e){
        e.preventDefault();
        $(imgURLBox).value = this.href;
        $(titleBox).value = this.title;
        $(descBox).value = this.title;
        //var extra = "title=\""+title+"\" alt=\""+title+"\" width=\""+size+"\" height=\""+size+"\"";
        //var tag = "<img src=\""+url+"\" "+extra+"/>";
        window.parent.jInsertEditorText(tag, editor);
        window.parent.SqueezeBox.close();
        return false; 
    });
    
    $(cancelBtn).addEvent('click', function(){
        window.parent.SqueezeBox.close();
        return false;
    });
    
    $(insertBtn).addEvent('click', function(){
        var title = $(titleBox).value;
        var url = $(imgURLBox).value;
        var extra = "title=\""+title+"\" alt=\""+title+"\"";
        var tag = "<img src=\""+url+"\" "+extra+" />";
        window.parent.jInsertEditorText(tag, editor);
        window.parent.SqueezeBox.close();
        return false;
    });
});