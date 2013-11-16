/**
 * Instagram connection behavior for InstaImages component
 *
 * @version  1.0
 * @version $Id$
 * @author Daniel Eliasson (joomla at stilero.com)
 * @copyright  (C) 2012-jul-15 Stilero Webdesign http://www.stilero.com
 * @license	GPLv3
 * 
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 
 * This file is part of instaimages.
 * 
 * instaimages is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * instaimages is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with instaimages.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */
window.addEvent('domready', function(){
    var clientID = $('jform_client_id').value;
    var clientSecret = $('jform_client_secret').value;
    var redirectURI = $('jform_redirect_uri').value;
    var authCode = $('jform_auth_code').value;
    var catcherURI = $('jform_helpers_uri').value + 'catcher.php';

    var sendVars;
        
    var setLinkHref = function(){
        var link = 'https://api.instagram.com/oauth/authorize/' + 
            '?client_id=' + clientID +
            '&redirect_uri=' + catcherURI +
            '&response_type=code';
        $( 'jform_authorize').href = link;
    };
    
    var buttonDisplay = function(){
        if(clientID == '' || clientSecret == '' || redirectURI == ''){
            $('jform_authorize').setStyle( 'display', 'none');
        }else{
             setLinkHref();
            $('jform_authorize').setStyle( 'opacity', '0');
            $('jform_authorize').setStyle( 'display', 'block');
            $('jform_authorize').fade('in');
        }
    };
    
    var handleResponse = function(response){
        if(response.access_token == undefined){
            var errormsg = '(' + response.code + ')' +
                response.error_type + '\n' +
                response.error_message;
                alert(errormsg);
        }else{
            $('jform_access_token').value = response.access_token;
            $('jform_auth_code').value = '';        
            alert(COM_INSTAIMAGES_JS_SUCCESS);
        }
    };
    
    var requestAccessToken = function(){
        authCode = $('jform_auth_code').value;
        var reqUrl = $('jform_helpers_uri').value + 'authorizer.php';
        //reqUrl = decodeURIComponent(reqUrl.replace(/\+/g, ' ')) + 'authtoken';
        sendVars = 'client_id=' + clientID +
            '&client_secret=' + clientSecret +
            '&grant_type=authorization_code' +
            '&code=' + authCode +
            //'&redirect_uri=' + redirectURI;
            '&redirect_uri=' + catcherURI;
        var myRequest = new Request.JSON({
            url: reqUrl,
            method: 'post',
            data:{
                'client_id': clientID,
                'client_secret': clientSecret,
                'grant_type': 'authorization_code',
                'code': authCode,
                'redirect_uri': catcherURI
            },
            onSuccess: function(responseText){
                //alert('success');
                handleResponse(responseText);
            },
            onFailure: function(responseText){
                //alert('failure');
                alert(COM_INSTAIMAGES_JS_FAILURE + responseText.status);
            },
            onError: function(responseText, respError){
                //alert('error occured');
                //alert(responseText);
                //alert(respError);
                handleResponse(responseText);
            },
            onRequest: function(){
                //alert('request started');
            },
            onException: function(){
                //alert('Exception occured');
            },
            onComplete: function(){
                //alert('request completed');
            },
            onTimeout: function(){
                //alert('request timed out');
            },
            onProgress: function(){
                //alert('progress started');
            }
        });
        
        myRequest.send();    
    };
    
    buttonDisplay();

    $('jform_client_id').addEvent('keyup', function(){
        clientID = $('jform_client_id').value;
        buttonDisplay();
    });
    
    $('jform_client_secret').addEvent('keyup', function(){
        clientSecret = $('jform_client_secret').value;
        buttonDisplay();
    });
    
    $('jform_redirect_uri').addEvent('change', function(){
        redirectURI = $('jform_redirect_uri').value;
        setLinkHref();
        buttonDisplay();
    });
    
    $('jform_auth_code').addEvent('change', function(){
        authCode = $('jform_auth_code').value;
        requestAccessToken();
    });
        
});