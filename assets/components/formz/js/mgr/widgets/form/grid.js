Formz.grid.Forms = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'formz-grid-forms'
        ,url: Formz.config.connector_url
        ,baseParams: {
            action: 'mgr/formz/form/getlist'
        }
        ,fields: ['id','name','email','method','has_submission','submissions']
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 5
        }, {
            header: _('name')
            ,dataIndex: 'name'
            ,width: 30
        }, {
            header: _('formz.form.email')
            ,dataIndex: 'email'
            ,width: 35
        }, {
            header: _('formz.form.submissions')
            ,dataIndex: 'submissions'
            ,align: 'center'
            ,width: 10
        }, {
            header: _('formz.form.method')
            ,dataIndex: 'method'
            ,width: 20
        }]
    });
    Formz.grid.Forms.superclass.constructor.call(this, config);
};
Ext.extend(Formz.grid.Forms, MODx.grid.Grid, {
    windows: {}

    ,getMenu: function() {
        var m = [];
        var model = this.menu.record;
        var submStr = model.submissions > 1 ? 'formz.form.has_submissions' : 'formz.form.has_submission';

        m.push({
            text: _('formz.form.update')
            ,handler: this.updateForm
        }, '-', {
            text: _('formz.form.remove')
            ,handler: this.removeForm
        });

        if (model.has_submission) {
            m.unshift({
                text: _(submStr)
                ,handler: this.viewData
            });
        }

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
            title: _('formz.form.remove')
            ,text: _('formz.form.remove_confirm')
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
        window.location.href = '?a=' + MODx.action['formz:index'] + '&action=data&id=' + r.id;
    }
});
Ext.reg('formz-grid-forms', Formz.grid.Forms);
