<?php
class FormzRemoveProcessor extends modObjectRemoveProcessor {
    /* Class in model directory */
    public $classKey = 'fmzFormsData';

    /* Language package to load */
    public $languageTopics = array('formz:default');

    /* Used to load the correct language error message */
    public $objectType = 'formz.form';
}

return 'FormzRemoveProcessor';
