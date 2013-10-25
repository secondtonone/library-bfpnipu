<?php require_once '../../scripts/startsession.php';?>
<form id="ppl">
	<div class="field">
		<label>Телефон домашний:</label><div class="input"><input type="text" id="telephone" value="<?php echo $_SESSION["telefon_dom"]; ?>"/></div>
	</div>		

	<div class="field">
		<label>Телефон сотовый:</label><div class="input"><input type="text" id="mobile" value="<?php echo $_SESSION["telefon_sot"]; ?>" /></div>
	</div>
		
	
    	<div class="field">
		<label>Электронная почта:</label><div class="input"><input type="text" id="email" value="<?php echo $_SESSION["e_mail"]; ?>"/></div>
	</div>
		
	
    	<div class="field">
		<label>Рабочий телефон:</label><div class="input"><input type="text" id="workphone" value="<?php echo $_SESSION["telefon_rabochii"]; ?>" />
        </div>
         <input type="text" hidden="hidden" id="hide" value="ppl"/>
	</div>
		

	<div class="submitbutton">
		<button type="submit">Сохранить</button>
</div>

</form>

