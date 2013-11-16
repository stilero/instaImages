<?php
/**
* Catcher Helper
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-10 Stilero Webdesign http://www.stilero.com
* @category Helper standalone Joomla app
* @license    GPLv2
*/

define( 'DS', DIRECTORY_SEPARATOR );
$currentDirectory = dirname(__FILE__);
$dirParts = explode(DS, $currentDirectory);
$reversedParts = array_reverse($dirParts);
$newDirs = array();
for($i=4;$i<count($reversedParts);$i++){
    $newDirs[] = $reversedParts[$i];
}
$revNewDirs = array_reverse($newDirs);
$basePath = implode(DS, $revNewDirs);

define('_JEXEC', 1);
if (!defined('JPATH_BASE')){
    define('JPATH_BASE', $basePath);
}

define('JPATH_LIBRARIES', JPATH_BASE . DS . 'libraries');
require_once JPATH_LIBRARIES . DS . 'import.legacy.php';
// no direct access
defined('_JEXEC') or die('Restricted access');

$code = JRequest::getVar('code');
?>
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
        <div id="catchcode"><?php echo $code; ?></div>
    </body>
</html>

