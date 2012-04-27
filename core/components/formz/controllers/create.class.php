<?php
class FormzCreateManagerController extends FormzBaseManagerController {
    public function process(array $scriptProperties = array()) {}

    public function getPageTitle() { return $this->modx->lexicon('formz'); }

    public function loadCustomCssJs() {
        $this->addJavascript($this->formz->config['jsUrl'] . 'mgr/widgets/newform.panel.js');
        $this->addLastJavascript($this->formz->config['jsUrl'] . 'mgr/workspace/form/update.js');
    }

    public function getTemplateFile() { return $this->formz->config['templatesPath'] . 'workspace.tpl'; }
}
