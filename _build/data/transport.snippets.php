<?php
/**
 * Formz
 *
 * Add snippets to build
 *
 * @package Formz
 * @subpackage build
 */
$snippets = array();

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'formz',
    'description' => 'Displays Items.',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.formz.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.formz.php';
$snippets[0]->setProperties($properties);
unset($properties);

return $snippets;
