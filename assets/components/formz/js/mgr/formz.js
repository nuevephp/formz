var Formz = function(config) {
    config = config || {};
    Formz.superclass.constructor.call(this, config);
};
Ext.extend(Formz, Ext.Component,{
    page:{}, window:{}, grid:{}, tree:{}, panel:{}, combo:{}, config:{}, view:{}, utils:{}
});
Ext.reg('formz', Formz);

Formz = new Formz();

/* Helper */
Formz.grid.btnRenderer = function (list) {
    var btnTemplate = new Ext.XTemplate('<tpl for=".">' +
        '<tpl if="items">'+
        '<tpl for="items">' +
        '<div id="{id}" class="x-btn-text button controlBtn {className}" style="{buttonStyle}">{fieldLabel}</div>' +
        '</tpl>' +
        '</tpl>' +
        '</tpl>', {
        compiled: true
    });

    return btnTemplate.apply(list);
}