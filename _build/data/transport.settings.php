<?php
/**
 * Formz
 *
 * Loads system settings into build
 *
 * @package Formz
 * @subpackage build
 */
$settings = array();

$settings['formz.mandrill_api_username']= $modx->newObject('modSystemSetting');
$settings['formz.mandrill_api_username']->fromArray(array(
    'key' => 'formz.mandrill_api_username',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'formz',
    'area' => 'Formz',
),'',true,true);

$settings['formz.mandrill_api_key']= $modx->newObject('modSystemSetting');
$settings['formz.mandrill_api_key']->fromArray(array(
    'key' => 'formz.mandrill_api_key',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'formz',
    'area' => 'Formz',
),'',true,true);


return $settings;
