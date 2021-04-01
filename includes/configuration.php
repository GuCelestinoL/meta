<?php
	if(!defined('INIT_SITE'))
		exit();
		
	#############################
	## CONFIG FILE             ##
	## ------------------------##
	## Please note that:       ##
	## true = Enabled          ##
	## false = Disabled        ##
	#############################
	
	/*************************/
	/* General settings      
	/*************************/
	 $website_title = 'META'; //The title of your website, shown in the users browser.
	 
	 $default_email = '#'; //The default email address from wich Emails will be sent.

	 $website_domain = 'http://erictemponi.servegame.com'; //Provide the domain name AND PATH to your website.
	 //Example: http://yourserver.com/
	 //If you have your website in a sub-directory, include that aswell. Ex: http://yourserver.com/cataclysm/
	 
	 $showLoadTime = true; 
	 //Shows the page load time in the footer.
	 
	 $footer_text = 'Copyright &copy; Fury WoW 2020<br/>
	 Todos os direitos reservados'; //Set the footer text, displayed at the bottom.
	 //Tips: &copy; = Copyright symbol. <br/> = line break.
	 
	 $timezone = 'America/Sao_Paulo'; //Set the time zone for your website. Default: America/Sao_Paulo (GMT -3)
	 //Full list of supported timezones can be found here: http://php.net/manual/en/timezones.php
	 
	$enablePlugins = true; //Enable or disable the use of plugins. Plugins May slow down your site a bit.
	 
	/*************************/
	/* Slideshow settings 
	/*************************/
	$enableSlideShow = true; //Enable or Disable the slideshow. This will only be shown at the home page. 
	
	/*************************/
	/* Website compression settings    
	/*************************/
	
	$compression['gzip'] = true; //This is very hard to explain, but it may boost your website speed drastically.
	$compression['sanitize_output'] = true; //This will strip all the whitespaces on the HTML code written. This should increase the website speed slightly. 
	//And "copycats" will have a hard time stealing your HTML code :>
	
	$useCache = false; //Enable / Disable the use of caching. It's in early developement and is currently only applied to very few things in the core at the moment.
	//You will probably not notice any difference when enabling this, unless you have alot of visitors. Who knows, I havent tried.
	
	
	/*************************/
	/* News settings   
	/*************************/
	$news['enable'] = true; // Enable/Disable the use of the news system at the homepage. 
	$news['maxShown'] = 3; //Maximum amount of news posts that will be shown on the home page.
							 //People can still view all posts by clicking the "All news" button.
	$news['enableComments'] = true; //Make people able to comment on your news posts.
	$news['limitHomeCharacters'] = false; //This will limit the characters shown in the news post. People will have to click the "Leia mais..." button
	//to read the whole news post. 
	
	
	/*************************/
	/* mySQL connection settings
	/*************************/
	
	$connection['host'] = 'localhost:3306';
	$connection['user'] = 'root';
	$connection['password'] = 'ascent';
	$connection['webdb'] = 'meta';
	
	// host = Either an IP address or a DNS address
	// user = A mySQL user with access to view/write the entire database.
	// password = The password for the user you specified
	// webdb = The name of the database with CraftedWeb data. Default: craftedweb


	/*************************/
	/* Registration settings
	/*************************/
	$registration['userMaxLength'] = 16;
	$registration['userMinLength'] = 3;
	$registration['passMaxLength'] = 22;
	$registration['passMinLength'] = 5;
	$registration['validateEmail'] = false;
	$registration['captcha'] = true;
	
	//userMaxLength = Maximum length of usernames
	//userMinLength = Minimum length of usernames
	//passMaxLength = Maximum length of passwords
	//passMinLength = Minimum length of passwords
	//validateEmail = Validates if the email address is a correct email address. May not work on some PHP versions.
	//captcha = Enables/Disables the use of the captcha (Anti-bot) 



	/************************/
	$core_pages = array('Painel da Conta' => 'account.php',
	'Alterar Senha' => 'changepass.php',
	'Esqueceu sua Senha' => 'forgotpw.php','Início' => 'home.php','Sair' => 'logout.php',
	'Notícias' => 'news.php','Registrar' => 'register.php',
	'Configurações da Conta' => 'settings.php');
	
	//Set the timezone.
	date_default_timezone_set($GLOBALS['timezone']);
	
	//Set the error handling.
	if(file_exists('includes/classes/error.php'))
		require('includes/classes/error.php');
		
	elseif(file_exists('../classes/error.php'))
		require('../classes/error.php');
		
	elseif(file_exists('../includes/classes/error.php'))
		require('../includes/classes/error.php');
	
	elseif(file_exists('../../includes/classes/error.php'))
		require('../../includes/classes/error.php');
	
	elseif(file_exists('../../../includes/classes/error.php'))
		require('../../../includes/classes/error.php');
	
	loadCustomErrors(); //Load custom errors
?>