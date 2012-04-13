<?php
/**
 * @package FormbuilderX
 */
$xpdo_meta_map['fbxFormsData']= array (
  'package' => 'FormbuilderX',
  'version' => '1.1',
  'table' => 'formbuilderx_forms_data',
  'fields' => 
  array (
    'form_id' => 0,
    'senton' => NULL,
    'data' => '',
  ),
  'fieldMeta' => 
  array (
    'form_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'senton' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'data' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
  ),
  'indexes' => 
  array (
    'form_id' => 
    array (
      'alias' => 'form_id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'form_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Form' => 
    array (
      'class' => 'fbxForms',
      'local' => 'form_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
  'composites' => 
  array (
    'FieldData' => 
    array (
      'class' => 'fbxFormsDataFields',
      'local' => 'id',
      'foreign' => 'data_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
