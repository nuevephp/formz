<?php
/**
 * The base FormbuilderX snippet.
 *
 * @package FormbuilderX
 */
$fbx = $modx->getService('FormbuilderX','FormbuilderX',$modx->getOption('FormbuilderX.core_path',null,$modx->getOption('core_path').'components/FormbuilderX/').'model/FormbuilderX/',$scriptProperties);
if (!($fbx instanceof FormbuilderX)) return '';

$modRes = $modx->newObject('modResource');

/**
 * Do your snippet code here. This demo grabs 5 items from our custom table.
 */
$tpl = $modx->getOption('tpl',$scriptProperties, 'formTpl');
$fieldTpl = $modx->getOption('fieldTpl',$scriptProperties, 'fieldTpl');
$sortBy = $modx->getOption('sortBy',$scriptProperties,'Fields.order,Fields.id');
$sortDir = $modx->getOption('sortDir',$scriptProperties,'ASC');
$limit = $modx->getOption('limit',$scriptProperties,5);
$outputSeparator = $modx->getOption('outputSeparator',$scriptProperties,"\n");

/* build query */
$c = $modx->newQuery('fbxForms');
$c->where(array('id' => 1));

if (!empty($sortBy)) {
    $sortBy = explode(',',$sortBy);
    foreach ($sortBy as $sortField) {
        $sortMix = explode(':',$sortField);
        $sortDirection = !empty($sortMix[1]) ? $sortMix[1] : $sortDir;
        $sortField = $sortMix[0];
        $c->sortby($sortField,$sortDirection);
    }
}

$c->limit($limit);
$form = $modx->getObjectGraph('fbxForms', array(
    'Fields' => array(
        'Validation' => array()
    ),
), $c);

/* iterate through items */
$formArray = $form->toArray();

// Add in Empty field for spam catcher use
$blankField = $modx->newObject('fbxFormsFields', array(
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

    $formField .= $fbx->getChunk($fieldTpl, $fieldArray);
}
$formArray['fields'] = $formField;

/* by default just return output */
return $fbx->getChunk($tpl, $formArray);;
