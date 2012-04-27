<?php
class FormzUpdateManagerController extends FormzBaseManagerController {
    public function process(array $scriptProperties = array()) {}

    public function getPageTitle() { return $this->modx->lexicon('formz'); }

    public function loadCustomCssJs() {
    	// Javascript Loading
    	$this->addHtml('<script>
        Ext.onReady(function() {
            Formz.data = ' . $this->getData() . ';
        })
        </script>');

        $this->addJavascript($this->formz->config['jsUrl'] . 'mgr/widgets/newform.panel.js');
        $this->addLastJavascript($this->formz->config['jsUrl'] . 'mgr/widgets/form/field/grid.js');
        $this->addLastJavascript($this->formz->config['jsUrl'] . 'mgr/workspace/form/update.js');
    }

    public function getTemplateFile() { return $this->formz->config['templatesPath'] . 'workspace.tpl'; }

    public function getData() {
    	$cid = trim($_GET['id']);
    	$form = $this->modx->getObject('fmzForms', $cid);

		$formArray = array();
		if ($form instanceof fmzForms) {
            $formArray = $form->toArray();

            return $this->modx->toJSON($formArray);
        }
    }
}
