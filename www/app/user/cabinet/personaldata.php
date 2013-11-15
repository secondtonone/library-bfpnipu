<?php require_once '../../scripts/startsession.php';?>
<form id="ppl">
	<div class="field">
		<label>Телефон домашний:</label><div class="input"><input type="text" id="telephone" pattern="^[0-9]+$"  placeholder="Введите номер домашнего телефона" maxlength="10" value="<?php echo $_SESSION["telefon_dom"]; ?>"></div>
	</div>		

	<div class="field">
		<label>Телефон сотовый:</label><div class="input"><input type="text" id="mobile" pattern="^[0-9]+$" maxlength="13"  placeholder="Введите номер сотогого телефона" value="<?php echo $_SESSION["telefon_sot"]; ?>" ></div>
	</div>
		
	
    	<div class="field">
		<label>Электронная почта:</label><div class="input"><input type="mail" id="email" maxlength="35" placeholder="Введите адрес электронной почты" value="<?php echo $_SESSION["e_mail"]; ?>"></div>
	</div>
		
	
    	<div class="field">
		<label>Рабочий телефон:</label><div class="input"><input type="text" id="workphone" pattern="^[0-9]+$" maxlength="10" placeholder="Введите номер рабочего телефона" value="<?php echo $_SESSION["telefon_rabochii"]; ?>" >
        </div>
         <input type="text" hidden="hidden" id="hide" value="ppl">
	</div>
		

	<div class="submitbutton">
		<button type="submit">Сохранить</button>
</div>

</form>

