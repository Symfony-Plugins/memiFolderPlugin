<?php echo form_tag('seguridad/login') ?>
<h2 class="title-03">AUTENTICACIÓN DE USUARIOS</h2>
<form> 
  <fieldset>
 
  <div class="form-row">
    <label for="nickname" class="title-04">nickname:</label>
    <?php echo input_tag('nickname', $sf_params->get('nickname')) ?>
  </div>
 
  <div class="form-row">
    <label for="password" class="title-04">password:</label>
    <?php echo input_password_tag('password') ?>
  </div>
 
  </fieldset>
 
  <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
  <?php echo submit_tag('sign in') ?>
</form>