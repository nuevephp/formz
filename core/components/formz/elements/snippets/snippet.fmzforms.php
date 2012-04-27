<?php
/**
 * The base formz snippet.
 *
 * @package formz
 */
$fmz = $modx->getService('formz', 'formz', $modx->getOption('formz.core_path', null, $modx->getOption('core_path') . 'components/formz/') . 'model/formz/', $scriptProperties);
if (!($fmz instanceof Formz)) return '';

$modRes = $modx->newObject('modResource');

/**
 * Do your snippet code here. This demo grabs 5 items from our custom table.
 */
$tpl = $modx->getOption('tpl', $scriptProperties, 'formTpl');
$fieldTpl = $modx->getOption('fieldTpl', $scriptProperties, 'fieldTpl');
$sortBy = $modx->getOption('sortBy', $scriptProperties, 'Fields.order,Fields.id');
$sortDir = $modx->getOption('sortDir', $scriptProperties, 'ASC');
$limit = $modx->getOption('limit', $scriptProperties, 5);

/* build query */
$c = $modx->newQuery('fmzForms');
$c->where(array('id' => 1));

if (!empty($sortBy)) {
    $sortBy = explode(',', $sortBy);
    foreach ($sortBy as $sortField) {
        $sortMix = explode(':', $sortField);
        $sortDirection = !empty($sortMix[1]) ? $sortMix[1] : $sortDir;
        $sortField = $sortMix[0];
        $c->sortby($sortField, $sortDirection);
    }
}

$c->limit($limit);
$form = $modx->getObjectGraph('fmzForms', array(
    'Fields' => array(
        'Validation' => array()
    ),
), $c);

/* iterate through items */
$formArray = $form->toArray();

// Add in Empty field for spam catcher use
$blankField = $modx->newObject('fmzFormsFields', array(
	'id' => '',
	'form_id' => '',
	'settings' => '{"label":"blank"}',
	'type' => 'blank',
	'order' => '0',
));
array_unshift($form->Fields, $blankField);

$formField = '';
foreach ($form->Fields as $field) {
    $fieldArray = $field->toArray();
    $settings = $modx->fromJSON($fieldArray['settings']);
    $alias = $modRes->cleanAlias($settings['label']);
    $settings['id'] = $alias;
    $fieldArray = array_merge($fieldArray, $settings);

    $formField .= $fmz->getChunk($fieldTpl, $fieldArray);
}
$formArray['fields'] = $formField;

/* by default just return output */
return $fmz->getChunk($tpl, $formArray);;
