FormbuilderX.grid.Fields = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        id: 'formbuilderx-grid-fields'
        ,url: FormbuilderX.config.connector_url
        ,baseParams: {
			action: 'mgr/formbuilderx/field/getList'
			,form_id: config.form_id
		}
        ,fields: [
            'id',
            'type',
            'label',
            'required',
            'default',
            'error_message'
        ]
        ,paging: false
        ,remoteSort: true
        ,autoExpandColumn: 'label'
        ,ddGroup: 'ddGrid' + config.form_id
        ,enableDragDrop: true
        //,save_action: 'mgr/venuex/photo/updateFromGrid'
        ,autosave: true
        ,columns: [{
			header: _('FormbuilderX.field.type')
			,dataIndex: 'type'
			,sortable: false
			,width: 50
		}, {
			header: _('FormbuilderX.field.name')
			,dataIndex: 'label'
			,sortable: false
			,width: 100
			,editor: { xtype: 'textfield' }
		}, {
			header: _('FormbuilderX.field.required')
			,dataIndex: 'required'
			,sortable: false
			,width: 100
			,editor: { xtype: 'modx-combo-boolean', renderer: 'boolean' }
		}]
        ,tbar: ['->', {
            text: _('FormbuilderX.field.add')
            ,handler: {
            	xtype: 'formbuilderx-window-field-update'
            	,form_id: config.form_id
            	,blankValues: true
            }
        }]
    });
    FormbuilderX.grid.Fields.superclass.constructor.call(this, config);

    // Reorder by Drag and Drop
    Ext.getCmp('formbuilderx-grid-fields').on('render', this.dragAndDrop, this);
};

Ext.extend(FormbuilderX.grid.Fields, MODx.grid.Grid, {
    getMenu: function (grid, rowIndex, e) {
        return [{
            text: _('FormbuilderX.field.update')
            ,handler: this.updateField
        }, '-', {
            text: _('FormbuilderX.field.remove')
            ,handler: this.removeField
        }];
    }
	,updateField: function (btn, e) {
		if (!this.updateFieldWindow) {
			this.updateFieldWindow = MODx.load({
				xtype: 'formbuilderx-window-field-update'
				,record: this.menu.record
				,form_id: this.config.form_id
				,listeners: {
					'success': { fn: this.refresh, scope: this }
				}
			});
		}
		this.updateFieldWindow.setValues(this.menu.record);
		this.updateFieldWindow.show(e.target);
	}
    ,removeField: function () {
        MODx.msg.confirm({
            title: _('formbuilderx.field.remove')
            ,text: _('formbuilderx.field.remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/formbuilderx/field/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': { fn: this.refresh, scope: this }
            }
        });
    }
    ,dragAndDrop: function (grid) {
    	var ddrow = new Ext.dd.DropTarget(grid.container, {
    		ddGroup: 'ddGrid' + this.config.form_id
    		,copy: false
    		,notifyDrop: function (dd, e, data) {
    			var sm = grid.getSelectionModel(),
    				rows = sm.getSelections();

    			if (dd.getDragData(e)) {
    				var cindex = dd.getDragData(e).rowIndex;
    				for (var i = 0; i < rows.length; i++) {
    					//rowData = c.getById(rows[i].id);
    					console.log(rows[i].id);
    					if (!this.copy) {

    					}
    				};
    			}
    			grid.collectItems();
    			grid.getView().refresh();
    			console.log(sm, rows);
    		}
    	});
    }
});
Ext.reg('formbuilderx-grid-fields', FormbuilderX.grid.Fields);

FormbuilderX.window.UpdateField = function (config) {
	config = config || {};

	create_update = FormbuilderX.utils.isEmpty(config.record) ? 'create' : 'update';

	Ext.applyIf(config, {
		title: _('FormbuilderX.field.' + create_update)
		,url: FormbuilderX.config.connector_url
		,baseParams: {
			action: 'mgr/formbuilderx/field/' + create_update
			,form_id: config.form_id
		}
		,fields: [{
            xtype: 'modx-tabs',
            autoHeight: true,
            deferredRender: false,
            forceLayout: true,
            width: '98%',
            bodyStyle: 'padding: 10px 10px 10px 10px;',
            border: true,
            defaults: {
                border: false,
                autoHeight: true,
                bodyStyle: 'padding: 5px 8px 5px 5px;',
                layout: 'form',
                deferredRender: false,
                forceLayout: true
            },
            items: [{
            	title: _('FormbuilderX.form.default')
            	,layout: 'form'
            	,items: [{
					xtype: 'hidden'
					,name: 'id'
				}, {
					xtype: 'textfield'
					,fieldLabel: _('FormbuilderX.field.name')
					,name: 'label'
					,anchor: '100%'
				}, {
					xtype: 'formbuilderx-combo-types'
					,fieldLabel: _('FormbuilderX.field.type')
					,name: 'type'
					,anchor: '100%'
					,hiddenName: 'type'
					,value: 'textbox'
					,listeners: {
						'select': { fn: this.fieldSets, scope: this }
					}
				}]
            }, {
            	title: _('FormbuilderX.form.properties')
            	,layout: 'form'
            	,items: [{
            		xtype: 'textfield'
            		,fieldLabel: _('FormbuilderX.field.default')
            		,name: 'default'
            		,anchor: '100%'
            	}, {
            		xtype: 'checkbox'
            		,fieldLabel: _('FormbuilderX.field.required')
            		,name: 'required'
            		,anchor: '100%'
            	}, {
            		xtype: 'textfield'
            		,fieldLabel: _('FormbuilderX.field.error_message')
            		,name: 'error_message'
            		,anchor: '100%'
            	}]
            }]
		}]
	});
	FormbuilderX.window.UpdateField.superclass.constructor.call(this, config);
};
Ext.extend(FormbuilderX.window.UpdateField, MODx.Window, {
	fieldSets: function (field, record, i) {
		switch (record.id) {
			case 'textarea':

			break;
			case 'dropdown':

			break;
			case 'checkbox':

			break;
			case 'radiobutton':

			break;
			case 'heading':

			break;
			case 'paragraph':

			break;
			default:
				// textbox
		}
	}
});
Ext.reg('formbuilderx-window-field-update', FormbuilderX.window.UpdateField);

FormbuilderX.combo.Types = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		title: _('FormbuilderX.field.type')
		,typeAhead: true
    	,triggerAction: 'all'
    	,lazyRender: true
		,mode: 'local'
		,store: new Ext.data.ArrayStore({
	        id: 0,
	        fields: [
	            'id',
	            'name'
	        ],
	        data: [
	        	['textbox', 'Textbox'],
	        	['textarea', 'Textarea'],
	        	['dropdown', 'Dropdown'],
	        	['checkbox', 'Checkbox'],
	        	['radiobutton', 'Radio Button'],
	        	['heading', 'Heading'],
	        	['paragraph', 'Paragraph']
	        ]
	    })
	    ,valueField: 'id'
    	,displayField: 'name'
	});
	FormbuilderX.combo.Types.superclass.constructor.call(this, config);
};
Ext.extend(FormbuilderX.combo.Types, Ext.form.ComboBox);
Ext.reg('formbuilderx-combo-types', FormbuilderX.combo.Types);
