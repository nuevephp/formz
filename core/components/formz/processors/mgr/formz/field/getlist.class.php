<?php
class FormzGetListProcessor extends modObjectGetListProcessor {
    /* Class in model directory */
    public $classKey = 'fmzFormsFields';

    /* Language package to load */
    public $languageTopics = array('formz:default');

    /* Field t sort by and direction */
    public $defaultSortField = 'order';
    public $defaultSortDirection = 'ASC';

    /* Used to load the correct language error message */
    public $objectType = 'formz.field';

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

            if (!empty($fieldSettings->default))
                $lists[$currentIndex]['default'] = $fieldSettings->default;

            if (!empty($fieldSettings->values))
                $lists[$currentIndex]['values'] = $fieldSettings->values;

            $lists[$currentIndex]['required'] = !empty($val) && $val->type === 'required' ? 1 : 0;
            $lists[$currentIndex]['error_message'] = !empty($val) ? $val->error_message : '';
            $currentIndex++;
        }
        return !empty($lists) ? $lists : $list;
    }
}

return 'FormzGetListProcessor';
