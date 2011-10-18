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
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

class tx_cpsdevlib_extmgm {

	/**
	*	Include a CSS file in frontend or backend (header part)
	*
	*	@param	string				$cssFile: SPath to css file
	*	@param	string				$cssName: File depending name to avoid duplicate insert
	*	@param	object				$pObj: Caller object needed for work with backend modules
	*	@param	string				$rel: Parameter "rel" for generated link-tag
	*	@param	string				$media: Parameter "media" for generated link-tag
	*	@param	string				$title: Parameter "title" for generated link-tag
	*	@return	boolean				Returns true when successfully inserted
	*
	*/
	function addCssFile($cssFile, $cssName, &$pObj, $rel = 'stylesheet', $media = 'all', $title = '') {

		$cssLink = '<link rel="'.htmlspecialchars($rel).'" type="text/css" href="'.htmlspecialchars($cssFile).'" media="'.htmlspecialchars($media).'"'.($title ? ' title="'.htmlspecialchars($title).'"' : '').$endingSlash.'>';

		// If CSS should be added to backend output (header part)

		if (TYPO3_MODE == 'BE') {
			if ((is_object($pObj)) AND (isset($pObj->content))) {
				if (strpos($pObj->content, $cssLink) === false) {
					$pObj->content = str_replace('</head>', LF.$cssLink.LF.'</head>', $pObj->content);

					return true;
				}
			}
		} elseif (TYPO3_MODE == 'FE') { // If CSS should be added to frontend output
			$endingSlash = ($GLOBALS['TSFE']->getPageRenderer()->getRenderXhtml()) ? ' /' : '';
			$GLOBALS['TSFE']->additionalHeaderData[$cssName] = $cssLink;

			return true;
		}

		return false;
	}

	/**
	*	Include inline CSS in frontend or backend (header part)
	*
	*	@param	string				$cssCode: Code to insert
	*	@param	string				$cssName: Code depending name to avoid duplicate insert
	*	@param	object				$pObj: Caller object needed for work with backend modules
	*	@return	boolean				Returns true when successfully inserted
	*
	*/
	function addCssInline($cssCode, $cssName, &$pObj) {

		$cssStyle = '<style type="text/css">'.LF.'/*<![CDATA[*/'.LF.'<!-- '.LF.$cssCode.LF.'-->'.LF.'/*]]>*/'.LF.'</style>';

		// If CSS should be added to backend output
		if (TYPO3_MODE == 'BE') {
			if ((is_object($pObj)) AND (isset($pObj->content))) {
				if (strpos($pObj->content, $cssStyle) === false) {
					$pObj->content = str_replace('</head>', LF.$cssStyle.LF.'</head>', $pObj->content);

					return true;
				}
			}
		} elseif (TYPO3_MODE == 'FE') { // If CSS should be added to frontend output
			$GLOBALS['TSFE']->additionalHeaderData[$cssName] = $cssStyle;

			return true;
		}

		return false;
	}

	/**
	*	Include a JavaScript file in frontend or backend (header part)
	*
	*	@param	string				$jsFile: Path to JavaScript file
	*	@param	string				$jsName: File depending name to avoid duplicate insert
	*	@param	object				$pObj: Caller object needed for work with backend modules
	*	@param	string				$type: Parameter "type" for generated script-tag
	*	@return	boolean				Returns true when successfully inserted
	*
	*/
	function addJavascriptFile($jsFile, $jsName, &$pObj, $type = 'text/javascript') {

		$jsScript = '<script src="'.htmlspecialchars($jsFile).'" type="'.htmlspecialchars($type).'"></script>';

		// If JS should be added to backend output
		if (TYPO3_MODE == 'BE') {
			if ((is_object($pObj)) AND (isset($pObj->content))) {
				if (strpos($pObj->content, $jsScript) === false) {
					$pObj->content = str_replace('</head>', LF.$jsScript.LF.'</head>', $pObj->content);

					return true;
				}
			}
		} elseif (TYPO3_MODE == 'FE') { // If JS should be added to frontend output
			$GLOBALS['TSFE']->additionalHeaderData[$jsName] = $jsScript;

			return true;
		}

		return false;
	}

	/**
	*	Include inline JavaScript in frontend or backend (header part)
	*
	*	@param	string				$jsCode: Code to insert
	*	@param	string				$jsName: Code depending name to avoid duplicate insert
	*	@param	object				$pObj: Caller object needed for work with backend modules
	*	@param	string				$type: Parameter "type" for generated script-tag
	*	@return	boolean				Returns true when successfully inserted
	*
	*/
	function addJavascriptInline($jsCode, $jsName, &$pObj, $type = 'text/javascript') {

		$jsScript = '<script type="'.htmlspecialchars($type).'">'.LF.$jsCode.LF.'</script>';

		// If JS should be added to backend output
		if (TYPO3_MODE == 'BE') {
			if ((is_object($pObj)) AND (isset($pObj->content))) {
				if (strpos($pObj->content, $jsScript) === false) {
					$pObj->content = str_replace('</head>', LF.$jsScript.LF.'</head>', $pObj->content);

					return true;
				}
			}
		} elseif (TYPO3_MODE == 'FE') { // If JS should be added to frontend output
			$GLOBALS['TSFE']->additionalHeaderData[$jsName] = $jsScript;

			return true;
		}

		return false;
	}
}
?>