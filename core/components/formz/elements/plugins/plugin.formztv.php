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
        //$modx->event->output($corePath.'processors/mgr/tv/input/options/');
        break;
    case 'OnTVOutputRenderPropertiesList':
         $modx->event->output($corePath.'processors/mgr/tv/output/options/');
        break;
    case 'OnDocFormPrerender':
        break;
}
return;
