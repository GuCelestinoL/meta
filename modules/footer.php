<?php 
if($GLOBALS['showLoadTime']==TRUE) 
{
	$end = number_format((microtime(true) - $GLOBALS['start']),2);
	if ($end == 1)
		echo "Página carregada em ", $end, " segundo. <br/>";
	else
		echo "Página carregada em ", $end, " segundos. <br/>";
}