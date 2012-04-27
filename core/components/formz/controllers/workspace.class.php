<?php
/**
 * Formz
 *
 * Loads the home page.
 *
 * @package Formz
 * @subpackage controllers
 */
class FormzWorkspaceManagerController extends FormzBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }

    public function getPageTitle() { return $this->modx->lexicon('formz'); }

    public function loadCustomCssJs() {
        $this->addJavascript($this->formz->config['jsUrl'] . 'mgr/widgets/form/grid.js');
        $this->addJavascript($this->formz->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->formz->config['jsUrl'] . 'mgr/workspace/index.js');
    }

    public function getTemplateFile() { return $this->formz->config['templatesPath'] . 'workspace.tpl'; }
}
