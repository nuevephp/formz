Ext.onReady(function() {
    MODx.load({ xtype: 'formz-page-workspace'});
});

/**
 * Loads the FormBuilder environment
 *
 * @class formz.page.Workspace
 * @extends MODx.Component
 * @params {Object} config An object of config properties
 * @xtype formz-page-workspace
 */
Formz.page.Workspace = function(config) {
    config = config || {};
    Ext.applyIf(config, {
    	formpanel: 'formz-panel-home'
    	,buttons: [{
            text: _('formz.form.create')
            ,handler: function (btn, e) {
            	window.location.href = '?a=' + MODx.action['formz:index'] + '&action=create';
            }
        }]
        ,components: [{
            xtype: 'formz-panel-home'
            ,id: 'formz-panel-home'
            ,renderTo: 'formz-panel-workspace-div'
        }]
    });
    Formz.page.Workspace.superclass.constructor.call(this, config);
};
Ext.extend(Formz.page.Workspace, MODx.Component);
Ext.reg('formz-page-workspace', Formz.page.Workspace);
