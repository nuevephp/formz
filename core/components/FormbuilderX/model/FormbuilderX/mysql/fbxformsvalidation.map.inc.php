<?php
/**
 * @package FormbuilderX
 */
$xpdo_meta_map['fbxFormsValidation']= array (
  'package' => 'FormbuilderX',
  'version' => '1.1',
  'table' => 'formbuilderx_forms_validation',
  'fields' => 
  array (
    'field_id' => 0,
    'type' => 'required',
    'error_message' => '',
  ),
  'fieldMeta' => 
  array (
    'field_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'type' => 
    array (
      'dbtype' => 'enum',
      'precision' => '\'required\',\'email\',\'numeric\'',
      'phptype' => 'string',
      'null' => true,
      'default' => 'required',
    ),
    'error_message' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
  'indexes' => 
  array (
    'field_id' => 
    array (
      'alias' => 'field_id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'field_id' => 
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
    'Field' => 
    array (
      'class' => 'fbxFormsFields',
      'local' => 'field_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
