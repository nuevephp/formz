Ext.onReady(function() {
    MODx.load({ xtype: 'formz-page-form-update', record: Formz.data || {} });
});

Formz.page.UpdateForm = function(config) {
    config = config || {};

    var create_update = Ext.isEmpty(config.record.id) ? 'mgr/formz/form/create' : 'mgr/formz/form/update';

    Ext.applyIf(config, {
		formpanel: 'formz-panel-new-form'
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
			,params: {a: MODx.action['formz:index']}
        }]
        ,components: [{
            xtype: 'formz-panel-new-form'
			,id: 'formz-panel-new-form'
            ,renderTo: 'formz-panel-workspace-div'
			,record: config.record  || {}
			,baseParams: {
				action: create_update
				,id: config.record.id
			}
        }]
    });
    Formz.page.UpdateForm.superclass.constructor.call(this, config);
};

Ext.extend(Formz.page.UpdateForm, MODx.Component);
Ext.reg('formz-page-form-update', Formz.page.UpdateForm);
