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
                $modx->formz = $modx->getService('formz', 'formz', $modelPath);
            }

            $formzForms = $modx->getTableName('fmzForms');
            $formzValidation = $modx->getTableName('fmzFormsValidation');
            $sqlFormsHooksField = sprintf(
                "ALTER TABLE %s ADD `hooks` TEXT NULL AFTER `identifier`",
                $formzForms
            );
            $sqlFormsPropertiesField = sprintf(
                "ALTER TABLE %s ADD `properties` TEXT NULL AFTER `action_button`",
                $formzForms
            );
            $sqlValidationIdField = sprintf(
                "ALTER TABLE %s ADD `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`)",
                $formzValidation
            );

            $modx->exec($sqlFormsHooksField);
            $modx->exec($sqlFormsPropertiesField);
            $modx->exec($sqlValidationIdField);

            $success = true;
            break;
    }
}
