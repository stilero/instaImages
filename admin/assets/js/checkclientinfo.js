//jform_params_client_id
window.addEvent('domready', function(){
    var clientID = $('jform_client_id').value;
    var clientSecret = $('jform_client_secret').value;
    var redirectURI = $('jform_redirect_uri').value;
    var authCode = $('jform_auth_code').value;
    var catcherURI = $('jform_helpers_uri').value;

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
        if(!$defined(response.access_token)){
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
        sendVars = 'client_id=' + clientID +
            '&client_secret=' + clientSecret +
            '&grant_type=authorization_code' +
            '&code=' + authCode +
            '&redirect_uri=' + redirectURI;
        var myRequest = new Request.JSON({
            url: reqUrl,
            method: 'post',
            data:{'client_id': clientID,
                'client_secret': clientSecret,
                'grant_type': 'authorization_code',
                'code': authCode,
                'redirect_uri': catcherURI
            },
            onSuccess: function(responseText){
                handleResponse(responseText);
            },
            onFailure: function(responseText){
                alert(COM_INSTAIMAGES_JS_FAILURE + responseText.status);
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