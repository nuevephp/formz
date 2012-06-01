<?php
/**
 * Formz
 *
 * Add snippets to build
 *
 * @package Formz
 * @subpackage build
 */

$snips = array(
    'fmzForms' => 'Formz helper snippet that generates the form.',
    'fmzFormz_database' => 'Formz hook to save form to database.',
);

$snippets = array();
$i = 0;

foreach($snips as $sn => $sdesc) {
    $i++;
    $sfilename = substr(strtolower($sn), 3);
    $snippets[$i]= $modx->newObject('modSnippet');
    $snippets[$i]->fromArray(array(
        'id' => $i,
        'name' => $sn,
        'description' => $sdesc,
        'snippet' => getSnippetContent($sources['snippets'].'snippet.' . $sfilename . '.php'),
        'static' => 1,
        'static_file' => $sources['snippets'].'snippet.' . $sfilename . '.php',
    ), '', true, true);
    $properties = include $sources['build'].'properties/snippets/properties.' . $sfilename . '.php';
    $snippets[$i]->setProperties($properties);
    unset($properties);
}

return $snippets;
