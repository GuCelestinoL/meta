$(document).ready(function() 
{
	$('#popup').center();
});

$(".login_input").focus(function() 
{
	if(this.value=="Nome de Usuário...") 
	{
		this.value="";
	} 
	else if(this.value="Senha...") 
	{
		this.value="";
	}
});

$(".content_hider").click(function() 
{
	$(this).toggleClass("content_hider_highlight");
	if($(this).next().is(":hidden")) 
		{
			 $(this).next().slideDown("fast");
		} 
		else 
		{
          $(this).next().slideUp("fast");
		}
});

function redirect(url) 
{
	$("#overlay").fadeIn("fast");
	window.location=url; 
}


(function($){
    $.fn.extend({
        center: function () {
            return this.each(function() {
                var top = ($(window).height() - $(this).outerHeight()) / 2;
                var left = ($(window).width() - $(this).outerWidth()) / 2;
                $(this).css({position:'absolute', margin:0, top: (top > 0 ? top : 0)+'px', left: (left > 0 ? left : 0)+'px'});
            });
        }
    }); 
})(jQuery);

function popUp(title,content) 
{
	$("#overlay").fadeIn("fast");
	$("#popup").fadeIn("slow");
	$("#popup_close").fadeIn();
	$("#popup_title").html(title + '<div id="popup_close" onclick="closePopup()"></div>');
	$("#popup_body").html("<span class='yellow_text'>" + content + "</span>");
    $('#popup').center();
	var height = $(document).height();
	$("#overlay").css("height",height + "px");
}

function closePopup() 
{
	$("#overlay").fadeOut();
	$("#popup").fadeOut();
}

function register(captchastate) 
{
	$("#overlay").fadeIn();
	$('#register').attr('disabled','disabled');

	var username = document.getElementById("username").value;
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	var password_repeat = document.getElementById("password_repeat").value;	
	
	if(captchastate==1) 
	{
		var captcha = document.getElementById("captcha").value;	
	}
	else
	{
		var captcha = 0;
	}
	
	popUp("Criação de Conta","Sua conta está sendo registrada...");
	
	 $.post("includes/scripts/register.php", { register: "true", username: username,email: email,password: password,
	 password_repeat: password_repeat, captcha: captcha },
               function(data) 
			   {
				   if(data==true) 
				   {
					   popUp("Conta Criada","Sua conta foi criada com sucesso. Você será redirecionado para a página de sua conta em 5 segundos...");
					   $("#username").val("");
					   $("#email").val("");
					   $("#password").val("");
					   $("#password_repeat").val("");
					   setTimeout ( "redirect('?p=account')", 5000 );
				   } 
				   else 
				   {
				       popUp("Criação de Conta", data);
					   $('#register').removeAttr('disabled');
				   }
			   });
}

function checkUsername() 
{
   var username = document.getElementById("username").value;
   
   $("#username_check").fadeIn();
   $("#username_check").html("Verificando disponibilidade...");
   
    $.post("includes/scripts/register.php", { check: "username", value: username },
               function(data) 
			   {
				    $("#username_check").html(data);
			   });
}

function acct_services(service) 
{
		$("#character").hide();
		$("#account").hide();
		$("#settings").hide();
		
		$("#" + service ).fadeIn(400);
 }

function removeNewsComment(id) 
{
	popUp("Remover Comentário","Você tem certeza de que deseja remover este comentário?<br/><br/>\
	<input type='button' value='Sim' onclick='removeNewsCommentNow(" + id + ")'> \
	<input type='button' value='Não' onclick='closePopup()'>");
}

function removeNewsCommentNow(id) 
{
	popUp("Remover comentário","Removendo...");
	$.post("includes/scripts/misc.php", { action: "removeComment", id: id},
		function(data) {
		 closePopup()
		 $("#comment-" + id).fadeOut(); 
	});
}

function editNewsComment(id)
{
	popUp("Editar comentário","Coletando dados...");
	
	$.post("includes/scripts/misc.php", { action: "getComment", id: id},
	function(data) {
		  popUp("Editar Comentário","<textarea rows='4' id='editCommentContent'>"+data+"</textarea><br/>\
		  <input type='button' value='Salvar' onclick='editNewsCommentNow("+id+")'>");   
	});
}

function editNewsCommentNow(id)
{
	var content = document.getElementById("editCommentContent").value;
	
	popUp("Editar comentário","Salvando...");
	
	$.post("includes/scripts/misc.php", { action: "editComment", id: id, content: content},
	function(data) {
		$("#comment-" + id + "-content").html(content); 
		$("#popup").fadeOut();
		$("#overlay").fadeOut();
	});
}
