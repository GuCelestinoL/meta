<?php if(isset($_SESSION['cw_user'])) { ?>
<div class="box_one">
<div class="box_one_title">Gerenciamento de Contas</div>
<span style="z-index: 99;">Bem vindo(a) de volta,  <?php echo $_SESSION['cw_user']; ?></span>
			<hr/>
            <input type='button' value='Painel da Conta' onclick='window.location="?p=account"' class="leftbtn">
			<input type='button' value='Alterar Senha'  onclick='window.location="?p=changepass"' class="leftbtn">
            <input type='button' value='Sair'  
            onclick='window.location="?p=logout&last_page=<?php echo $_SERVER["REQUEST_URI"]; ?>"' class="leftbtn">
</div>
			<?php } ?>
