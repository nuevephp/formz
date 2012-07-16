Formz.grid.Data = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'formz-grid-forms'
        ,url: Formz.config.connector_url
        ,baseParams: {
            action: 'mgr/formz/data/getlist'
            ,formId: config.formId
        }
        ,fields: ['id','senton','ip_address', 'fields']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 30
        }, {
            header: _('formz.form.senton')
            ,dataIndex: 'senton'
            ,width: 120
        }, {
            header: _('formz.form.ip_address')
            ,dataIndex: 'ip_address'
            ,width: 250
        }]
    });
    Formz.grid.Data.superclass.constructor.call(this, config);
};
Ext.extend(Formz.grid.Data, MODx.grid.Grid, {
    windows: {}

    ,getMenu: function() {
        var m = [];

        m.push({
            text: _('formz.submissions.view')
            ,handler: this.viewData
        }, '-', {
            text: _('formz.submissions.removedata')
            ,handler: this.removeSpam
        });

        this.addContextMenuItem(m);
    }

    ,viewData: function (btn, e) {
        if (!this.menu.record || !this.menu.record.id) return false;
        var r = this.menu.record;

        if (!this.updateDataWindow) {
            this.updateDataWindow = MODx.load({
                xtype: 'formz-window-view-data'
                ,record: r
                ,listeners: {
                    'success': { fn: this.refresh, scope: this }
                }
            });
        }
        this.updateDataWindow.show(e.target);
    }

    ,removeSpam: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('formz.form_remove')
            ,text: _('formz.form_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/formz/data/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': { fn: function(r) { this.refresh(); }, scope: this }
            }
        });
    }
});
Ext.reg('formz-grid-data', Formz.grid.Data);

Formz.window.ViewData = function (config) {
    config = config || {};
    config.id = Ext.id();

    Ext.applyIf(config, {
        title: _('formz.submissions.viewdata')
        ,fields: [{
            xtype: 'modx-tabs',
            autoHeight: true,
            deferredRender: false,
            forceLayout: true,
            width: '98%',
            bodyStyle: 'padding: 10px 10px 10px 10px;',
            border: true,
            defaults: {
                border: false,
                autoHeight: true,
                bodyStyle: 'padding: 5px 8px 5px 5px;',
                layout: 'form',
                deferredRender: false,
                forceLayout: true
            },
            items: [{
                title: _('formz.form.default')
                ,layout: 'form'
                ,items: [{
                    xtype: 'hidden'
                    ,name: 'id'
                }, {
                    xtype: 'textfield'
                    ,fieldLabel: _('formz.field.name')
                    ,name: 'label'
                    ,anchor: '100%'
                }, {
                    xtype: 'formz-combo-types'
                    ,id: 'formz-field-types-' + config.id
                    ,fieldLabel: _('formz.field.type')
                    ,name: 'type'
                    ,anchor: '100%'
                    ,hiddenName: 'type'
                    ,value: 'text'
                    ,listeners: {
                        'select': { fn: this.fieldSets, scope: this }
                        ,'render': { fn: this.fieldSets, scope: this }
                    }
                }, {
                    xtype: 'textfield'
                    ,id: 'formz-field-values-' + config.id
                    ,fieldLabel: _('formz.field.values')
                    ,name: 'values'
                    ,anchor: '100%'
                    ,hidden: true
                }]
            }, {
                title: _('formz.form.properties')
                ,layout: 'form'
                ,items: [{
                    xtype: 'textfield'
                    ,fieldLabel: _('formz.field.default')
                    ,name: 'default'
                    ,anchor: '100%'
                }, {
                    xtype: 'checkbox'
                    ,fieldLabel: _('formz.field.required')
                    ,name: 'required'
                    ,anchor: '100%'
                    ,listeners: {
                        'check': { fn: this.requiredFieldMsg, scope: this }
                    }
                }, {
                    xtype: 'textfield'
                    ,id: 'formz-field-error_message-' + config.id
                    ,fieldLabel: _('formz.field.error_message')
                    ,name: 'error_message'
                    ,anchor: '100%'
                    ,hidden: true
                }]
            }]
        }]
    });
    Formz.window.ViewData.superclass.constructor.call(this, config);
};
Ext.extend(Formz.window.ViewData, MODx.Window);
Ext.reg('formz-window-view-data', Formz.window.ViewData);
