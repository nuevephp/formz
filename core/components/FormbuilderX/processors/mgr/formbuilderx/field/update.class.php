<?php
class FormbuilderXUpdateProcessor extends modObjectUpdateProcessor {
    /* Class in model directory */
    public $classKey = 'fbxFormsFields';

    /* Language package to load */
    public $languageTopics = array('FormbuilderX:default');

    /* Used to load the correct language error message */
    public $objectType = 'FormbuilderX.field';

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
}

return 'FormbuilderXUpdateProcessor';
