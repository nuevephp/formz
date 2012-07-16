<?php
class FormzDataManagerController extends FormzBaseManagerController {
    public function process(array $scriptProperties = array()) {}

    public function getPageTitle() { return $this->modx->lexicon('formz'); }

    public function loadCustomCssJs() {
    	// Javascript Loading
    	$this->addHtml('<script>
        Ext.onReady(function() {
            Formz.id = ' . trim($_GET['id']) . ';
        })
        </script>');

        $this->addJavascript($this->formz->config['jsUrl'] . 'mgr/widgets/formdata.panel.js');
        $this->addLastJavascript($this->formz->config['jsUrl'] . 'mgr/widgets/form/data/grid.js');
        $this->addLastJavascript($this->formz->config['jsUrl'] . 'mgr/workspace/form/data.js');
    }

    public function getTemplateFile() { return $this->formz->config['templatesPath'] . 'workspace.tpl'; }
}
