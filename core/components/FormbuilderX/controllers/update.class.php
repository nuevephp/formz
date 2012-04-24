<?php
class FormbuilderXUpdateManagerController extends FormbuilderXBaseManagerController {
    public function process(array $scriptProperties = array()) {}

    public function getPageTitle() { return $this->modx->lexicon('FormbuilderX'); }

    public function loadCustomCssJs() {
    	// Javascript Loading
    	$this->addHtml('<script>
        Ext.onReady(function() {
            FormbuilderX.data = ' . $this->getData() . ';
        })
        </script>');

        $this->addJavascript($this->FormbuilderX->config['jsUrl'] . 'mgr/widgets/newform.panel.js');
        $this->addLastJavascript($this->FormbuilderX->config['jsUrl'] . 'mgr/widgets/form/field/grid.js');
        $this->addLastJavascript($this->FormbuilderX->config['jsUrl'] . 'mgr/workspace/form/update.js');
    }

    public function getTemplateFile() { return $this->FormbuilderX->config['templatesPath'] . 'workspace.tpl'; }

    public function getData() {
    	$cid = trim($_GET['id']);
    	$form = $this->modx->getObject('fbxForms', $cid);

		$formArray = array();
		if ($form instanceof fbxForms) {
            $formArray = $form->toArray();

            return $this->modx->toJSON($formArray);
        }
    }
}
