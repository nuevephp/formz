<?php
class FormbuilderXCreateProcessor extends modObjectCreateProcessor {
    /* Class in model directory */
    public $classKey = 'fbxFormsFields';

    /* Language package to load */
    public $languageTopics = array('FormbuilderX:default');

    /* Used to load the correct language error message */
    public $objectType = 'FormbuilderX.form';

    public function beforeSave() {
    	$name = $this->getProperty('name');

    	if (empty($name)) {
    		$this->addFieldError('name', $this->modx->lexicon('FormbuilderX.form_err_ns'));
    	} else if ($this->doesAlreadyExist(array('name' => $name))) {
    		$this->addFieldError('name', $this->modx->lexicon('FormbuilderX.form_err_ae'));
    	}

        // Setting creator and time created
        $this->object->set('createdby', $this->modx->user->get('id'));
        $this->object->set('createdon', date('Y-m-d H:i:s',time()));

    	return parent::beforeSave();
    }
}

return 'FormbuilderXCreateProcessor';
