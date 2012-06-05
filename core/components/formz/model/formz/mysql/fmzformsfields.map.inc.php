<?php
/**
 * @package formz
 */
$xpdo_meta_map['fmzFormsFields']= array (
  'package' => 'formz',
  'version' => '1.1',
  'table' => 'formz_forms_fields',
  'fields' =>
  array (
    'form_id' => 0,
    'type' => 'text',
    'settings' => '',
    'order' => 0,
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
    'type' =>
    array (
      'dbtype' => 'enum',
      'precision' => '\'text\',\'textarea\',\'select\',\'checkbox\',\'radio\',\'heading\',\'paragraph\'',
      'phptype' => 'string',
      'null' => false,
      'default' => 'text',
    ),
    'settings' =>
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'order' =>
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => true,
      'default' => 0,
    ),
  ),
  'indexes' =>
  array (
    'order' =>
    array (
      'alias' => 'order',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' =>
      array (
        'order' =>
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
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
      'class' => 'fmzForms',
      'local' => 'form_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
  'composites' =>
  array (
    'Validation' =>
    array (
      'class' => 'fmzFormsValidation',
      'local' => 'id',
      'foreign' => 'field_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
