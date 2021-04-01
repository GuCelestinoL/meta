<?php
class connect {
	
	public static $connectedTo = NULL;

     public static function connectToDB() 
	 {
		 if(static::$connectedTo != 'global')
		 {
			 if (!mysql_connect($GLOBALS['connection']['host'],$GLOBALS['connection']['user'],$GLOBALS['connection']['password']))
				 buildError("<b>Erro de conexão com o Banco de Dados:</b> Não foi possível estabelecer uma conexão. Erro: ".mysql_error(),NULL);
			 static::$connectedTo = 'global';
		 }
	 }
	 
	 
	 public static function selectDB($db) 
	 {
         static::connectToDB();
		 
		 switch($db) {
			default: 
				mysql_select_db($db);
			break;
			case('webdb'):
				mysql_select_db($GLOBALS['connection']['webdb']);
			break;
		 }
		 mysql_query("SET NAMES 'utf8'");
		 mysql_query('SET character_set_connection=utf8');
		 mysql_query('SET character_set_client=utf8');
		 mysql_query('SET character_set_results=utf8');
		 
			 return TRUE;
	 }
}

  ##Unset Magic Quotes
  if (get_magic_quotes_gpc())
  {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process))
    {
        foreach ($val as $k => $v)
        {
            unset($process[$key][$k]);
            if (is_array($v))
            {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            }
            else
            $process[$key][stripslashes($k)] = stripslashes($v);
        }
    }
    unset($process);
    }
