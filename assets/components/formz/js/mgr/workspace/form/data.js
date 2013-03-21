Ext.onReady(function() {
    MODx.load({ xtype: 'formz-page-form-data', formId: Formz.id, siteId: Formz.siteId });
});

Formz.page.FormData = function(config) {
    config = config || {};

    Ext.applyIf(config, {
		formpanel: 'formz-panel-form-data'
    	,buttons: [{
            process: 'cancel'
            ,text: _('formz.field.cancel')
			,params: {a: MODx.action['formz:index']}
        }, '-', {
            text: _('formz.form.export')
            ,handler: function (btn, e) {
                if (! this.exportDataWindow) {
                    this.exportDataWindow = MODx.load({
                        xtype: 'formz-window-export-data'
                    });
                }
                this.exportDataWindow.show(e.target);
            }
        }]
        ,components: [{
            xtype: 'formz-panel-form-data'
			,id: 'formz-panel-form-data'
            ,renderTo: 'formz-panel-workspace-div'
			,formId: config.formId
        }]
    });
    Formz.page.FormData.superclass.constructor.call(this, config);
};

Ext.extend(Formz.page.FormData, MODx.Component);
Ext.reg('formz-page-form-data', Formz.page.FormData);