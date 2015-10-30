<?php
/**
 * Formz
 */
/**
 * Verify Formit is latest or equal in version
 *
 * @var modX $modx
 * @var xPDOTransport $transport
 * @var array $options
 * @package articles
 */
$newer= true;
if ($transport && $transport->xpdo) {
	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
		case xPDOTransport::ACTION_UPGRADE:
			$modx =& $transport->xpdo;

			/* define Archivist version */
			$newVersion = '1.1.0-pl';
			$newVersionMajor = '1';
			$name = 'formitfastpack';

			/* now loop through packages and check for newer versions
			 * Do not install if newer or equal versions are found */
			$newer = true;
			$modx->addPackage('modx.transport',$modx->getOption('core_path').'model/');
			$c = $modx->newQuery('transport.modTransportPackage');
			$c->where(array(
				'package_name' => $name,
				'version_major:>=' => $newVersionMajor,
			));
			$packages = $modx->getCollection('transport.modTransportPackage',$c);
			/** @var modTransportPackage $package */
			foreach ($packages as $package) {
				if ($package->compareVersion($newVersion)) {
					$newer = false;
					break;
				}
			}
			break;
	}
}

return $newer;