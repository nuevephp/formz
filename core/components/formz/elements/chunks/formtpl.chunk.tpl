[[!FormIt?
	&hooks=`[[+action]][[+hooks:notempty=`,[[+hooks]]`]]`
	&excludeFields=`submit[[+id]]`
    &submitVar=`submit[[+id]]`
	&formid=`[[+id]]` [[- "Form ID"]]
	&store=`1`
	&storeTime=`900`
	&successMessage=`<p>[[+success_message]]</p>`
	&emailTo=`[[+email:default=``]]`
    [[+properties]]
	[[+validation:notempty=`&validate=`[[+validation]]``]]
	[[+validationText:notempty=`[[+validationText]]`]]
]]

[[!+fi.successMessage]]
[[!+fi.validation_error_message]]

<form class="form [[+identifier]]" action="" method="post">
	<fieldset>
		[[+fields]]
	</fieldset>

	<div class="actions">
		<input type="submit" name="submit[[+id]]" value="[[+action_button:default=`Submit`]]" class="btn primary" />
	</div>
</form>
