Ext.onReady(function() {
    MODx.load({ xtype: 'formz-page-form-data', formId: Formz.id, siteId: Formz.siteId });
});

Formz.page.FormData = function(config) {
    config = config || {};

    Ext.applyIf(config, {
		formpanel: 'formz-panel-form-data'
    	,buttons: [{
            text: _('formz.form.export')
            ,handler: function (btn, e) {
                /**
                 * Create dummy form to trick
                 * Ext Ajax request for force file download
                 */
                if (!Ext.fly('frmDummy')) {
                    var frm = document.createElement('form');
                    frm.id = 'frmDummy';
                    frm.formId = config.formId;
                    frm.className = 'x-hidden';
                    document.body.appendChild(frm);
                }

                MODx.Ajax.request({
                    url: Formz.config.connector_url
                    ,params: {
                        action: 'mgr/formz/data/export'
                        ,formId: config.formId
                        ,limit: 100000
                    }
                    ,form: Ext.fly('frmDummy')
                    ,isUpload: true
                    ,listeners: {
                        'success': { fn: function(r) {
                            //
                        }, scope: this }
                    }
                });
            }
        }, '-', {
            process: 'cancel'
            ,text: _('formz.field.cancel')
			,params: {a: MODx.action['formz:index']}
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
