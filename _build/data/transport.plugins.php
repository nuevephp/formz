<?php
/**
 * Formz
 *
 * Add plugins to build
 *
 * @package Formz
 * @subpackage build
 */

$plugs = array(
    'FormzTv' => array(
        'desc' => 'Formz helper snippet that generates the form.',
        'events' => array(
            // 'OnDocFormPrerender',
            // 'OnTVInputPropertiesList',
            'OnTVInputRenderList',
            'OnTVOutputRenderList',
            // 'OnTVOutputRenderPropertiesList',
        ),
    ),
);

$plugins = array();
$i = 0;

foreach($plugs as $key => $pl) {
    $i++;
    $sfilename = strtolower($key);
    $plugins[$i]= $modx->newObject('modPlugin');
    $plugins[$i]->fromArray(array(
        'id' => $i,
        'name' => $key,
        'description' => $pl['desc'],
        'plugincode' => getSnippetContent($sources['plugins'].'plugin.' . $sfilename . '.php'),
    ), '', true, true);

    $events = array();
    foreach ($pl['events'] as $event) {
        $events[$event] = $modx->newObject('modPluginEvent');
        $events[$event]->fromArray(array(
            'event' => $event,
            'priority' => 0,
            'propertyset' => 0,
        ), '', true, true);
    }

    if (is_array($events) && !empty($events)) {
        $plugins[$i]->addMany($events);
        $modx->log(xPDO::LOG_LEVEL_INFO, 'Packaged in '.count($events).' Plugin Events for ' . $key);
        flush();
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, 'Could not find plugin events for ' . $key);
    }
    unset($events);
}

return $plugins;
