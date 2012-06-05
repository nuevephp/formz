<?php
class FormzFieldDataCreateProcessor extends modObjectCreateProcessor {
    /* Class in model directory */
    public $classKey = 'fmzFormsDataFields';

    /* Language package to load */
    public $languageTopics = array('formz:default');

    /* Used to load the correct language error message */
    public $objectType = 'formz.form';
}

return 'FormzFieldDataCreateProcessor';
