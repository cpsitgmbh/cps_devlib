<?php
	// Auto load extension classes
	$extensionPath = t3lib_extMgm::extPath('cps_devlib');

	return array(
		'tx_cpsdevlib_db' => $extensionPath.'class.tx_cpsdevlib_db.php',
		'tx_cpsdevlib_debug' => $extensionPath.'class.tx_cpsdevlib_debug.php',
		'tx_cpsdevlib_div' => $extensionPath.'class.tx_cpsdevlib_div.php',
	);
?>