<?php
require_once (dirname(__FILE__) . '/update.class.php');

class FormzFieldUpdateFromGridOrderProcessor extends FormzFieldUpdateProcessor {
	public function initialize() {
		$data = $this->getProperty('data');

		if (empty($data)) return $this->modx->lexicon('invalid_data');
		$data = $this->modx->fromJSON($data);

		if (empty($data)) return $this->modx->lexicon('invalid_data');

		foreach($data as $field) {
			$fmzFormsFields = $this->modx->getObject($this->classKey, array(
				'id' => $field['id']
			));
			if (empty($fmzFormsFields)) {
				$fmzFormsFields = $this->modx->newObject($this->classKey);
			}
			$fmzFormsFields->set('order', $field['order']);
			$fmzFormsFields->save();
		}

		$this->unsetProperty('data');
	}
}

return 'FormzFieldUpdateFromGridOrderProcessor';
