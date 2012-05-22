<?php
class FormzInputRender extends modTemplateVarInputRender {
    public function getLexiconTopics() {
        return array('tv_widget', 'formz:tv');
    }

    public function process($value,array $params = array()) {
    	$this->config['core_path'] = $this->modx->getOption('formz.core_path', null, $this->modx->getOption('core_path') . 'components/formz/');

		$formz = $this->modx->getService('formz', 'formz', $this->config['core_path'] . 'model/formz/');
		if (!($formz instanceof Formz)) return '';

        $c = $this->modx->newQuery('fmzForms');
        $formz = $this->modx->getCollection('fmzForms', $c);

        $forms = array();
		foreach ($formz as $form) {
			$selected = $form->get('id') == $this->tv->get('value');
		    $forms[] = array(
		        'value' => $form->get('id'),
		        'text' => $form->get('name').' ('.$form->get('id').')',
		        'selected' => $selected,
		    );
		}
		$this->setPlaceholder('forms', $forms);
    }

    public function getTemplate() {
    	return $this->config['core_path'] . 'templates/elements/tv/renders/input/formz.tpl';
    }
}
return 'FormzInputRender';
