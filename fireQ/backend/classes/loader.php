<?php
    abstract class loader
    {
        public static $maps = array();
        
        static public function addAutoLoad($function = NULL)
        {
            if($function != NULL && is_callable($function))
            {
                return spl_autoload_register($function);
            }
            else
            {
                if($function == NULL)
                {
                    return spl_autoload_register("self::dafaultLoad");
                }
                else
                {
                    throw new Exception('loader->addAutoLoad(): Es wurde ein nicht gültiger Callback angegeben.');
                }
            }
        }
        
        static public function addMap($map = 0)
        {
            $values = array();
            if($map != 0)
            {
                 require_once SYS_PATH . "maps/".$map;
                 self::$maps = $values;
            }
            else
            {
                require_once SYS_PATH . "maps/class.php";
                self::$maps = $values;
            }
        }
        
        static public function unsetAutoLoad($function = NULL)
        {
            if($function != NULL)
            {
                return spl_autoload_unregister($function);
            }
            return false;
        }
        
        static public function dafaultLoad($classname = NULL)
        {
            if(file_exists(SYS_PATH . "classes/".strtolower($classname).".php") & $classname != NULL)
            {
                if(file_exists(SYS_PATH . "configs/".strtolower($classname).".php"))
                {
                    require_once SYS_PATH . "configs/".strtolower($classname).".php";
                }
                require_once SYS_PATH . "classes/".strtolower($classname).".php";
            }
        }
    }
?>