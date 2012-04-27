<?php
class formzUpdateProcessor extends modObjectUpdateProcessor {
    /* Class in model directory */
    public $classKey = 'fmzFormsFields';

    /* Language package to load */
    public $languageTopics = array('formz:default');

    /* Used to load the correct language error message */
    public $objectType = 'formz.field';

    public function beforeSave() {
        $label = $this->getProperty('label');
        $type = $this->getProperty('type');
        $default = $this->getProperty('default');

        switch ($type) {
            case 'dropdown':
            case 'checkbox':
            case 'radiobutton':
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
        return parent::afterSave();
    }

    private function saveRequired() {
        $required = $this->setCheckbox('required');
        $field_id = $this->object->get('id');

        if ($required) {
            $msg = $this->getProperty('error_message');
            $fieldValidation = $this->modx->getObject('fmzFormsValidation', array(
                'field_id' => $field_id,
                'type' => 'required',
            ));

            if (empty($fieldValidation)) {
                $fieldValidation = $this->modx->newObject('fmzFormsValidation');
            }

            $fieldValidation->fromArray(array(
                'field_id' => $field_id,
                'type' => 'required',
                'error_message' => $msg
            ));
            $fieldValidation->save();
        } else {
            $fieldValidation = $this->modx->getObject('fmzFormsValidation', array(
                'field_id' => $field_id,
                'type' => 'required',
            ));
            if ($fieldValidation && $fieldValidation instanceof fmzFormsValidation) {
                $fieldValidation->remove();
            }
        }
    }
}

return 'formzUpdateProcessor';
