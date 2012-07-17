<?php
class FormzCreateProcessor extends modObjectCreateProcessor {
    /* Class in model directory */
    public $classKey = 'fmzFormsFields';

    /* Language package to load */
    public $languageTopics = array('formz:default');

    /* Used to load the correct language error message */
    public $objectType = 'formz.field';

    public function beforeSave() {
    	$form_id = $this->getProperty('form_id');
    	$label = $this->getProperty('label');
        $type = $this->getProperty('type');
        $default = $this->getProperty('default');

    	if (empty($label)) {
    		$this->addFieldError('label', $this->modx->lexicon('formz.field_err_ns'));
    	} else if ($this->doesAlreadyExist(array('label' => $label, 'form_id' => $form_id))) {
    		$this->addFieldError('label', $this->modx->lexicon('formz.field_err_ae'));
    	}

        switch ($type) {
            case 'select':
            case 'checkbox':
            case 'radio':
                $values = $this->getProperty('values');
                break;
            default:
                // textbox
                $values = '';
        }

        $settings = array(
            'label' => $label
        );

        if (!empty($default))
            $settings['default'] = $default;

        if (!empty($values))
            $settings['values'] = $values;

        $this->object->set('settings', $this->modx->toJSON($settings));

    	return parent::beforeSave();
    }

    public function afterSave() {
        $this->saveRequired();
        parent::afterSave();
    }

    private function saveRequired() {
        $required = $this->setCheckbox('required');
        $field_id = $this->object->get('id');

        if ($required) {
            $msg = $this->getProperty('error_message', $this->modx->lexicon('formz.field.validation.required'));
            $fieldValidation = $this->modx->newObject('fmzFormsValidation');
            $fieldValidation->fromArray(array(
                'field_id' => $field_id,
                'type' => 'required',
                'error_message' => $msg
            ));
            $fieldValidation->save();
        }
    }
}

return 'FormzCreateProcessor';
