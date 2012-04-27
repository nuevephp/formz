var Formz = function(config) {
    config = config || {};
    Formz.superclass.constructor.call(this, config);
};
Ext.extend(Formz, Ext.Component,{
    page:{}, window:{}, grid:{}, tree:{}, panel:{}, combo:{}, config:{}, view:{}, utils:{}
});
Ext.reg('formz', Formz);

Formz = new Formz();
