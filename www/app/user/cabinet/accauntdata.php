  <?php require_once '../../scripts/startsession.php';?>
  <form id="acc">
	<div class="field">
		<label>Почта:</label>
        <div class="input"><input type="mail" id="email" required maxlength="35" placeholder="Введите электронный адрес" title="Например: example@mymail.ru" value="<?php echo $_SESSION["email"]; ?>" ></div>
	</div>	

	<div class="field">
		<label>Новый пароль:</label>
        <div class="input"><input type="password" id="password"  maxlength="20" pattern="^[a-zA-Z0-9]+$" placeholder="Введите новый пароль" title="Должен содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов."></div>
	</div>
    	<div class="field">
		<label>Повторите новый пароль:</label><div class="input"><input type="password" id="rpassword" maxlength="20" pattern="^[a-zA-Z0-9]+$" placeholder="Повторите новый пароль" title="Должен содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов."></div>
        <input type="text" hidden="hidden" id="hide" value="acc">
      	</div>
		<div class="submitbutton">
		<button type="submit">Сохранить</button>
        <button class="denied" type="button">Отмена</button>
        </div>
         </form>

