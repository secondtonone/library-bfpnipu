<div id="ppl">
    <div class="field">
		<label>Фамилия: <div class="formline"><?php echo $_SESSION["fam"]; ?></div></label>
	</div>
        <div class="field">
  		<label>Имя: <div class="formline"><?php echo $_SESSION["realname"]; ?></div></label>	
	</div>
        <div class="field">
		<label>Отчество: <div class="formline"><?php echo $_SESSION["otchestvo"]; ?></div></label>
	</div>
    <div class="field">
   	<label>Телефон домашний: <div class="formline"><?php echo $_SESSION["telefon_dom"]; ?></div></label>
		</div>
	<div class="field">
		<label>Телефон сотовый: <div class="formline"> <?php echo $_SESSION["telefon_sot"]; ?></div></label>
		</div>
    	<div class="field">
		<label>Электронная почта: <div class="formline"> <?php echo $_SESSION["e_mail"]; ?></div></label>
	</div>
    	<div class="field">
		<label>Рабочий телефон: <div class="formline"><?php echo $_SESSION["telefon_rabochii"]; ?></div></label>
	</div>
	<div class="submitbutton">
		<button class="perchange" type="button">Редактировать</button>
       </div>
</div>