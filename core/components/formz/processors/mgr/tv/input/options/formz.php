<?php
$root = $modx->getOption('formz.core_path', null, $this->modx->getOption('core_path') . 'components/formz/');
$modx->lexicon->load('formz:default');

return $modx->smarty->fetch($root . 'templates/elements/tv/renders/properties/formz.tpl');
