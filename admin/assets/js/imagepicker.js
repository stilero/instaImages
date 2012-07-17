/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * JImageManager behavior for media component
 *
 * @package		Joomla.Extensions
 * @subpackage	Media
 * @since		1.5
 */

(function() {
var ImageManager = this.ImageManager = {
	initialize: function()
	{
		o = this._getUriObject(window.self.location.href);
		console.log(o);
		q = new Hash(this._getQueryObject(o.query));
		this.editor = decodeURIComponent(q.get('e_name'));
                console.log(this.editor);

		// Setup image manager fields object
		this.fields			= new Object();
		this.fields.url		= document.id("image_url");
		this.fields.alt		= document.id("image_desc");
		this.fields.title	= document.id("image_title");
	},

	onok: function()
	{
		extra = '';
		// Get the image tag field information
		var url		= this.fields.url.get('value');
		var alt		= this.fields.alt.get('value');
		var title	= this.fields.title.get('value');

		if (url != '') {
			// Set alt attribute
			if (alt != '') {
				extra = extra + 'alt="'+alt+'" ';
			} else {
				extra = extra + 'alt="" ';
			}
			// Set align attribute
			if (title != '') {
				extra = extra + 'title="'+title+'" ';
			}

			var tag = "<img src=\""+url+"\" "+extra+"/>";
		}

		window.parent.jInsertEditorText(tag, this.editor);
                window.parent.SqueezeBox.close();
		return false;
	},

	populateFields: function(url, title)
	{
		this.fields.url.value = url;
                this.fields.alt.value = title;
		this.fields.title.value = title;
                
	},

	showMessage: function(text)
	{
		var message  = document.id('message');
		var messages = document.id('messages');

		if(message.firstChild)
			message.removeChild(message.firstChild);

		message.appendChild(document.createTextNode(text));
		messages.style.display = "block";
	},

//	parseQuery: function(query)
//	{
//		var params = new Object();
//		if (!query) {
//			return params;
//		}
//		var pairs = query.split(/[;&]/);
//		for ( var i = 0; i < pairs.length; i++ )
//		{
//			var KeyVal = pairs[i].split('=');
//			if ( ! KeyVal || KeyVal.length != 2 ) {
//				continue;
//			}
//			var key = unescape( KeyVal[0] );
//			var val = unescape( KeyVal[1] ).replace(/\+ /g, ' ');
//			params[key] = val;
//	   }
//	   return params;
//	},

//	refreshFrame: function()
//	{
//		this._setFrameUrl();
//	},
//
//	_setFrameUrl: function(url)
//	{
//		if (url != null) {
//			this.frameurl = url;
//		}
//		this.frame.location.href = this.frameurl;
//	},

	_getQueryObject: function(q) {
		var vars = q.split(/[&;]/);
		var rs = {};
		if (vars.length) vars.each(function(val) {
			var keys = val.split('=');
			if (keys.length && keys.length == 2) rs[encodeURIComponent(keys[0])] = encodeURIComponent(keys[1]);
		});
		return rs;
	},

	_getUriObject: function(u){
		var bits = u.match(/^(?:([^:\/?#.]+):)?(?:\/\/)?(([^:\/?#]*)(?::(\d*))?)((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[\?#]|$)))*\/?)?([^?#\/]*))?(?:\?([^#]*))?(?:#(.*))?/);
		return (bits)
			? bits.associate(['uri', 'scheme', 'authority', 'domain', 'port', 'path', 'directory', 'file', 'query', 'fragment'])
			: null;
	}
};
})(document.id);

window.addEvent('domready', function(){
	ImageManager.initialize();
        $$('.instaimage').addEvent('click', function(e){
            e.preventDefault();
            ImageManager.populateFields(this.href, this.title)
        });
        
        $('cancel_btn').addEvent('click', function(){
            window.parent.SqueezeBox.close();
            return false;
        });

        $('insert_btn').addEvent('click', function(){
            ImageManager.onok();
//            var title = ImageManager.fields.title.value;
//            var url = ImageManager.fields.url.value;
//            var alt = ImageManager.fields.alt.value;
//            var extra = "title=\""+title+"\" alt=\""+alt+"\"";
//            var tag = "<img src=\""+url+"\" "+extra+" />";
//            window.parent.jInsertEditorText(tag, ImageManager.editor);
//            window.parent.SqueezeBox.close();
//            return false;
        });
        
});


//
//
//
///**
// * @version     $Id$
// * @copyright   Copyright 2011 Stilero AB. All rights re-served.
// * @license     GNU General Public License version 2 or later; see LICENSE.txt
// */
//window.addEvent('domready', function(){
//    //var tag;
//    var editor = 'jform_articletext';
//    var titleBox = 'image_title';
//    var descBox = 'image_desc';
//    var imgURLBox = 'image_url';
//    var insertBtn = 'insert_btn';
//    var cancelBtn = 'cancel_btn';
//    var size='200';
//    
//    $$('.instaimage').addEvent('click', function(e){
//        e.preventDefault();
//        $(imgURLBox).value = this.href;
//        $(titleBox).value = this.title;
//        $(descBox).value = this.title;
//        //var extra = "title=\""+title+"\" alt=\""+title+"\" width=\""+size+"\" height=\""+size+"\"";
//        //var tag = "<img src=\""+url+"\" "+extra+"/>";
//        window.parent.jInsertEditorText(tag, editor);
//        window.parent.SqueezeBox.close();
//        return false; 
//    });
//    
//    $(cancelBtn).addEvent('click', function(){
//        window.parent.SqueezeBox.close();
//        return false;
//    });
//    
//    $(insertBtn).addEvent('click', function(){
//        var title = $(titleBox).value;
//        var url = $(imgURLBox).value;
//        var extra = "title=\""+title+"\" alt=\""+title+"\"";
//        var tag = "<img src=\""+url+"\" "+extra+" />";
//        window.parent.jInsertEditorText(tag, editor);
//        window.parent.SqueezeBox.close();
//        return false;
//    });
//});