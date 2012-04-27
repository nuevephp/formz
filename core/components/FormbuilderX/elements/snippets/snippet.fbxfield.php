<?php
/**
 * The base FormbuilderX snippet.
 *
 * @package FormbuilderX
 */
$fbx = $modx->getService('FormbuilderX','FormbuilderX',$modx->getOption('FormbuilderX.core_path', null, $modx->getOption('core_path').'components/FormbuilderX/') . 'model/FormbuilderX/', $scriptProperties);
if (!($fbx instanceof FormbuilderX)) return '';

$fbx->loadFields();


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
		$output = $fbx->fields->form_textarea($fieldAttr['attributes']);
	break;
	case 'dropdown':
		$output = $fbx->fields->form_dropdown($fieldAttr['attributes']['id'], $fieldAttr['values']);
	break;
	case 'checkbox':
		$output = $fbx->fields->form_checkbox($fieldAttr['attributes'], $fieldAttr['values']);
	break;
	case 'radiobutton':
		$output = $fbx->fields->form_radio($fieldAttr['attributes'], $fieldAttr['values']);
	break;
	case 'heading':

	break;
	case 'paragraph':

	break;
	default:
		// textbox
		$output = $fbx->fields->form_input($fieldAttr['attributes']);
}

return $output;
