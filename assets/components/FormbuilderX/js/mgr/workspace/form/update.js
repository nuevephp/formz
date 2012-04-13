Ext.onReady(function() {
    MODx.load({ xtype: 'formbuilderx-page-form-update', record: FormbuilderX.data || {} });
});

FormbuilderX.page.UpdateForm = function(config) {
    config = config || {};

    var create_update = FormbuilderX.utils.isEmpty(config.record) ? 'mgr/formbuilderx/form/create' : 'mgr/formbuilderx/form/update';
    console.log(config.record)
    Ext.applyIf(config, {
		formpanel: 'formbuilderx-panel-new-form'
    	,buttons: [{
            text: _('save')
			,process: create_update
			,method: 'remote'
			/*,checkDirty: true*/
			,keys: [{
				key: MODx.config.keymap_save || 's'
				,ctrl: true
			}]
        },'-',{
            process: 'cancel'
            ,text: _('cancel')
			,params: {a: MODx.action['FormbuilderX:index']}
        }]
        ,components: [{
            xtype: 'formbuilderx-panel-new-form'
			,id: 'formbuilderx-panel-new-form'
            ,renderTo: 'FormbuilderX-panel-workspace-div'
			,record: config.record  || {}
			,baseParams: {
				action: create_update
				,id: config.record.id
			}
        }]
    });
    FormbuilderX.page.UpdateForm.superclass.constructor.call(this, config);
};

Ext.extend(FormbuilderX.page.UpdateForm, MODx.Component);
Ext.reg('formbuilderx-page-form-update', FormbuilderX.page.UpdateForm);
