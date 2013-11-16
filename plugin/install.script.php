<?php
/**
 * @version     $Id$
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

//No direct access
defined('_JEXEC) or die;');

class plgEditorsXtdInstaimagesInstallerScript {

   function postflight($type, $parent) {
        $componentName = 'Button - InstaImages';
        $this->setExtensionActive($componentName);
   }
    
    protected function setExtensionActive($component) {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->update($db->quoteName('#__extensions'));
        $query->set('enabled = '.$db->q('1'));
        $query->where('name='.$db->quote($component));
        $db->setQuery($query);
        $db->query();
    }
    
}