FormbuilderX.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('FormbuilderX')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,items: [{
                title: _('FormbuilderX.forms')
                ,items: [{
                    html: '<p>'+_('FormbuilderX.intro_msg')+'</p>'
                    ,border: false
                    ,bodyCssClass: 'panel-desc'
                },{
                    xtype: 'FormbuilderX-grid-forms'
                    ,preventRender: true
                    ,cls: 'main-wrapper'
                }]
            }]
        }]
    });
    FormbuilderX.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(FormbuilderX.panel.Home, MODx.Panel);
Ext.reg('FormbuilderX-panel-home', FormbuilderX.panel.Home);
