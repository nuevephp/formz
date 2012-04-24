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
            	xtype: 'formbuilderx-window-field-create'
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
            title: _('formbuilderx.photos.remove')
            ,text: _('formbuilderx.photos.remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/venuex/photo/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': { fn: this.refresh, scope: this }
            }
        });
    }
    ,renderImage: function (val) {
        if (val.length > 0)
            return '<img src="' + MODx.config.connectors_url + 'system/phpthumb.php?src=' + encodeURI(val) + '&w=120&h=120" alt="'+val+'"/>';
        return '';
    }
});
Ext.reg('formbuilderx-grid-fields', FormbuilderX.grid.Fields);

FormbuilderX.window.CreateField = function (config) {
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
				select: function (e) {
					console.log(e);
				}
			}
		}]
	});
	FormbuilderX.window.CreateField.superclass.constructor.call(this, config);
};
Ext.extend(FormbuilderX.window.CreateField, MODx.Window);
Ext.reg('formbuilderx-window-field-create', FormbuilderX.window.CreateField);

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
