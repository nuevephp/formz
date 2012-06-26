[[!FormIt?
	&hooks=`fmzForm_[[+method]],redirect`
	&redirectTo=`[[*id]]` [[- "Page ID"]]
	&redirectParams=`{"success":"1"}`
	&excludeFields=`submit`
	&formid=`[[+id]]` [[- "Form ID"]]
	&store=`1`
	&storeTime=`900`
	&emailTo=`[[+email:default=``]]`
	[[+validation:notempty=`&validate=`[[+validation]]``]]
	[[+validationText:notempty=`[[+validationText]]`]]
]]

[[+success:notempty=`<p>[[+success_message]]</p>`]]

[[!+fi.validation_error_message]]

<form class="form [[+identifier]]" action="" method="post">
	[[- [[!field? &type=`hidden` &outer_tpl=`` &name=`blank`]] ]]
	<fieldset>
		[[+fields]]
	</fieldset>

	<div class="actions">
		<input type="submit" name="submit" value="[[+action_button:default=`Submit`]]" class="btn primary" />
	</div>
</form>
