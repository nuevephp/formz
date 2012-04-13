<?php
/**
 * FormbuilderX
 */
/**
 * Properties for the FormbuilderX snippet.
 *
 * @package FormbuilderX
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'prop_FormbuilderX.tpl_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'Item',
        'lexicon' => 'FormbuilderX:properties',
    ),
    array(
        'name' => 'sortBy',
        'desc' => 'prop_FormbuilderX.sortby_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'name',
        'lexicon' => 'FormbuilderX:properties',
    ),
    array(
        'name' => 'sortDir',
        'desc' => 'prop_FormbuilderX.sortdir_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'ASC',
        'lexicon' => 'FormbuilderX:properties',
    ),
    array(
        'name' => 'limit',
        'desc' => 'prop_FormbuilderX.limit_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 5,
        'lexicon' => 'FormbuilderX:properties',
    ),
    array(
        'name' => 'outputSeparator',
        'desc' => 'prop_FormbuilderX.outputseparator_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'FormbuilderX:properties',
    ),
    array(
        'name' => 'toPlaceholder',
        'desc' => 'prop_FormbuilderX.toplaceholder_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => true,
        'lexicon' => 'FormbuilderX:properties',
    ),
/*
    array(
        'name' => '',
        'desc' => 'prop_FormbuilderX.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'FormbuilderX:properties',
    ),
    */
);

return $properties;
