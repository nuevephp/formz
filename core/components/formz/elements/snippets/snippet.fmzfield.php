<?php
/**
 * The base formz snippet.
 *
 * @package formz
 */
$fmz = $modx->getService('formz', 'formz', $modx->getOption('formz.core_path', null, $modx->getOption('core_path') . 'components/formz/') . 'model/formz/', $scriptProperties);
if (!($fmz instanceof Formz)) return '';

$fmz->loadFields();


$type = $modx->getOption('type', $scriptProperties, 'textbox');
$id = $modx->getOption('id', $scriptProperties);
$formItPrefix = $modx->getOption('formitprefix', $scriptProperties, 'fi.');
$defaults = $modx->getOption('default', $scriptProperties);
$values = $modx->getOption('values', $scriptProperties);

$fieldAttr = array(
	'attributes' => array(
		'id' => 'id-' . $id,
		'name' => $id,
		'value' => '[[+' . $formItPrefix . $id . ':isempty=`' . $defaults . '`]]',
	),
	'values' => explode(',', str_replace(' ', '', $values)),
);

$output = '';
switch ($type) {
	case 'textarea':
		$output = $fmz->fields->form_textarea($fieldAttr['attributes']);
	break;
	case 'dropdown':
		$output = $fmz->fields->form_dropdown($fieldAttr['attributes']['id'], $fieldAttr['values']);
	break;
	case 'checkbox':
		$output = $fmz->fields->form_checkbox($fieldAttr['attributes'], $fieldAttr['values']);
	break;
	case 'radiobutton':
		$output = $fmz->fields->form_radio($fieldAttr['attributes'], $fieldAttr['values']);
	break;
	case 'heading':

	break;
	case 'paragraph':

	break;
	default:
		// textbox
		$output = $fmz->fields->form_input($fieldAttr['attributes']);
}

return $output;
