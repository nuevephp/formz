<?php
/**
 * Handles plugin events for Formz Custom TV
 *
 * @package formz
 */
$corePath = $modx->getOption('formz.core_path', null, $modx->getOption('core_path') . 'components/formz/');
switch ($modx->event->name) {
    case 'OnTVInputRenderList':
        $modx->event->output($corePath.'processors/mgr/tv/input/');
        break;
    case 'OnTVOutputRenderList':
        $modx->event->output($corePath.'processors/mgr/tv/output/');
        break;
    case 'OnTVInputPropertiesList':
        //$modx->event->output($corePath.'processors/mgr/tv/inputoptions/');
        break;
    case 'OnTVOutputPropertiesList':
        // $modx->event->output($corePath.'templates/elements/tv/renders/properties/');
        break;
    case 'OnDocFormPrerender':
        break;
}
return;
