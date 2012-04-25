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
            'label'
        ]
        ,paging: true
        ,remoteSort: true
        ,autoExpandColumn: 'type'
        //,save_action: 'mgr/venuex/photo/updateFromGrid'
        ,autosave: true
        ,columns: [{
			header: _('FormbuilderX.field.type')
			,dataIndex: 'type'
			,sortable: false
			,width: 100
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
            	,venue: config.venue
            	,alias: config.alias
            	,blankValues: true
            }
        }]
    });
    FormbuilderX.grid.Fields.superclass.constructor.call(this, config);
};

Ext.extend(FormbuilderX.grid.Fields, MODx.grid.Grid, {
    getMenu: function (grid, rowIndex, e) {
        return [{
            text: _('formbuilderx.field.update')
            ,handler: this.updatePhoto
        }, '-', {
            text: _('formbuilderx.field.remove')
            ,handler: this.removePhoto
        }];
    }
	,updatePhoto: function (btn, e) {
		if (!this.updatePhotoWindow) {
			this.updatePhotoWindow = MODx.load({
				xtype: 'venuex-window-photo-update'
				,record: this.menu.record
				,alias: this.config.alias
				,listeners: {
					'success': { fn: this.refresh, scope: this }
				}
			});
		}
		this.updatePhotoWindow.setValues(this.menu.record);
		this.updatePhotoWindow.show(e.target);
	}
    ,removePhoto: function () {
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
});
Ext.reg('formbuilderx-grid-fields', FormbuilderX.grid.Fields);

FormbuilderX.window.UpdateField = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		title: _('FormbuilderX.field.create')
		,url: FormbuilderX.config.connector_url
		,fileUpload: true
		,baseParams: {
			action: 'mgr/formbuilderx/field/create'
			,form_id: config.form_id
		}
		,fields: [{
            xtype: 'modx-tabs',
            hideMode: 'offsets',
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
            	,id: 'formbuilderx-form-default'
            	,layout: 'form'
            	,items: [{
					xtype: 'textfield'
					,fieldLabel: _('FormbuilderX.field.name')
					,name: 'name'
					,anchor: '100%'
				}, {
					xtype: 'formbuilderx-combo-types'
					,fieldLabel: _('FormbuilderX.field.type')
					,name: 'type'
					,anchor: '100%'
					,listeners: {
						'select': { fn: this.fieldSets, scope: this }
					}
				}]
            }, {
            	title: _('FormbuilderX.form.properties')
            	,id: 'formbuilderx-form-properties'
            	,layout: 'form'
            	,items: [{
            		xtype: 'textfield'
            		,id: 'formbuilderx-field-default'
            		,fieldLabel: _('FormbuilderX.field.default')
            		,name: 'default'
            		,anchor: '100%'
            	}, {
            		xtype: 'checkbox'
            		,fieldLabel: _('FormbuilderX.field.required')
            		,name: 'required'
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
				// textarea
		}
	}
});
Ext.reg('formbuilderx-window-field-update', FormbuilderX.window.UpdateField);

/*Venuex.window.UpdatePhoto = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		title: _('formbuilderx.photos.update')
		,url: Venuex.config.connectorUrl
		,fileUpload: true
		,baseParams: {
			action: 'mgr/venuex/photo/update'
			,alias: config.alias
		},
		fields: [{
			xtype: 'hidden'
			,name: 'id'
		}, {
			xtype: 'textfield'
			,fieldLabel: _('formbuilderx.name')
			,name: 'name'
			,anchor: '100%'
		}]
	});
	Venuex.window.UpdatePhoto.superclass.constructor.call(this, config);
}
Ext.extend(Venuex.window.UpdatePhoto, MODx.Window);
Ext.reg('venuex-window-photo-update', Venuex.window.UpdatePhoto);*/

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
