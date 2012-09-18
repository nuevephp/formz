<?php
$modx->lexicon->load('tv_widget', 'formz:tv');
$root = $modx->getOption('formz.core_path', null, $this->modx->getOption('core_path') . 'components/formz/');

$lang = $modx->lexicon->fetch('formz.output.properties.', true);
$modx->smarty->assign('fmz', $lang);

return $modx->smarty->fetch($root . 'templates/elements/tv/renders/properties/formz.tpl');
