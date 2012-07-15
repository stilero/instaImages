/**
 * @version     $Id$
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
var _getQueryObject = function(q) {
        var vars = q.split(/[&;]/);
        var rs = {};
        if (vars.length) vars.each(function(val) {
        var keys = val.split('=');
        if (keys.length && keys.length == 2) rs[encodeURIComponent(keys[0])] = encodeURIComponent(keys[1]);
        });
        return rs;
    }
    
    var _getUriObject = function(u){
        var bits = u.match(/^(?:([^:\/?#.]+):)?(?:\/\/)?(([^:\/?#]*)(?::(\d*))?)((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[\?#]|$)))*\/?)?([^?#\/]*))?(?:\?([^#]*))?(?:#(.*))?/);
        return (bits)
        ? bits.associate(['uri', 'scheme', 'authority', 'domain', 'port', 'path', 'directory', 'file', 'query', 'fragment'])
        : null;
    } 
    
window.addEvent('domready', function(){
    var tag;
    var editor = 'jform_articletext';
    var size='200';
    
    $$('.instaimage').addEvent('click', function(e){
        e.preventDefault();
        var url = this.href;
        var title = this.title;
        var extra = "title=\""+title+"\" alt=\""+title+"\" width=\""+size+"\" height=\""+size+"\"";
        var tag = "<img src=\""+url+"\" "+extra+"/>";
        window.parent.jInsertEditorText(tag, editor);
        window.parent.SqueezeBox.close();
        return false; 
    });
    
    

});