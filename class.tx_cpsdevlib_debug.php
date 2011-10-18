<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Nicole Cordes <cordes@cps-it.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

class tx_cpsdevlib_debug {

	/**
	*	Gets rootline of a table downwards
	*
	*	@param	mixed					$theData: Variable to dump (if allowed)
	*	@return	string				The dumped variable
	*
	*/
	function var_dump($theData) {
		global $TYPO3_CONF_VARS;

		// If displayErrors is turned on
		if (($displayErrors = intval($TYPO3_CONF_VARS['SYS']['displayErrors'])) != '-1')	{

			// Check for development IP mask if configured
			if ($displayErrors == 2)	{
				if (t3lib_div::cmpIP(t3lib_div::getIndpEnv('REMOTE_ADDR'), $TYPO3_CONF_VARS['SYS']['devIPmask']))	{
					$displayErrors = 1;
				} else {
					$displayErrors = 0;
				}
			}

			if ($displayErrors == 1) {
				var_dump($theData);
			}
		}
	}
}
?>