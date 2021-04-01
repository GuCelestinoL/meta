<?php 
account::isNotLoggedIn();

echo "<h2>Sair</h2>";

account::logOut($_GET['last_page']);
?>