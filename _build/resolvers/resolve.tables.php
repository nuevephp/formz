<?php
/**
 * Formz
 *
 * Resolve creating db tables
 *
 * @package Formz
 * @subpackage build
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('formz.core_path',null,$modx->getOption('core_path').'components/formz/').'model/';
            $modx->addPackage('formz',$modelPath);

            $manager = $modx->getManager();

            /* Model Classes names */
            $objects = array(
                'fmzForms',
                'fmzFormsFields',
                'fmzFormsValidation',
                'fmzFormsData',
                'fmzFormsDataFields'
            );

            foreach($objects as $object) {
                $manager->createObjectContainer($object);
            }

            break;
        case xPDOTransport::ACTION_UPGRADE:
            break;
    }
}
return true;
