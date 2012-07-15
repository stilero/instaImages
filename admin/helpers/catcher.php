<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js" type="text/javascript"></script>
        <script type="text/javascript">
            window.addEvent('domready', function(){
                var code = $('catchcode').get('text');
                window.opener.$('jform_auth_code').value = code;
                window.opener.$('jform_auth_code').fireEvent('change');
                window.close();
            });
        </script>
    </head>
    <body bgcolor="#FFFFFF">
        <div id="catchcode"><?php echo $_GET['code']; ?></div>
    </body>
</html>

