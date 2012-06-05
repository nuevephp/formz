<?php
/**
 * @package formz
 * @var Formz $fmz
 */
$corePath = $modx->getOption('formz.core_path', null, $modx->getOption('core_path') . 'components/formz/');
$fmz = $modx->getService('formz', 'formz', $corePath . 'model/formz/');
if (!($fmz instanceof Formz)) return '';

/* Path to Formz processors */
$path = $modx->getOption('processorsPath', $fmz->config, $corePath . 'processors/');

if (!$hook->hasErrors()) {
	$formid = $modx->getOption('formid', $hook->formit->config, '');
	$excludedFields = $modx->getOption('excludeFields', $hook->formit->config, '');
	$data = $hook->getValues();

	/* This needs to be the same as in the fmzFormz snippet */
	$formIdentifier = 'form' . $formid;

	// exclude fields from database save
	if (!empty($excludedFields)) {
		$fieldsArr = explode(',', $excludedFields);
		foreach ($fieldsArr as $field) {
			unset($data[strtolower($field)]);
		}
	}
	// $fmz->dump($fmz->form['form' . $formid]);
	$formDataResponse = $modx->runProcessor('mgr/formz/form/data/create', array(
		'form_id' => $formid
	), array(
		'processors_path' => $path
	));

	if ($formDataResponse->isError()) {
		$fmz->dump($formDataResponse->getMessage());
	}
	$formData = $formDataResponse->getObject();

	// Save Fields
	foreach ($data as $field => $value) {
		if (is_array($value)) {
			switch ($fmz->form[$formIdentifier][$field]['type']) {
				case 'select':
				case 'radio':
					$value = implode('', $value);
				break;
			}
		}

		$formDataFieldResponse = $modx->runProcessor('mgr/formz/field/data/create', array(
			'data_id' => $formData['id'],
			'label' => $fmz->form[$formIdentifier][$field]['label'],
			'value' => serialize($value),
		), array(
			'processors_path' => $path
		));

		if ($formDataFieldResponse->isError()) {
			$fmz->dump($formDataFieldResponse->getMessage());
		}
	}
}