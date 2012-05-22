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
$id = $modx->getOption('id', $scriptProperties, null);
$fieldTpl = $modx->getOption('fieldTpl', $scriptProperties, 'fieldTpl');
$sortBy = 'Fields.order,Fields.id';
$sortDir = 'ASC';

/* build query */
$c = $modx->newQuery('fmzForms');
$c->where(array(
    'id' => $id
));

if (!empty($sortBy)) {
    $sortBy = explode(',', $sortBy);
    foreach ($sortBy as $sortField) {
        $sortMix = explode(':', $sortField);
        $sortDirection = !empty($sortMix[1]) ? $sortMix[1] : $sortDir;
        $sortField = $sortMix[0];
        $c->sortby($sortField, $sortDirection);
    }
}

$form = $modx->getObjectGraph('fmzForms', array(
    'Fields' => array(
        'Validation' => array()
    ),
), $c);

/* iterate through items */
$formArray = $form->toArray();

// Add in Empty field for bug that processes snippet calls in chunk
$blankField = array(
        'id' => '',
        'form_id' => '',
        'settings' => '{"label":"blank"}',
        'type' => 'blank',
        'order' => '0',
);
$fmz->getChunk($fieldTpl, $blankField);

$formField = '';
$formFieldValidate = '';
$formFieldValidateText = '';
foreach ($form->Fields as $field) {
    // Defaults
    $validate = array(
        'required' => '',
    );

    $fieldArray = $field->toArray();
    $settings = $modx->fromJSON($fieldArray['settings']);
    $alias = $modRes->cleanAlias($settings['label']);
    $settings['id'] = $alias;
    $fieldArray = array_merge($fieldArray, $settings);

    foreach ($field->Validation as $val) {
        $valArray = $val->toArray();
        $validate[$valArray['type']] = !empty($valArray['type']) ? 1 : 0;

        if (!empty($valArray['type'])) {
            $formFieldValidate .= $alias . ':' . $valArray['type'] . ',';
        }

        if (!empty($valArray['error_message'])) {
            $formFieldValidateText .= '&' . $alias . '.vTextRequired=`' . $valArray['error_message'] . '` ';
        }
    }
    $fieldArray = array_merge($fieldArray, $validate);

    $formField .= $fmz->getChunk($fieldTpl, $fieldArray);
}
$formArray['validation'] = $formFieldValidate;
$formArray['validationText'] = $formFieldValidateText;
$formArray['fields'] = $formField;

/* by default just return output */
return $fmz->getChunk($tpl, $formArray);
