Formz.grid.Forms = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'formz-grid-forms'
        ,url: Formz.config.connector_url
        ,baseParams: {
            action: 'mgr/formz/form/getlist'
        }
        ,fields: ['id','name','email','method']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 70
        }, {
            header: _('name')
            ,dataIndex: 'name'
            ,width: 180
        }, {
            header: _('formz.form.email')
            ,dataIndex: 'email'
            ,width: 250
        }, {
            header: _('formz.form.method')
            ,dataIndex: 'method'
            ,width: 150
        }]
        ,tbar: ['->', {
            text: _('formz.form.create')
            ,handler: this.createForm
            ,scope: this
        }]
    });
    Formz.grid.Forms.superclass.constructor.call(this, config);
};
Ext.extend(Formz.grid.Forms, MODx.grid.Grid, {
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('formz.form.update')
            ,handler: this.updateForm
        });
        m.push('-');
        m.push({
            text: _('formz.form.remove')
            ,handler: this.removeForm
        });
        this.addContextMenuItem(m);
    }

    ,createForm: function(btn,e) {
        window.location.href = '?a=' + MODx.action['formz:index'] + '&action=create';
    }

    ,updateForm: function(btn,e) {
        if (!this.menu.record || !this.menu.record.id) return false;
        var r = this.menu.record;
        window.location.href = '?a=' + MODx.action['formz:index'] + '&action=update&id=' + r.id;
    }

    ,removeForm: function(btn,e) {
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
});
Ext.reg('formz-grid-forms', Formz.grid.Forms);
