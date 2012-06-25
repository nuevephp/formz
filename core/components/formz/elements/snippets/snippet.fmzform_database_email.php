<?php
/**
 * @package formz
 * @var Formz $fmz
 */
$corePath = $modx->getOption('formz.core_path', null, $modx->getOption('core_path') . 'components/formz/');
$fmz = $modx->getService('formz', 'formz', $corePath . 'model/formz/');
if (!($fmz instanceof Formz)) return '';

/* Path to Formz processors */
$path = $modx->getOption('processorsPath', $fmz->config, $corePath . 'processors/');

if (!$hook->hasErrors()) {
	$formid = $modx->getOption('formid', $hook->formit->config, '');
	$excludedFields = $modx->getOption('excludeFields', $hook->formit->config, '');
	$excludedFields = $modx->getOption('emailTpl', $hook->formit->config, '');
	$data = $hook->getValues();

	/* This needs to be the same as in the fmzFormz snippet */
	$formIdentifier = 'form' . $formid;

	// exclude fields from database save
	if (!empty($excludedFields)) {
		$fieldsArr = explode(',', $excludedFields);
		foreach ($fieldsArr as $field) {
			unset($data[strtolower($field)]);
		}
	}

	$message = $fmz->getChunk($emailTpl, $data);

	$modx->getService('mail', 'mail.modPHPMailer');
	$modx->mail->set(modMail::MAIL_BODY, $message);
	$modx->mail->set(modMail::MAIL_FROM, $modx->getOption('emailsender'));
	$modx->mail->set(modMail::MAIL_FROM_NAME, 'Automated Backups');
	$modx->mail->set(modMail::MAIL_SENDER, 'Automated Backups');
	$modx->mail->set(modMail::MAIL_SUBJECT, 'Backup for ' . date('Y-m-d'));
	$modx->mail->address('to', $mailto);
	$modx->mail->address('reply-to', $modx->getOption('emailsender'));
	$modx->mail->setHTML(true);
	if (!$modx->mail->send()) {
	    $modx->log(modX::LOG_LEVEL_ERROR, 'An error occurred while trying to email the automated backup: ' . $modx->mail->mailer->ErrorInfo);
	}
	$modx->mail->reset();
}
