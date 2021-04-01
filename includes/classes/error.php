<?php
function buildError($error,$num) 
{
	errors($error,$num);
}

function errors($error,$num) 
{
	log_error(strip_tags($error),$num);
	die("<center><b>Erro de site</b>  <br/>
		O script do site encontrou um erro e parou de funcionar. <br/><br/>
		<b>Mensagem de erro: </b>".$error."  <br/>
		<b>Número do erro: </b>".$num."
		");
}

function loadCustomErrors() 
{
  set_error_handler("customError");   
}

function customError($errno, $errstr)
{
    if ($errno!=8 && $errno!=2048) 
          error_log("*[".date("d M Y H:i")."] ".$errstr."\r\n", 3, "error.log");
}
?>