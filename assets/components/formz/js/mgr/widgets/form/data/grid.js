Formz.grid.Data = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'formz-grid-forms'
        ,url: Formz.config.connector_url
        ,baseParams: {
            action: 'mgr/formz/data/getlist'
            ,formId: config.formId
        }
        ,fields: ['id','senton','ip_address']
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
        var model = this.menu.record;

        m.push({
            text: _('formz.form.update')
            ,handler: this.updateForm
        }, '-', {
            text: _('formz.form.remove')
            ,handler: this.removeForm
        });

        this.addContextMenuItem(m);
    }

    ,removeSpam: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('formz.form_remove')
            ,text: _('formz.form_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/formz/form/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': { fn: function(r) { this.refresh(); }, scope: this }
            }
        });
    }

    ,viewData: function (btn, e) {
        if (!this.menu.record || !this.menu.record.id) return false;
        var r = this.menu.record;
        window.location.href = '?a=' + MODx.action['formz:index'] + '&action=submissions&id=' + r.id;
    }
});
Ext.reg('formz-grid-data', Formz.grid.Data);
