<?php
class FormzGetListProcessor extends modObjectGetListProcessor {
    /* Class in model directory */
    public $classKey = 'fmzForms';

    /* Language package to load */
    public $languageTopics = array('formz:default');

    /* Field t sort by and direction */
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';

    /* Used to load the correct language error message */
    public $objectType = 'formz.form';

    /* Search database from backend module */
    public function prepareQueryBeforeCount(xPDOQuery $c) {
    	$query = $this->getProperty('query');
    	if (!empty($query)) {
    		$c->where(array(
	    		'name:LIKE' => '%' . $query . '%',
	    	));
    	}
    	return $c;
    }
}

return 'FormzGetListProcessor';
