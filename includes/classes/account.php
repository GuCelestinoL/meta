<?php
##############
##  Account functions goes here
##############

class account {

	###############################
	####### Log in method
	###############################
	public static function logIn($username,$password,$last_page,$remember)
	{
		if (!isset($username) || !isset($password) || $username=="Nome de Usuário..." || $password=="Senha...")
			echo '<span class="red_text">Por favor, insira os dois campos.</span>';
		else
		{
			$username = mysql_real_escape_string(trim(strtoupper($username)));
			$password = mysql_real_escape_string(trim(strtoupper($password)));

			connect::selectDB('webdb');
			$checkForAccount = mysql_query("SELECT COUNT(id) FROM account WHERE username='".$username."'");
			if (mysql_result($checkForAccount,0)==0)
				echo '<span class="red_text">Nome de Usuário inválido.</span>';
			else
			{
				if($remember!=835727313)
					$password = sha1("".$username.":".$password."");

				$result = mysql_query("SELECT id FROM account WHERE username='".$username."' AND sha_pass_hash='".$password."'");
				if (mysql_num_rows($result)==0)
					echo '<span class="red_text">Senha errada.</span>';
				else
				{
					if($remember=='on')
						setcookie("cw_rememberMe", $username.' * '.$password, time()+30758400);
						//Set "Lembrar de mim" cookie. Expira em 1 ano.

					$id = mysql_fetch_assoc($result);
					$id = $id['id'];

					$_SESSION['cw_user'] = ucfirst(strtolower($username));
					$_SESSION['cw_user_id'] = $id;

					connect::selectDB('webdb');
					$count = mysql_query("SELECT COUNT(*) FROM account_data WHERE id='".$id."'");
					if(mysql_result($count,0)==0)
						mysql_query("INSERT INTO account_data VALUES('".$id."','0','0')");

					if(!empty($last_page))
					   header("Location: ".$last_page);
					else
					   header("Location: index.php");
                    exit;
				}
			}

		}

	}

