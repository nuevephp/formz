<?php
/**
 * Formz
 * 
 * Formz Connector
 *
 * @package Formz
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('formz.core_path', null, $modx->getOption('core_path') . 'components/formz/');
require_once $corePath . 'model/formz/formz.class.php';
$modx->formz = new formz($modx);

$modx->lexicon->load('formz:default');

/* handle request */
$path = $modx->getOption('processorsPath', $modx->formz->config,$corePath . 'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));
