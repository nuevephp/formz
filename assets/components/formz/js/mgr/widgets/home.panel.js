Formz.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config, {
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('formz')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false, autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,items: [{
                title: _('formz.form')
                ,items: [{
                    html: '<p>'+_('formz.intro_msg')+'</p>'
                    ,border: false
                    ,bodyCssClass: 'panel-desc'
                },{
                    xtype: 'formz-grid-forms'
                    ,preventRender: true
                    ,cls: 'main-wrapper'
                }]
            }]
        }]
    });
    Formz.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(Formz.panel.Home, MODx.Panel);
Ext.reg('formz-panel-home', Formz.panel.Home);
