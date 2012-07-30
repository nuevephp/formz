<?php
/**
 * The base formz snippet.
 *
 * @package formz
 */
$fmz = $modx->getService('formz', 'formz', $modx->getOption('formz.core_path', null, $modx->getOption('core_path') . 'components/formz/') . 'model/formz/', $scriptProperties);
if (!($fmz instanceof Formz)) return '';

/**
 * Snippet Config
 */
$tpl = $modx->getOption('tpl', $scriptProperties, 'formTpl');
$id = $modx->getOption('id', $scriptProperties, null);
$hookPrefix = $modx->getOption('hookPrefix', $scriptProperties, 'fmzForm_');
$fieldTpl = $modx->getOption('fieldTpl', $scriptProperties, 'fieldTpl');
$fieldNaming = $modx->getOption('fieldNaming', $scriptProperties, 'field');
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
$formArray['action'] = $hookPrefix . $formArray['method'];

/* store form inside Formz class into variable $form */
$formIdentifier = 'form' . $formArray['id'];
$fmz->form[$formIdentifier] = array(
    'formName' => $formArray['name'],
);

/* Add in Empty field for bug that processes snippet calls in chunk */
$blankField = array(
        'id' => '',
        'form_id' => '',
        'settings' => '{"label":"blank"}',
        'type' => 'blank',
        'order' => '99999',
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
    $alias = $fieldNaming . $fieldArray['id'];
    $settings['id'] = $alias;
    $fieldArray = array_merge($fieldArray, $settings);
    unset($fieldArray['settings']);

    // Get Validation type based on field
    $c = $modx->newQuery('fmzFormsValidation');
    $c->where(array('field_id' => $field->id));
    $c->sortby('field_id', 'ASC');
    $validation = $modx->getCollection('fmzFormsValidation', $c);
    foreach ($validation as $val) {
        $valArray = $val->toArray();
        $valType = $valArray['type'];
        $validate[$valType] = !empty($valType) && $valType === 'required' ? 1 : 0;

        /**
         * Check and see if this field has a Validation type
         * If yes then append the alias to the type and if multiple
         * append them to the same field.
         */
        if (!empty($valType)) {
            if (isset($prevAlias) && $prevAlias === $alias) {
                $formFieldValidate = substr($formFieldValidate, 0, -1);
                $formFieldValidate .= ':' . $valType . ',';
            } else {
                $formFieldValidate .= $alias . ':' . $valType . ',';
            }
            $prevAlias = $alias;

            switch ($valType) {
                case 'email':
                    $vType = 'vTextEmailInvalid';
                    break;
                case 'isNumber':
                    $vType = 'vTextIsNumber';
                    break;
                default:
                    $vType = 'vTextRequired';
                    break;
            }
        }

        if (!empty($valArray['error_message'])) {
            $formFieldValidateText .= '&' . $alias . '.' . $vType . '=`' . $valArray['error_message'] . '` ';
        }
    }

    /* Save copy of Form and field in form variable */
    $field = array($alias => $fieldArray);
    $fmz->form[$formIdentifier] = array_merge($fmz->form[$formIdentifier], $field);

    $fieldArray = array_merge($fieldArray, $validate);

    $formField .= $fmz->getChunk($fieldTpl, $fieldArray);
}

$formArray['validation'] = $formFieldValidate;
$formArray['validationText'] = $formFieldValidateText;
$formArray['fields'] = $formField;

/* by default just return output */
return $fmz->getChunk($tpl, $formArray);
