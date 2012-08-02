<?php
/**
 * @package formz
 * @var Formz $fmz
 */
$corePath = $modx->getOption('formz.core_path', null, $modx->getOption('core_path') . 'components/formz/');
require_once $corePath . '/model/formz/formzhooks.class.php';

$fmz = $modx->getService('formz', 'formz', $corePath . 'model/formz/');
if (!($fmz instanceof Formz)) return '';

$fmzHook = new formzHooks($fmz, $hook);
$fmzHook->dbSaveAndEmail();
return true;
