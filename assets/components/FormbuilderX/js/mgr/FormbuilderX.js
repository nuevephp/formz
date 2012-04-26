var FormbuilderX = function(config) {
    config = config || {};
    FormbuilderX.superclass.constructor.call(this, config);
};
Ext.extend(FormbuilderX,Ext.Component,{
    page:{}, window:{}, grid:{}, tree:{}, panel:{}, combo:{}, config:{}, view:{}, utils:{}
});
Ext.reg('FormbuilderX', FormbuilderX);

FormbuilderX = new FormbuilderX();
