<?php
    defined("SYS_PATH") or define("SYS_PATH", dirname(__FILE__)."/");
    defined("DEBUG") or define("DEBUG", true);
    
    require_once SYS_PATH . "configs/mysql.php";
    require_once SYS_PATH . "classes/loader.php";
    
    loader :: addAutoLoad();
    loader :: addMap();
    
    log::add_log(array(1, "My Error"));
    log::add_log(array(1, "My Error"));
    
    router :: init("home");
    
    
    echo "Params: <br />";
    
    var_dump(router::getParams());
    echo "<br /><br />Controller:<br/>";
    echo router::getController();
    echo "<br /><br />Action:<br />";
    echo router::getAction();
    
    echo log::write_log();
    
    $ar = array('controller' => 'site', 'action' => 'home');
    
    echo json_encode($ar);
?>