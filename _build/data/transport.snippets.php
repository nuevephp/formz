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
    'fmzForm_database' => 'Formz hook to save form to database.',
    'fmzForm_database_email' => 'Formz hook to save form to database and email to recipients address.',
);

$snippets = array();
$i = 0;

foreach($snips as $sn => $sdesc) {
    $i++;
    $sfilename = strtolower($sn);
    $snippets[$i]= $modx->newObject('modSnippet');
    $snippets[$i]->fromArray(array(
        'id' => $i,
        'name' => $sn,
        'description' => $sdesc,
        'snippet' => getSnippetContent($sources['snippets'] . 'snippet.' . $sfilename . '.php'),
    ), '', true, true);

    $property = $sources['build'] . 'properties/properties.' . $sfilename . '.php';
    if (file_exists($property)) {
        $properties = include $property;
        $snippets[$i]->setProperties($properties);
        unset($properties);
    }
}

return $snippets;
