<?php
class FormzCreateProcessor extends modObjectCreateProcessor {
    /* Class in model directory */
    public $classKey = 'fmzForms';

    /* Language package to load */
    public $languageTopics = array('formz:default');

    /* Used to load the correct language error message */
    public $objectType = 'formz.form';

    public function beforeSave() {
        // Setting creator and time created
        $this->object->set('createdby', $this->modx->user->get('id'));
        $this->object->set('createdon', date('Y-m-d H:i:s',time()));

    	return parent::beforeSave();
    }
}

return 'FormzCreateProcessor';
