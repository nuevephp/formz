[[+type:is=`blank`:then=`
<input type="hidden" name="nospam:[[+id]]">
`:else=`
<div class="clearfix">
	<label for="id-[[+id]]">[[+label]]</label>
	<div class="input">
		[[!include? &file=`[[++formz.core_path]]elements/snippets/snippet.fmzfield.php` &type=`[[+type]]` &id=`[[+id]]` &formitprefix=`fi.` &default=`[[+default]]` &values=`[[+values]]`]]
		[[!+fi.error.[[+id]]]]
	</div>
</div>
`]]
