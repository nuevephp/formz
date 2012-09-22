<div id="tv-wprops-form{$tv}"></div>
{literal}

<script type="text/javascript">
// <![CDATA[
var params = {
{/literal}{foreach from=$params key=k item=v name='p'}
 '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last},{/if}
{/foreach}{literal}
};
var oc = {'change':{fn:function(){Ext.getCmp('modx-panel-tv').markDirty();},scope:this}};
MODx.load({
    xtype: 'panel'
    ,layout: 'form'
    ,autoHeight: true
    ,labelAlign: 'top'
    ,cls: 'form-with-labels'
    ,border: false
    ,items: [{{/literal}
        xtype: 'textfield' 
        ,fieldLabel: '{$fmz.tpl}'
        ,name: 'prop_tpl'
        ,value: params['tpl'] || ''
        ,listeners: oc
        ,anchor: '100%'
    },{
        xtype: 'textfield' 
        ,fieldLabel: '{$fmz.fieldTpl}'
        ,name: 'prop_fieldTpl'
        ,value: params['fieldTpl'] || ''
        ,listeners: oc
        ,anchor: '100%'{literal}
    }]
    ,renderTo: 'tv-wprops-form{/literal}{$tv}{literal}'
});
// ]]>
</script>
{/literal}
