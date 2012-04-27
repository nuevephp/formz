<?php
/**
 * @package formz
 */
$xpdo_meta_map['fmzFormsDataFields']= array (
  'package' => 'formz',
  'version' => '1.1',
  'table' => 'formz_forms_data_fields',
  'fields' => 
  array (
    'data_id' => 0,
    'label' => '',
    'value' => '',
  ),
  'fieldMeta' => 
  array (
    'data_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'label' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'value' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
  ),
  'indexes' => 
  array (
    'data_id' => 
    array (
      'alias' => 'data_id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'data_id' => 
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
    'FormData' => 
    array (
      'class' => 'fmzFormsData',
      'local' => 'data_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
