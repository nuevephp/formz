<?php
class FormbuilderXCreateProcessor extends modObjectCreateProcessor {
    /* Class in model directory */
    public $classKey = 'fbxFormsFields';

    /* Language package to load */
    public $languageTopics = array('FormbuilderX:default');

    /* Used to load the correct language error message */
    public $objectType = 'FormbuilderX.field';

    public function beforeSave() {
    	$form_id = $this->getProperty('form_id');
    	$label = $this->getProperty('label');
        $values = $this->getProperty('values');
        $default = $this->getProperty('default');
        $msg = $this->getProperty('error_message', $this->modx->lexicon('FormbuilderX.field.validation.required'));

    	if (empty($label)) {
    		$this->addFieldError('label', $this->modx->lexicon('FormbuilderX.form_err_ns'));
    	} else if ($this->doesAlreadyExist(array('label' => $label, 'form_id' => $form_id))) {
    		$this->addFieldError('label', $this->modx->lexicon('FormbuilderX.form_err_ae'));
    	}

        $settings = array(
            'label' => $label
        );

        if ($default !== null)
            $settings['default'] = $default;

        if ($values !== null)
            $settings['values'] = $values;

        $this->object->set('settings', $this->modx->toJSON($settings));

    	return parent::beforeSave();
    }

    public function afterSave() {
        $required = $this->setCheckbox('required');
        $field_id = $this->object->get('id');

        if ($required) {
            $msg = $this->getProperty('error_message', $this->modx->lexicon('FormbuilderX.field.validation.required'));
            $fieldValidation = $this->modx->newObject('fbxFormsValidation');
            $fieldValidation->fromArray(array(
                'field_id' => $field_id,
                'type' => 'required',
                'error_message' => $msg
            ));
            $fieldValidation->save();
        }
    }
}

return 'FormbuilderXCreateProcessor';
