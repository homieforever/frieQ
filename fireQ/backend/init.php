<?php
    defined("SYS_PATH") or define("SYS_PATH", dirname(__FILE__)."/");
    
    require_once SYS_PATH . "classes/loader.php";
    
    loader :: addAutoLoad();
    loader :: addMap();
    
    router :: init();
    
    echo "Params: <br />";
    
    var_dump(router::getParams());
    echo "<br /><br />Controller:<br/>";
    echo router::getController();
    echo "<br /><br />Action:<br />";
    echo router::getAction();
?>