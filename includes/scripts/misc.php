<?php
require('../ext_scripts_class_loader.php');

#################
if(isset($_POST['action']) && $_POST['action']=='getComment') 
{
   connect::selectDB('webdb');
   $result = mysql_query("SELECT `text` FROM news_comments WHERE id='".(int)$_POST['id']."'");
   $row = mysql_fetch_assoc($result);
   echo $row['text'];
}
?>
