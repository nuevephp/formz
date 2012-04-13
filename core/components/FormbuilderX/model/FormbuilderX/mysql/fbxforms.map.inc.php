<?php
/**
 * @package FormbuilderX
 */
$xpdo_meta_map['fbxForms']= array (
  'package' => 'FormbuilderX',
  'version' => '1.1',
  'table' => 'formbuilderx_forms',
  'fields' => 
  array (
    'name' => '',
    'method' => 'database_email',
    'email' => '',
    'success_message' => '',
    'identifier' => '',
    'createdon' => NULL,
    'createdby' => 0,
    'editedon' => NULL,
    'editedby' => 0,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'method' => 
    array (
      'dbtype' => 'enum',
      'phptype' => 'string',
      'null' => false,
      'precision' => '\'database\',\'database_email\'',
      'default' => 'database_email',
    ),
    'email' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'success_message' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'identifier' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'createdon' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'createdby' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'editedon' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'editedby' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'aggregates' => 
  array (
    'CreatedBy' => 
    array (
      'class' => 'modUser',
      'local' => 'createdby',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'EditedBy' => 
    array (
      'class' => 'modUser',
      'local' => 'createdby',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
  'composites' => 
  array (
    'Fields' => 
    array (
      'class' => 'fbxFormsFields',
      'local' => 'id',
      'foreign' => 'form_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Data' => 
    array (
      'class' => 'fbxFormsData',
      'local' => 'id',
      'foreign' => 'form_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
