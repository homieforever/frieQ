<?php

$salt = 'Clanplanet LIGA, Powerd by CreativeEngine';

ini_set('session.use_only_cookies', '1');

session_set_save_handler('_open','_close','_read','_write','_destroy','_clean');

function _open()
{
    global $salt;
    
    if($id = session_id())
    {
         $id = mysql::escape($id);
         $ipagent = '';
         
         mysql::query("SELECT `ipagent` FROM `user_sessions` WHERE `id` = '".$id."'");
         
         if (mysql::num_result())
         {
             $ipagent = mysql::array_result();
             
             if ($ipagent != md5($salt.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']))
             {
                 session_regenerate_id();
             }
         }
    }
}

function _close() {
    
}

function _read($id)
{
    $id = mysql::escape($id);
    mysql::query("SELECT `data` FROM `user_sessions` WHERE `id` = '".$id."'");
    if (mysql::num_result())
    {
        $data = mysql::array_result();
        return $data['data'];
    }
    return '';
}

function _write($id, $data)
{
    global $salt;
    
    $access = mysql::escape(time());
    $id = mysql::escape($id);
    $data = mysql::escape($data);
    $ipagent = mysql::escape(md5($salt.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));
    
    if(isset($_SESSION['uid']) && is_numeric($_SESSION['uid']) && $_SESSION['login'])
    {
        return mysql::query("REPLACE INTO `user_sessions` (`id`,`uid`, `access`,`data`,`ipagent`) VALUES ('".$id."','".$_SESSION['uid']."','".$access."','".$data."','".$ipagent."')");
        
    }
    else
    {
        return mysql::query("REPLACE INTO `user_sessions` (`id`,`access`,`data`,`ipagent`) VALUES ('".$id."','".$access."','".$data."','".$ipagent."')");
    }
}

function _destroy($id)
{
    $id = mysql::escape($id);

    return mysql::query("DELETE FROM `user_sessions` WHERE `id` = '".$id."'");
}

function _clean($max)
{
    $max = mysql::escape(time() - 1800);
    $i = mysql::query("SELECT * FROM `user_sessions` WHERE `access` < '".$max."'");
    
    while($id = mysql::array_result($i))
    {
        mysql::query("DELETE FROM `user_sessions` WHERE `id` = '".$id['id']."'");
        
        if($id['uid'] != 0)
        {
            mysql::query("INSERT INTO `user_log` (`uid`, `text`, `time`) VALUES ('".$id['uid']."', 'Wegen Inaktivität ausgeloggt.', '".time()."')");
        }
    }
    return true;
}

if(isset($_GET['SID']))
{
    session_id($_GET['SID']);
}

session_start();
?>