<?php
$chnks = array(
    'emailTpl' => 'Email Template Layout',
    'fieldTpl' => 'Field Template Layout',
    'formTpl' => 'Form Template Layout',
);

$chunks = array();
$i = 0;

foreach($chnks as $cn => $cdesc) {
    $i++;
    $cfilename = strtolower($cn);
    $chunks[$i]= $modx->newObject('modChunk');
    $chunks[$i]->fromArray(array(
        'id' => $i,
        'name' => $cn,
        'description' => $cdesc,
        'snippet' => file_get_contents($sources['chunks'] . $cfilename . '.chunk.tpl'),
    ), '', true, true);
}

return $chunks;
