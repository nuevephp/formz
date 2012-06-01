<?php
/**
 * Formz
 *
 * Properties for the formz snippet.
 *
 * @package Formz
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'prop_formz.tpl_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'Item',
        'lexicon' => 'formz:properties',
    ),
    array(
        'name' => 'sortBy',
        'desc' => 'prop_formz.sortby_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'name',
        'lexicon' => 'formz:properties',
    ),
    array(
        'name' => 'sortDir',
        'desc' => 'prop_formz.sortdir_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'ASC',
        'lexicon' => 'formz:properties',
    ),
    array(
        'name' => 'limit',
        'desc' => 'prop_formz.limit_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 5,
        'lexicon' => 'formz:properties',
    ),
    array(
        'name' => 'outputSeparator',
        'desc' => 'prop_formz.outputseparator_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'formz:properties',
    ),
    array(
        'name' => 'toPlaceholder',
        'desc' => 'prop_formz.toplaceholder_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => true,
        'lexicon' => 'formz:properties',
    ),
);

return $properties;
