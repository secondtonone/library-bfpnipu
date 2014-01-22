<?php require_once '../../scripts/startsessionstudent.php';?>
<form id="ppl">
	<div class="field">
<label>Фамилия:</label><div class="input"><input type='text' id='fam' maxlength="35" placeholder="Введите свою фамилию" title="Должна начинаться с заглавной и содержать только русские буквы." value="<?php echo $_SESSION["fam"]; ?>"></div>
	</div>
	<div class="field">
<label>Имя:</label><div class="input"><input type='text' id='name' maxlength="35" placeholder="Введите своё имя" title="Должно начинаться с заглавной и содержать только русские буквы." value="<?php echo $_SESSION["realname"]; ?>"></div>
	</div>
    	<div class="field">
<label>Отчество:</label><div class="input"><input type='text' id='otch' maxlength="35" placeholder="Введите своё отчество" title="Должно начинаться с заглавной и содержать только русские буквы." value="<?php echo $_SESSION["otchestvo"]; ?>"></div>
	</div>
	<div class="field">
		<label>Телефон домашний:</label><div class="input"><input type="text" id="telephone" pattern="^[0-9]+$"  placeholder="Введите номер домашнего телефона" maxlength="10" title="Должен содержать только цифры без других символов."  value="<?php echo $_SESSION["telefon_dom"]; ?>"></div>
	</div>		
	<div class="field">
		<label>Телефон сотовый:</label><div class="input"><input type="text" id="mobile" pattern="^[0-9]+$" maxlength="13"  placeholder="Введите номер сотогого телефона" title="Должен содержать только цифры без других символов."  value="<?php echo $_SESSION["telefon_sot"]; ?>" ></div>
	</div>
    	<div class="field">
		<label>Рабочий телефон:</label><div class="input"><input type="text" id="workphone" pattern="^[0-9]+$" maxlength="10" placeholder="Введите номер рабочего телефона" title="Должен содержать только цифры без других символов."  value="<?php echo $_SESSION["telefon_rabochii"]; ?>" >
        </div>
         <input type="text" hidden="hidden" id="hide" value="ppl">
	</div>
<div class="submitbutton">
		<button type="submit">Сохранить</button>
         <button class="denied" type="button">Отмена</button>
</div>

</form>

