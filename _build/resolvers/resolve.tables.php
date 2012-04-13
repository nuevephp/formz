<?php
/**
 * FormbuilderX
 */
/**
 * Resolve creating db tables
 *
 * @package FormbuilderX
 * @subpackage build
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('FormbuilderX.core_path',null,$modx->getOption('core_path').'components/FormbuilderX/').'model/';
            $modx->addPackage('FormbuilderX',$modelPath);

            $manager = $modx->getManager();

            $manager->createObjectContainer('FormbuilderXItem');

            break;
        case xPDOTransport::ACTION_UPGRADE:
            break;
    }
}
return true;
