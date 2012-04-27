<?php
/**
 * @package formz
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/fmzformsdata.class.php');
class fmzFormsData_mysql extends fmzFormsData {}