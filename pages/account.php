<?php 
account::isNotLoggedIn();
?>
<div class='box_two_title'>Minha Conta</div>
<table style="width: 100%; margin-top: -15px;">
<tr>
<td><span class='blue_text'>Nome da conta</span></td><td> <?php echo ucfirst(strtolower($_SESSION['cw_user']));?></td>
<?php $date = date_create(account::getJoindate($_SESSION['cw_user'])); ?>
<td><span class='blue_text'>Registrado em</span></td><td><?php echo date_format($date, "d/m/Y à\s H:i:s"); ?></td>
</tr>
<tr>
    <td><span class='blue_text'>Endereço de e-mail</span></td><td><?php echo account::getEmail($_SESSION['cw_user']);?></td>
</tr>
<br/>
</table>
 </div>
<div class='box_two'>      
      <div class='box_two_title'>Serviços</div>
     <div id="account_func_placeholder">       
			  <div class='account_func' onclick="acct_services('settings')">Configurações</div>
              
              <div class='hidden_content' id='settings'>
              
                     <div class='service' onclick='redirect("?p=changepass")'>
                     <div class='service_icon'><img src='styles/global/images/icons/arena.png'></div>
                     <h3>Alterar Senha</h3>
                     <div class='service_desc'>Altere a senha de sua conta</div>
                     </div>
                 
                     <div class='service' onclick='redirect("?p=settings")'>
                     <div class='service_icon'><img src='styles/global/images/icons/ptr.png'></div>
                     <h3>Alterar E-mail</h3>
                     <div class='service_desc'>Altere o endereço de e-mail associado à sua conta</div> 
                     </div>
              
              </div>
      </div>