<?php
class FormzOutputRender extends modTemplateVarOutputRender {
    public function process($value,array $params = array()) {
		return $this->modx->runSnippet('Formz', array_merge(array('id' => $value), $this->tv->_properties));
    }
}
return 'FormzOutputRender';
