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
    $success = false;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            if (!isset($modx->formz) || $modx->formz === null) {
                $modelPath = $modx->getOption(
                    'formz.core_path',
                    null,
                    $modx->getOption('core_path') . 'components/formz/'
                ) . 'model/';
                $modx->addPackage('formz', $modelPath);
                $modx->formz = $modx->getService('formz', 'Formz', $modelPath);
            }

            $formzForms = $modx->getTableName('fmzForms');
            $formzValidation = $modx->getTableName('fmzFormsValidation');
            $sqlFormsRedirectToField = sprintf(
                "ALTER TABLE %s ADD `redirect_to` INT(10) UNSIGNED NULL AFTER `identifier`",
                $formzForms
            );
            $sqlValidationIdField = sprintf(
                "ALTER TABLE %s ADD `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`)",
                $formzValidation
            );

            $modx->exec($sqlFormsRedirectToField);
            $modx->exec($sqlValidationIdField);

            $success = true;
            break;
    }
}
