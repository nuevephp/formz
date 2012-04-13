<?php
/**
 * FormbuilderX
 */
require_once dirname(__FILE__) . '/model/FormbuilderX/FormbuilderX.class.php';
/**
 * @package FormbuilderX
 */
class IndexManagerController extends modExtraManagerController {
    public static function getDefaultController() { return 'workspace'; }
}

abstract class FormbuilderXBaseManagerController extends modManagerController {
    /** @var FormbuilderX $FormbuilderX */
    public $FormbuilderX;

    public function initialize() {
        $this->FormbuilderX = new FormbuilderX($this->modx);

        $this->addCss($this->FormbuilderX->config['cssUrl'] . 'mgr.css');
        $this->addJavascript($this->FormbuilderX->config['jsUrl'] . 'mgr/FormbuilderX.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            FormbuilderX.config = ' . $this->modx->toJSON($this->FormbuilderX->config) . ';
            FormbuilderX.config.connector_url = "' . $this->FormbuilderX->config['connectorUrl'] . '";
        });
        </script>');

        return parent::initialize();
    }

    public function getLanguageTopics() {
        return array('FormbuilderX:default');
    }

    public function checkPermissions() { return true; }
}
