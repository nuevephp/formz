<?php
class FormzCreateProcessor extends modObjectCreateProcessor {
    /* Class in model directory */
    public $classKey = 'fmzFormsData';

    /* Language package to load */
    public $languageTopics = array('formz:default');

    /* Used to load the correct language error message */
    public $objectType = 'formz.form';

    public function beforeSave() {
        /* User and Server info */
        $data = array(
            'ip_address' => $_SERVER['REMOTE_ADDR'], // Users IP Address
            'server_name' => $_SERVER['SERVER_NAME'],
            'server_address' => $_SERVER['SERVER_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'request_time' => $_SERVER['REQUEST_TIME'],
        );

        // set data and time created
        $this->object->set('senton', date('Y-m-d H:i:s',time()));
        $this->object->set('data', serialize($data));

    	return parent::beforeSave();
    }
}

return 'FormzCreateProcessor';
