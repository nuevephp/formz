FormbuilderX.grid.Forms = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'FormbuilderX-grid-forms'
        ,url: FormbuilderX.config.connector_url
        ,baseParams: {
            action: 'mgr/formbuilderx/form/getlist'
        }
        ,fields: ['id','name','email', 'method']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 70
        },{
            header: _('name')
            ,dataIndex: 'name'
            ,width: 180
        },{
            header: _('FormbuilderX.form.email')
            ,dataIndex: 'email'
            ,width: 250
        },{
            header: _('FormbuilderX.form.method')
            ,dataIndex: 'method'
            ,width: 150
        }]
        ,tbar: ['->', {
            text: _('FormbuilderX.form.create')
            ,handler: this.createForm
            ,scope: this
        }]
    });
    FormbuilderX.grid.Forms.superclass.constructor.call(this, config);
};
Ext.extend(FormbuilderX.grid.Forms, MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('FormbuilderX.form.update')
            ,handler: this.updateForm
        });
        m.push('-');
        m.push({
            text: _('FormbuilderX.form.remove')
            ,handler: this.removeForm
        });
        this.addContextMenuItem(m);
    }

    ,createForm: function(btn,e) {
        window.location.href = '?a=' + MODx.action['FormbuilderX:index'] + '&action=create';
    }

    ,updateForm: function(btn,e) {
        if (!this.menu.record || !this.menu.record.id) return false;
        var r = this.menu.record;
        window.location.href = '?a=' + MODx.action['FormbuilderX:index'] + '&action=update&id=' + r.id;
    }

    ,removeForm: function(btn,e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('FormbuilderX.form_remove')
            ,text: _('FormbuilderX.form_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/formbuilderx/form/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }
});
Ext.reg('formbuilderx-grid-forms', FormbuilderX.grid.Forms);
