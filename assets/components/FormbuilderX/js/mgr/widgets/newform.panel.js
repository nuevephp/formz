FormbuilderX.panel.NewForm = function (config) {
	config = config || {record: {}};
	config.record = config.record || {};
	config.create_update = FormbuilderX.utils.isEmpty(config.record) ? false : true;

	var tbs = [];

	tbs.push({
		title: _('FormbuilderX.form.general')
		,defaults: {
			border: false
			,autoHeight: true
			,msgTarget: 'side'
		}
		,layout: 'form'
		,labelWidth: 80
		,items: [{
			html: '<p>' + _('FormbuilderX.form.create_edit_desc') + '</p>'
			,bodyCssClass: 'panel-desc'
		}, {
			layout: 'form'
			,cls: 'main-wrapper'
			,border: false
			,anchor: '98%'
			,defaults: {
				layout: 'form'
			}
			,items: [{
				xtype: 'textfield'
				,fieldLabel: _('name')
				,name: 'name'
				,anchor: '30%'
				,allowBlank: false
			}, {
				xtype: 'formbuilderx-combo-method'
				,fieldLabel: _('FormbuilderX.form.method')
				,name: 'method'
				,anchor: '40%'
				,listeners: {
					scope: this
					,'beforerender': function () {
						if (!FormbuilderX.utils.isEmpty(this.record)) {
							var recipientField = Ext.getCmp('formbuilderx-form-recipient'),
								rec = this.record.method;

							if(rec === 'database_email') {
								recipientField.show();
							}
						}
					}
					,'select': function (box, rec, index) {
						var recipientField = Ext.getCmp('formbuilderx-form-recipient');
						if (rec.id === 'database_email') {
							recipientField.show();
							recipientField.allowBlank = false;
						} else {
							recipientField.hide();
							recipientField.allowBlank = true;
						}
					}
				}
			}, {
				xtype: 'textfield'
				,id: 'formbuilderx-form-recipient'
				,hidden: true
				,fieldLabel: _('FormbuilderX.form.recipient')
				,name: 'email'
				,anchor: '60%'
			}, {
				title: _('FormbuilderX.form.success')
				,layout: 'form'
				,bodyCssClass: 'main-wrapper'
				,autoHeight: true
				,collapsible: true
				,hideMode: 'offsets'
				,items: [{
					xtype: 'textarea'
					,fieldLabel: _('FormbuilderX.form.success')
					,hideLabel: true
					,name: 'success_message'
					,height: 180
					,grow: false
					,anchor: '100%'
					,allowBlank: false
				}]
				,style: 'margin-top: 10px'
			}]
		}]
	}, {
		title: _('FormbuilderX.form.extra')
		,defaults: {
			border: false
			,autoHeight: true
		}
		,layout: 'form'
		,labelWidth: 80
		,items: [{
			html: '<p>' + _('FormbuilderX.form.extra_desc') + '</p>'
			,bodyCssClass: 'panel-desc'
		}, {
			layout: 'form'
			,cls: 'main-wrapper'
			,border: false
			,anchor: '98%'
			,defaults: {
				layout: 'form'
			}
			,items: [{
				xtype: 'textfield'
				,fieldLabel: _('FormbuilderX.form.identifier')
				,name: 'identifier'
				,value: 'form' + Math.floor((Math.random()*100)+1)
				,anchor: '40%'
				,allowBlank: false
			}]
		}]
	});

	if (config.create_update) {
		// Add the fields tab before extra
		tbs.splice(1, 0, {
			title: _('FormbuilderX.forms.field')
			,items: [{
				html: '<p>' + _('FormbuilderX.forms.field.desc') + '</p>'
				,border: false
				,bodyCssClass: 'panel-desc'
			}, {
				xtype: 'formbuilderx-grid-fields'
				,cls: 'main-wrapper'
				,preventRender: true
				,anchor: '100%'
				,form_id: config.record.id
			}]
		});
	}

	Ext.applyIf(config, {
		title: _('FormbuilderX.forms')
		,url: FormbuilderX.config.connector_url
		,baseParams: {}
		,border: false
		,cls: 'container form-with-labels'
		,items: [{
			html: '<h2>' + _('FormbuilderX.form.management') + '</h2>'
            ,cls: 'modx-page-header'
			,border: false
		}, MODx.getPageStructure(tbs)]
		,listeners: {
			'setup': {fn: this.setup, scope: this}
			,'success': {fn: this.success, scope: this}
		}
	});
	FormbuilderX.panel.NewForm.superclass.constructor.call(this, config);
};
Ext.extend(FormbuilderX.panel.NewForm, MODx.FormPanel, {
	initialized: false
	,setup: function () {
		if (this.initialized) {
			this.clearDirty();
			return true;
		}
		this.getForm().setValues(this.config.record);

		this.fireEvent('ready', this.config.record);
		this.clearDirty();
		this.initialized = true;
		MODx.fireEvent('ready');
		return true;
	}
	,success: function (r) {
		if (!this.config.create_update) {
        	var r = r.result.object;
        	window.location.href = '?a=' + MODx.action['FormbuilderX:index'] + '&action=update&id=' + r.id;
        }
	}
});
Ext.reg('formbuilderx-panel-new-form', FormbuilderX.panel.NewForm);

FormbuilderX.combo.Method = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		name: 'method'
		,triggerAction: 'all'
    	,lazyRender:true
		,hiddenName: 'method'
		,mode: 'local'
		,store: new Ext.data.ArrayStore({
	        id: 0
	        ,fields: [
	            'id',
	            'name'
	        ]
	        ,data: [['database', _('FormbuilderX.form.method.dbonly')], ['database_email', _('FormbuilderX.form.method.dbandemail')]]
	    })
		,displayField: 'name'
		,valueField: 'id'
		,fields: ['id', 'name']
		,editable: false
		,value: 'database'
	});
	FormbuilderX.combo.Method.superclass.constructor.call(this,config);
};
Ext.extend(FormbuilderX.combo.Method, Ext.form.ComboBox);
Ext.reg('formbuilderx-combo-method', FormbuilderX.combo.Method);
