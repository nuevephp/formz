[[!FormIt?
	&hooks=`redirect`
	&validationErrorMessage=`<div class="alert-message block-message error span7"><p>A form validation error occurred. Please check the values you have entered.</p></div>`
    &errTpl=`<div class="error">[[+error]]</div>`
	&redirectTo=`14`
	&store=`1`
	&storeTime=`900`
	[[+validation:notempty=`&validate=`[[+validation]]``]]
	[[+validationText:notempty=`[[+validationText]]`]]
]]

[[!+fi.validation_error_message]]

<form class="form [[+identifier]]" action="" method="post">
	[[!field? &type=`hidden` &outer_tpl=`` &name=`blank`]]
	<fieldset>
		[[+fields]]
	</fieldset>

	<div class="actions">
		<input type="submit" name="next" value="Submit" class="btn primary" />
	</div>
</form>