	public static function loadUserData()
	{
		//Unused function
		$user_info = array();

		connect::selectDB('webdb');
		$account_info = mysql_query("SELECT id, username, email, joindate, last_ip FROM account
		WHERE username='".$_SESSION['cw_user']."'");
		while($row = mysql_fetch_array($account_info))
		{
			$user_info[] = $row;
		}

	    return $user_info;
	}

	###############################
	####### Log out method
	###############################
	public static function logOut($last_page)
	{
		session_destroy();
		setcookie('cw_rememberMe', '', time()-30758400);
		if (empty($last_page))
		{
			header('Location: ?p=home"');
			exit();
		}
		header('Location: '.$last_page);
		exit();
	}


	###############################
	####### Registration method
	###############################
	public function register($username,$email,$password,$repeat_password,$captcha)
	{
		$errors = array();

		if (empty($username))
			$errors[] = 'Insira o Nome de Usuário.';

		if (empty($email))
			$errors[] = 'Insira o Endereço de E-mail.';

		if (empty($password))
			$errors[] = 'Insira a Senha.';

		if (empty($repeat_password))
			$errors[] = 'insira a Confirmação da Senha.';

		if($username==$password)
			$errors[] = 'Sua Senha não pode ser seu Nome de Usuário!';

		else
		{
			session_start();
			if($GLOBALS['registration']['captcha']==TRUE)
			{
				if($captcha!=$_SESSION['captcha_numero'])
					$errors[] = 'Código de Segurança incorreto!';
			}

			if (strlen($username)>$GLOBALS['registration']['userMaxLength'] || strlen($username)<$GLOBALS['registration']['userMinLength'])
				$errors[] = 'O Nome de Usuário deve ter entre '.$GLOBALS['registration']['userMinLength'].' e '.$GLOBALS['registration']['userMaxLength'].' letras e/ou números.';

			if (strlen($password)>$GLOBALS['registration']['passMaxLength'] || strlen($password)<$GLOBALS['registration']['passMinLength'])
				$errors[] = 'A senha deve ter entre '.$GLOBALS['registration']['passMinLength'].' e '.$GLOBALS['registration']['passMaxLength'].' letras e/ou números.';

			if ($GLOBALS['registration']['validateEmail']==true)
			{
			    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
				       $errors[] = 'Insira um Endereço de E-mail válido.';
			}

		}
		$username_clean = mysql_real_escape_string(trim($username));
		$password_clean = mysql_real_escape_string(trim($password));
		$username = mysql_real_escape_string(trim(strtoupper(strip_tags($username))));
		$email = mysql_real_escape_string(trim(strip_tags($email)));
		$password = mysql_real_escape_string(trim(strtoupper(strip_tags($password))));
		$repeat_password = trim(strtoupper($repeat_password));


		connect::selectDB('webdb');
		//Check for existing user
		$result = mysql_query("SELECT COUNT(id) FROM account WHERE username='".$username."'");
		if (mysql_result($result,0)>0)
			$errors[] = 'O Nome de Usuário já existe!';

		if ($password != $repeat_password)
			$errors[] = 'As Senhas não coincidem!';

		if (!empty($errors))
		{
			//errors found.
			echo "<p><h4>Ocorreram os seguintes erros:</h4>";
				foreach($errors as $error)
				{
					echo  "<strong>*", $error ,"</strong><br/>";
				}
			echo "</p>";
			exit();
		}
		else
		{
			$password = sha1("".$username.":".$password."");
			mysql_query("INSERT INTO account (username,email,sha_pass_hash,joindate)
			VALUES('".$username."','".$email."','".$password."','".date("Y-m-d H:i:s")."') ");

			$getID = mysql_query("SELECT id FROM account WHERE username='".$username."'");
			$row = mysql_fetch_assoc($getID);

			connect::selectDB('webdb');
			mysql_query("INSERT INTO account_data VALUES('".$row['id']."','','')");

			$result = mysql_query("SELECT id FROM account WHERE username='".$username_clean."'");
			$id = mysql_fetch_assoc($result);
			$id = $id['id'];

			$_SESSION['cw_user']=ucfirst(strtolower($username_clean));
			$_SESSION['cw_user_id']=$id;
		}

	}

	###############################
	####### Check if a user is logged in method.
	###############################
	public static function isLoggedIn()
	{
		if (isset($_SESSION['cw_user']))
        {
			header("Location: ?p=account");
            exit;
        }
	}


	###############################
	####### Check if a user is NOT logged in method.
	###############################
	public static function isNotLoggedIn()
	{
		if (!isset($_SESSION['cw_user']))
        {
	        header("Location: ?p=login&r=".$_SERVER['REQUEST_URI']);
            exit;
        }
	}


	###############################
	####### Return account ID method.
	###############################
	public static function getAccountID($user)
	{
		$user = mysql_real_escape_string($user);
		connect::selectDB('webdb');
		$result = mysql_query("SELECT id FROM account WHERE username='".$user."'");
		$row = mysql_fetch_assoc($result);
		return $row['id'];
	}

	public static function getAccountName($id)
	{
		$id = (int)$id;
		connect::selectDB('webdb');
		$result = mysql_query("SELECT username FROM account WHERE id='".$id."'");
		$row = mysql_fetch_assoc($result);
		return $row['username'];
	}


	###############################
	####### "Remember me" method. Loads on page startup.
	###############################
	public function getRemember()
	{
		if (isset($_COOKIE['cw_rememberMe']) && !isset($_SESSION['cw_user'])) {
			$account_data = explode("*", $_COOKIE['cw_rememberMe']);
			$this->logIn($account_data[0],$account_data[1],$_SERVER['REQUEST_URI'],835727313);
		}
	}
	

	###############################
	####### Return email method.
	###############################
	public static function getEmail($account_name)
	{
		$account_name = mysql_real_escape_string($account_name);
		connect::selectDB('webdb');
		$result = mysql_query("SELECT email FROM account WHERE username='".$account_name."'");
		$row = mysql_fetch_assoc($result);
		return $row['email'];
	}


	###############################
	####### Return Join date method.
	###############################
	public static function getJoindate($account_name)
	{
		$account_name = mysql_real_escape_string($account_name);
		connect::selectDB('webdb');
		$result = mysql_query("SELECT joindate FROM account WHERE username='".$account_name."'");
		$row = mysql_fetch_assoc($result);
		return $row['joindate'];
	}


	public static function changeEmail($email,$current_pass)
	{

		$errors = array();
		if (empty($current_pass))
			$errors[] = 'Por favor, insira sua Senha atual';
		else
		{
			if (empty($email))
				$errors[] = 'Por favor, insira um Endereço de E-mail.';

			connect::selectDB('webdb');
			$id = $_SESSION['cw_user_id'];
			$username = mysql_real_escape_string(trim(strtoupper($_SESSION['cw_user'])));
			$password = mysql_real_escape_string(trim(strtoupper($current_pass)));

			$password = sha1("".$username.":".$password."");

			$result = mysql_query("SELECT COUNT(id) FROM account WHERE id='".$id."' AND sha_pass_hash='".$password."'");
			if (mysql_result($result,0)==0)
				$errors[] = 'A Senha atual está incorreta.';


			if ($GLOBALS['registration']['validateEmail']==true)
			{
			    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
				    $errors[] = 'Insira um Endereço de E-mail válido.';
			}

		}
        echo '<div class="news" style="padding: 5px;">';
		if(empty($errors))
        {
            mysql_query("UPDATE account SET email='".$email."' WHERE id='".$_SESSION['cw_user_id']."'");
			echo '<h4 class="green_text">A sua Conta foi atualizada com sucesso</h4>';
        }
		else
		{
			echo '
			<h4 class="red_text">Ocorreram os seguintes erros:</h4>';
				   foreach($errors as $error)
				   {
					 echo  '<strong class="yellow_text">*', $error ,'</strong><br/>';
				   }
		}
        echo '</div>';
	}



	//Used for the change password page.
	public static function changePass($old,$new,$new_repeat)
	{
		//Check if all field values has been typed into
		if (!isset($_POST['cur_pass']) || !isset($_POST['new_pass']) || !isset($_POST['new_pass_repeat']))
			echo '<b class="red_text">Por favor, insira todos os campos!</b>';
	    else
		{
            $_POST['cur_pass']=mysql_real_escape_string(trim($old));
            $_POST['new_pass']=mysql_real_escape_string(trim($new));
            $_POST['new_pass_repeat']=mysql_real_escape_string(trim($new_repeat));

			//Check if new passwords match?
			if ($_POST['new_pass'] != $_POST['new_pass_repeat'])
				echo '<b class="red_text">As novas Senhas não coincidem!</b>';
			else
			{
			  if (strlen($_POST['new_pass']) < $GLOBALS['registration']['passMinLength'] ||
			      strlen($_POST['new_pass']) > $GLOBALS['registration']['passMaxLength'])
				  echo '<b class="red_text">Sua Senha deve ter entre 5 e 22 letras e/ou números.</b>';
			  else
			  {
				//Lets check if the old password is correct!
				$username = strtoupper(mysql_real_escape_string($_SESSION['cw_user']));
				connect::selectDB('webdb');
				$getPass = mysql_query("SELECT `sha_pass_hash` FROM `account` WHERE `id`='".$_SESSION['cw_user_id']."'");
				$row = mysql_fetch_assoc($getPass);
				$thePass = strtoupper($row['sha_pass_hash']);

				$pass = mysql_real_escape_string(strtoupper($_POST['cur_pass']));
				$pass_hash = strtoupper(sha1($username.':'.$pass));

				$new_pass = mysql_real_escape_string(strtoupper($_POST['new_pass']));
				$new_pass_hash = sha1($username.':'.$new_pass);

				if ($thePass != $pass_hash)
					echo '<b class="red_text">A Senha atual está incorreta!</b>';
				else
				{
					//success, change password
					echo 'Sua Senha foi alterada!';
                    if (isset($_COOKIE['cw_rememberMe']))
                        setcookie("cw_rememberMe", $username.' * '.$new_pass, time()+30758400);
					mysql_query("UPDATE account SET sha_pass_hash='".$new_pass_hash."' WHERE id='".$_SESSION['cw_user_id']."'");
				}
			}
		  }
		}
	}

	public static function changePassword($account_name,$password)
	{
			$username = mysql_real_escape_string(strtoupper($account_name));
			$pass = mysql_real_escape_string(strtoupper($password));
			$pass_hash = sha1($username.':'.$pass);

			connect::selectDB('webdb');
			mysql_query("UPDATE `account` SET `sha_pass_hash`='{$pass_hash}' WHERE `id`='".$_SESSION['cw_user_id']."'");

			account::logThis("Senha alterada","passwordchange",NULL);
	}

	public static function changeForgottenPassword($account_name,$password)
	{
			connect::selectDB('webdb');
			$username = mysql_real_escape_string(strtoupper($account_name));
			$result = mysql_query("SELECT * FROM account WHERE username='".$username."'");
			$row = mysql_fetch_array($result);

			if($row)
			{
				$password = strtoupper($password);
				$password_hash = mysql_real_escape_string(sha1($username.':'.$password));

				connect::selectDB('webdb');
				mysql_query("UPDATE `account` SET `sha_pass_hash`='".$password_hash."' WHERE `id`='".$row['id']."'");
				account::logThis($account_name." Senha recuperada com sucesso","passwordrecoverd",NULL);
			}
	 }

	public static function forgotPW($account_name, $account_email)
	{
		$account_name = mysql_real_escape_string($account_name);
		$account_email = mysql_real_escape_string($account_email);

		if (empty($account_name) || empty($account_email))
			echo '<b class="red_text">Por favor, insira os dois campos.</b>';
		else
		{
			connect::selectDB('webdb');
			$result = mysql_query("SELECT COUNT('id') FROM account
								   WHERE username='".$account_name."' AND email='".$account_email."'");

			if (mysql_result($result,0)==0)
				echo '<b class="red_text">O Nome de Usuário ou Endereço de E-mail estão incorretos.</b>';
			else
			{
				//Success, lets send an email & add the forgotpw thingy.
				$code = RandomString();
				$emailSent = website::sendEmail($account_email,$GLOBALS['default_email'],'Esqueceu sua senha',"
				Olá. <br/><br/>
				A redefinição de Senha foi solicitada para a Conta ".$account_name." <br/>
				Se você deseja redefinir sua Senha, clique no link abaixo: <br/>
				<a href='".$GLOBALS['website_domain']."?p=forgotpw&code=".$code."&account=".account::getAccountID($account_name)."'>
				".$GLOBALS['website_domain']."?p=forgotpw&code=".$code."&account=".account::getAccountID($account_name)."</a>

				<br/><br/>

				Se você não solicitou isso, basta ignorar e deletar essa mensagem.<br/><br/>
				Atenciosamente, Administração.");
                if ($emailSent)
                {
				    $account_id = self::getAccountID($account_name);
				    connect::selectDB('webdb');

				    mysql_query("DELETE FROM password_reset WHERE account_id='".$account_id."'");
				    mysql_query("INSERT INTO password_reset (code,account_id)
				    VALUES ('".$code."','".$account_id."')");
				    echo "Um e-mail contendo o link para redefinir sua senha foi enviado para o Endereço de E-mail que você especificou.
					      Se você já enviou outros pedidos de Redefinição de Senha antes desse, eles não irão funcionar. <br/>";
                }
                else
                {
                    echo '<h4 class="red_text">Falha ao enviar o e-mail! (Verifique os registros de erro para obter mais detalhes)</h4>';
                }
			}
		}
	}
}