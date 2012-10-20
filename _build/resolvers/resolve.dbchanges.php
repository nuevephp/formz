<?php
/**
 * Formz
 *
 * Resolve changes to db model
 *
 * @package Formz
 * @subpackage build
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('formz.core_path',null,$modx->getOption('core_path').'components/formz/').'model/';
            $modx->addPackage('formz',$modelPath);

            $formzValidation = $modx->getTableName('fmzFormsValidation');
            $sql = "ALTER TABLE {$formzValidation} ADD `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`)";

            $modx->query($sql);
            break;
    }
}
return true;
