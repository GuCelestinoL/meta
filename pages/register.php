<div class='box_two_title'>Registrar</div>
Junte-se a nós e venha se divertir! 
<hr/>
<?php 
account::isLoggedIn();
if (isset($_POST['register'])) {
	account::register($_POST['username'],$_POST['email'],$_POST['password'],$_POST['password_repeat'],$_POST['captcha']);
} 
?>
<table width="80%">
        <tr>
             <td align="right">Nome de Usuário:</td> 
             <td><input type="text" id="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" onkeyup="checkUsername()"/>
             <br/><span id="username_check" style="display:none;"></span></td>
        </tr>
        <tr>
             <td align="right">E-mail:</td> 
             <td><input type="text"  id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/></td>
        </tr>
         <tr>
             <td align="right">Senha:</td> 
             <td><input type="password"  id="password" /></td>
        </tr>
        <tr>
             <td align="right">Confirmar Senha:</td> 
             <td><input type="password"  id="password_repeat" /></td>
        </tr>
        <?php
		if($GLOBALS['registration']['captcha']==TRUE) { 
			$_SESSION['captcha_numero']= rand(0000,9999);
		?>
			<tr>
                <td align="right"></td>
                <td><img src="includes/misc/captcha.php" /></td>
            </tr>
            <tr> 
                <td align="right">Código de Segurança:</td>
                <td><input type="text" id="captcha" /></td>
            </tr>
		<?php }
		?>
        <tr>
        	<td></td>
            <td><hr/></td>
        </tr>
        
        <tr>
            <td></td>
            <td>
          		<input type="submit" value="Registrar" onclick="register(<?php if($GLOBALS['registration']['captcha']==TRUE)  echo 1;  else  echo 0; ?>)" 
                id="register"/> 
            <br/>
        </tr>
 </table>
 <script type="text/javascript">
 	document.onkeydown = function(event) 
	{
		var key_press = String.fromCharCode(event.keyCode);
		var key_code = event.keyCode;
		if(key_code == 13)
			{
				register(<?php if($GLOBALS['registration']['captcha']==TRUE)  echo 1;  else  echo 0; ?>)
			}
	}
 </script>
 
