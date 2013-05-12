<?php
    $values = array(
        
        // frieQ Home
        array("/", array('controller' => 'site', 'action' => 'home')),
        array("", array('controller' => 'site', 'action' => 'home')),
        
        // Profiles...
        
        array("/profiles/:name/", array('controller' => 'site', 'action' => 'profiles')),
        array("/profiles/:name", array('controller' => 'site', 'action' => 'profiles')),
             
            // Profiles sections...
            array("/profiles/:name/:section/", array('controller' => 'site', 'action' => 'profiles_sections')),
            array("/profiles/:name/:section", array('controller' => 'site', 'action' => 'profiles_sections')),
            
        // rowline
        array("/rowline/:id/", array('controller' => 'site', 'action' => 'rowline')),
        array("/rowline/:id", array('controller' => 'site', 'action' => 'rowline')),
             
             // rowline actions
             array("/rowline/:action/:id/", array('controller' => 'site', 'action' => 'rowline_actions')),
             array("/rowline/:action/:id", array('controller' => 'site', 'action' => 'rowline_actions')),
            
        
    );
?>