<?php
/**
 * Formz
 */
require_once dirname(__FILE__) . '/model/formz/formz.class.php';
/**
 * @package Formz
 */
class IndexManagerController extends modExtraManagerController {
    public static function getDefaultController() { return 'workspace'; }
}

abstract class FormzBaseManagerController extends modManagerController {
    /** @var Formz $formz */
    public $formz;

    public function initialize() {
        $this->formz = new Formz($this->modx);

        $this->addCss($this->formz->config['cssUrl'] . 'mgr.css');
        $this->addJavascript($this->formz->config['jsUrl'] . 'mgr/formz.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            Formz.config = ' . $this->modx->toJSON($this->formz->config) . ';
            Formz.config.connector_url = "' . $this->formz->config['connectorUrl'] . '";
        });
        </script>');

        return parent::initialize();
    }

    public function getLanguageTopics() {
        return array('formz:default');
    }

    public function checkPermissions() { return true; }
}
