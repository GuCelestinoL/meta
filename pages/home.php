<?php
     website::getNews();
	 
	 if ($GLOBALS['enableSlideShow']==false && $GLOBALS['news']['enable']==false)  
	 {
		 buildError("<b>Erro no arquivo de Configuração.</b>Tanto o slideshow quanto as notícias estão desativados, a página está vazia.");
		 echo "Parece que a página está vazia!";
	 }
