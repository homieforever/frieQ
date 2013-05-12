<?php
    abstract class mysql
    {
        private static $connection;
	private static $connected = false;
        private static $result;
	
	public function __construct() { }
 	
	public function __destuct()
	{
            if(self::$connected == true)
            {
                mysql_close(self::$connection);
            }
	}
        
	private static function connect()
	{
            if(self::$connected == false)
	    {
                self::$connection = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
		mysql_select_db(MYSQL_DATABASE, self::$connection);
		mysql_set_charset(MYSQL_CHARSET, self::$connection);
		self::$connected = true;
            }
	}
			
	public static function insert_id($sql = NULL)
	{
            $inc = '';
            if($sql === NULL)
            {
                $inc = self::$connection;
            }
            else 
            {
                $inc = $sql;
            }
        
            return mysql_insert_id($inc);
	}
	
	public static function query($query)
	{
            if(!empty($query) && trim($query) != "")
            {
                self::connect();
		self::$result = mysql_query($query, self::$connection) or Log::write("mysql", mysql_error());
	    }
        }
	
        public static function fetchArray($sql = NULL)
	{
            $inc = '';
            if($sql === NULL)
            {
                $inc = self::$result;
            }
            else 
            {
                $inc = $sql;
            }
            
            return mysql_fetch_array($inc);
        }
	
        public static function count($sql = NULL)
	{
            $inc = '';
            if($sql === NULL)
            {
                $inc = self::$result;
            }
            else 
            {
                $inc = $sql;
            }
            
            return mysql_num_rows($inc);
        }
    }
?>