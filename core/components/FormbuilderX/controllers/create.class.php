<?php
class FormbuilderXCreateManagerController extends FormbuilderXBaseManagerController {
    public function process(array $scriptProperties = array()) {}

    public function getPageTitle() { return $this->modx->lexicon('FormbuilderX'); }

    public function loadCustomCssJs() {
        $this->addJavascript($this->FormbuilderX->config['jsUrl'] . 'mgr/widgets/newform.panel.js');
        $this->addLastJavascript($this->FormbuilderX->config['jsUrl'] . 'mgr/workspace/form/update.js');
    }

    public function getTemplateFile() { return $this->FormbuilderX->config['templatesPath'] . 'workspace.tpl'; }
}
