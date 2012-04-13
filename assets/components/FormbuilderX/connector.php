<?php
/**
 * FormbuilderX
 */
/**
 * FormbuilderX Connector
 *
 * @package FormbuilderX
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('FormbuilderX.core_path',null,$modx->getOption('core_path').'components/FormbuilderX/');
require_once $corePath.'model/FormbuilderX/FormbuilderX.class.php';
$modx->FormbuilderX = new FormbuilderX($modx);

$modx->lexicon->load('FormbuilderX:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->FormbuilderX->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));
