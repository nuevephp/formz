<?php
class FormzOutputRender extends modTemplateVarOutputRender {
	public function getLexiconTopics() {
        return array('tv_widget', 'formz:tv');
    }

    public function process($value,array $params = array()) {
		return $this->modx->runSnippet('fmzForms', array_merge(array('id' => $value), $this->tv->_properties));
    }
}
return 'FormzOutputRender';
