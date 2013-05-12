<?php
    abstract class log
    {
        static protected $count_errors;
        static protected $logs;
        
        protected function __construct()
        {
            self::$logs = array();
            self::$count_errors = 0;
        }
        
        public static function add_log($log = array(0, "Some error text"))
        {
            if(isset($log[0]) && isset($log[1]) && $log[0])
            {
                self::$count_errors++;
                self::$logs[self::$count_errors] = $log;
            }
        }
        
        public static function write_file($log, $type)
        {
            if(is_writable(SYS_PATH . "/logs/".$type.".txt")) 
            {
                if (!$handle = fopen(SYS_PATH . "/logs/".$type.".txt", "a"))
                {
                    exit;
                }
                if (!fwrite($handle, $log)) 
                {
                    exit;
                }
                fclose($handle);
            } 
        }
        
        public static function write_log()
        {
            $i = 1;
            while($i <= self::$count_errors)
            {
                if(self::$logs[$i][0])
                {
                    self::write_file(self::$logs[$i][1], "error");
                }
                else if(!self::$logs[$i][1] && DEBUG)
                {
                    self::write_file(self::$logs[$i][1], "info");
                }
                $i++;
            }
        }
    }
?>