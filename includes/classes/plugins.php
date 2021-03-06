<?php
class plugins 
{
	public static function init($type)
	{
		if($GLOBALS['enablePlugins']==true)
		{
			if($_SESSION['loaded_plugins']!=NULL)
			{
				$bad = array('.','..','index.html');
				$loaded = array();
				foreach($_SESSION['loaded_plugins'] as $folderName)
				{	
					connect::selectDB('webdb');
					$chk = mysql_query("SELECT COUNT(*) FROM disabled_plugins WHERE foldername='".mysql_real_escape_string($folderName)."'");
					if(mysql_result($chk,0)==0 && file_exists('plugins/' . $folderName . '/'. $type . '/'))
					{	
						$folder = scandir('plugins/' . $folderName . '/'. $type . '/');
						
						foreach($folder as $fileName)
						{
							if(!in_array($fileName,$bad))
								$loaded[] = 'plugins/' . $folderName . '/'. $type . '/'.$fileName;
						}
						
						$_SESSION['loaded_plugins_' . $type] = $loaded;
					}
				}
			}
		}
	}
	
	public static function load($type)
	{
        if($GLOBALS['enablePlugins']==true && isset($_SESSION['loaded_plugins_' . $type]))
		{
		  ##########################
		  if($type == 'pages')
		  {	
		  		$count = 0;
				foreach($_SESSION['loaded_plugins_' . $type] as $filename)
				{
					$name = basename(substr($filename,0,-4));
					if($name == $_GET['p'])
					{
						include($filename);
						$count = 1;
					}
				}
				if($count == 0)
					include('pages/404.php');	  
			}
			###########################
			elseif($type == 'javascript')
			{
				foreach($_SESSION['loaded_plugins_' . $type] as $filename)
				{
					echo '<script type="text/javascript" src="'.$filename.'"></script>';
				}
			}
			###########################
			elseif($type == 'styles')
			{
				foreach($_SESSION['loaded_plugins_' . $type] as $filename)
				{
					echo '<link rel="stylesheet" href="'.$filename.'" />';
				}
			}
			###########################
			elseif($type == 'classes')
			{
				foreach($_SESSION['loaded_plugins_' . $type] as $filename)
				{
					include($filename);
				}
			}
		}
	}
}

?>