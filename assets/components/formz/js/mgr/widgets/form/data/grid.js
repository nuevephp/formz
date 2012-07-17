Formz.grid.Data = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'formz-grid-forms'
        ,url: Formz.config.connector_url
        ,baseParams: {
            action: 'mgr/formz/data/getlist'
            ,formId: config.formId
        }
        ,fields: ['id','senton','ip_address','name','fields']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 30
        }, {
            header: _('formz.submissions.senton')
            ,dataIndex: 'senton'
            ,width: 120
        }, {
            header: _('formz.submissions.ip_address')
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
            title: _('formz.submissions.remove')
            ,text: _('formz.submissions.remove_confirm')
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
        title: _('formz.submissions.viewdata') + config.record.name
        ,autoHeight: true
        ,width: 540
        ,defaults: {
            border: false,
            autoHeight: true,
            bodyStyle: 'padding: 5px 8px 5px 5px;',
            layout: 'form',
            deferredRender: false,
            forceLayout: true
        }
        ,buttons: [{
            text: config.cancelBtnText || _('cancel')
            ,scope: this
            ,handler: function() { config.closeAction !== 'close' ? this.hide() : this.close(); }
        }]
        ,fields: [{
            title: _('formz.submissions.sender_info')
            ,layout: 'form'
            ,bodyCssClass: 'main-wrapper'
            ,autoHeight: true
            ,collapsible: true
            ,collapsed: false
            ,border: true
            ,hideMode: 'offsets'
            ,items: [{
                xtype: 'displayfield'
                ,fieldLabel: _('formz.submissions.senton')
                ,name: 'senton'
                ,grow: false
                ,anchor: '100%'
                ,value: config.record.senton
            }]
        }, {
            title: _('formz.submissions.content')
            ,layout: 'form'
            ,bodyCssClass: 'main-wrapper'
            ,autoHeight: true
            ,collapsible: false
            ,collapsed: false
            ,hideMode: 'offsets'
            ,items: [{
                xtype: 'displayfield'
                ,fieldLabel: _('formz.submissions.content')
                ,hideLabel: true
                ,name: 'fields'
                ,grow: true
                ,anchor: '100%'
                ,value: config.record.fields
            }]
        }]
    });
    Formz.window.ViewData.superclass.constructor.call(this, config);
};
Ext.extend(Formz.window.ViewData, MODx.Window);
Ext.reg('formz-window-view-data', Formz.window.ViewData);
