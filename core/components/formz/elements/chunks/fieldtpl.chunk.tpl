[[+type:is=`text`:or:is=`textarea`:then=`
	[[!field? &type=`[[+type]]` &name=`[[+id]]` &label=`[[+label]]` &req=`[[+required]]` ]]
`:else=`
	[[!field? &type=`[[+type]]` &name=`[[+id]]` &label=`[[+label]]` &array=`1` &options=`[[+values]]` &default=`[[+default]]`]]
`]]
