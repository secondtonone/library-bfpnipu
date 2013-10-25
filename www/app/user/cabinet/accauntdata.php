  <?php require_once '../../scripts/startsession.php';?>
  <form id="acc">
	<div class="field">
		<label>Почта:</label>
        <div class="input"><input type="text" id="email" value="<?php echo $_SESSION["email"]; ?>" /></div>
	</div>	

	<div class="field">
		<label>Новый пароль:</label>
        <div class="input"><input type="password" id="password" /></div>
	</div>
    	<div class="field">
		<label>Повторите новый пароль:</label><div class="input"><input type="password" id="rpassword" /></div>
        <input type="text" hidden="hidden" id="hide" value="acc"/>
      	</div>
		<div class="submitbutton">
		<button type="submit">Редактировать</button>
        </div>
         </form>

