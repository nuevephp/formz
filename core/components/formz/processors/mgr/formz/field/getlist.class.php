<?php
class formzGetListProcessor extends modObjectGetListProcessor {
    /* Class in model directory */
    public $classKey = 'fmzFormsFields';

    /* Language package to load */
    public $languageTopics = array('formz:default');

    /* Field t sort by and direction */
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';

    /* Used to load the correct language error message */
    public $objectType = 'formz.form';

    /* Search database from backend module */
    public function prepareQueryBeforeCount(xPDOQuery $c) {
    	$form = $this->getProperty('form_id');
    	if (!empty($form)) {
    		$c->where(array(
	    		'form_id' => $form,
	    	));
    	}
    	return $c;
    }

    public function afterIteration($list) {
        $currentIndex = 0;
        $lists = array();
        foreach ($list as $item) {
            $fieldSettings = $this->modx->fromJSON($item['settings'], false);

            $lists[] = $item;
            $val = $this->modx->getObject('fmzFormsValidation', array('field_id' => $item['id']));

            $lists[$currentIndex]['label'] = $fieldSettings->label;

            if ($fieldSettings->default !== null)
                $lists[$currentIndex]['default'] = $fieldSettings->default;

            if ($fieldSettings->values !== null)
                $lists[$currentIndex]['values'] = $fieldSettings->values;

            $lists[$currentIndex]['required'] = $val->type === 'required' ? 1 : 0;
            $lists[$currentIndex]['error_message'] = $val->error_message;
            $currentIndex++;
        }
        return $lists;
    }
}

return 'formzGetListProcessor';
