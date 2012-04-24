<?php
/**
 * FormbuilderX
 */
/**
 * Loads the home page.
 *
 * @package FormbuilderX
 * @subpackage controllers
 */
class FormbuilderXWorkspaceManagerController extends FormbuilderXBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }

    public function getPageTitle() { return $this->modx->lexicon('FormbuilderX'); }

    public function loadCustomCssJs() {
        $this->addJavascript($this->FormbuilderX->config['jsUrl'] . 'mgr/widgets/form/grid.js');
        $this->addJavascript($this->FormbuilderX->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->FormbuilderX->config['jsUrl'] . 'mgr/workspace/index.js');
    }

    public function getTemplateFile() { return $this->FormbuilderX->config['templatesPath'] . 'workspace.tpl'; }
}
