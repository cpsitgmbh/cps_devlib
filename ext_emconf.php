<?php

########################################################################
# Extension Manager/Repository config file for ext "cps_devlib".
#
# Auto generated 18-10-2011 19:16
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Developer library',
	'description' => 'Provides new functions used by CPS-IT (cps_*) extensions. May also be useful to any other extension developer. See manual for more information.',
	'category' => 'misc',
	'shy' => 0,
	'version' => '0.2.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Nicole Cordes',
	'author_email' => 'cordes@cps-it.de',
	'author_company' => 'CPS-IT GmbH (http://www.cps-it.de)',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.0.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:7:{s:9:"ChangeLog";s:4:"c6b7";s:25:"class.tx_cpsdevlib_db.php";s:4:"e044";s:28:"class.tx_cpsdevlib_debug.php";s:4:"9f34";s:26:"class.tx_cpsdevlib_div.php";s:4:"ba86";s:16:"ext_autoload.php";s:4:"7261";s:12:"ext_icon.gif";s:4:"9f03";s:14:"doc/manual.sxw";s:4:"5099";}',
);

?>