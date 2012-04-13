<?php
/**
 * FormbuilderX
 */
/**
 * Add snippets to build
 *
 * @package FormbuilderX
 * @subpackage build
 */
$snippets = array();

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'FormbuilderX',
    'description' => 'Displays Items.',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.FormbuilderX.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.FormbuilderX.php';
$snippets[0]->setProperties($properties);
unset($properties);

return $snippets;
