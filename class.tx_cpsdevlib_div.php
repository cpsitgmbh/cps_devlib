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

class tx_cpsdevlib_div {

	/**
	*	Splits the given string by delimeters. If set trim results and remove empty values.
	*
	*	@param	string				$theString: String to split
	*	@param	string				$theDelims: Regular expression used to split first argument
	* @param	boolean				$useTrim: If set trim function is used on each array item
	* @param	boolean				$removeEmptyValues: If set all empty items are removed
	*	@param	integer				$theLimit: Defines the size of returned array
	*	@return	array					The exploded array
	*
	*/
	function explode($theString, $theDelims = ',;.:\-\+&\/', $useTrim = true, $removeEmptyValues = true, $theLimit = 0) {
		$pattern = '/['.$theDelims.']/';
		$result = preg_split($pattern, $theString);
		$result = self::removeArrayValues($result, $removeEmptyValues, $theLimit);

		return $result;
	}

	/**
	*	Converts the given mixed data into a list (array).
	*
	*	@param	mixed					$theData: Data to convert to list
	*	@param	string				$theDelims: Character(s) used to split first argument
	*	@param	boolean				$useTrim: If set trim function is used to each array item
	* @param	boolean				$removeEmptyValues: If set all empty items are removed
	* @param	boolean				$useArrayKeys: If set array keys are used to get list
	*	@param	integer				$theLimit: Defines the size of returned array
	*	@return	string				An array list (one-dimensional)
	*
	*/
	function toListArray($theData, $theDelims = ',;.:\-\+&\/', $useTrim = true, $removeEmptyValues = true, $useArrayKeys = false, $theLimit = 0) {

		if (is_string($theData)) {
			return self::explode($theData, $theDelims, 1, 1);
		} elseif (is_array($theData)) {
			$result = array();
			foreach($theData as $key => $value) {
				if (is_array($value)) {
					$result[] = $key;
					$result = array_merge($result, self::toListArray($value, $theDelims, $useTrim, $removeEmptyValues, $useArrayKeys));
				} else {
					if ($useArrayKeys) {
						$result[] = $key;
					} else {
						$result[] = $value;
					}
				}
			}
			$result = self::removeArrayValues($result, $useTrim, $removeEmptyValues, $theLimit);

			return $result;
		}

		return array();
	}

	/**
	*	Converts the given mixed data to list (string). If array you can use array keys for list.
	*
	*	@param	mixed					$theData: Data to convert to list
	*	@param	string				$theGlue: Character(s) used to join list
	*	@param	string				$theDelims: Character(s) used to split first argument
	*	@param	boolean				$useTrim: If set trim function is used to each array item
	* @param	boolean				$removeEmptyValues: If set all empty items are removed
	* @param	boolean				$useArrayKeys: If set array keys are used to get list
	*	@param	integer				$theLimit: Defines the size of returned array
	*	@return	string				A list joined by second argument
	*
	*/
	function toListString($theData, $theGlue, $theDelims = ',;.:\-\+&\/', $useTrim = true, $removeEmptyValues = true, $useArrayKeys = false, $theLimit = 0) {
		return implode($theGlue, self::toListArray($theData, $theDelims, $useTrim, $removeEmptyValues, $useArrayKeys, $theLimit));
	}

	function removeArrayValues($theArray, $useTrim = true, $removeEmptyValues = true, $theLimit = 0) {
		$result = $theArray;

		if ($useTrim) $result = array_map('trim', $result);

		if ($removeEmptyValues) {
			$tempArray = array();
			foreach($result as $value) {
				if ($value != '') {
					$tempArray[] = $value;
				}
			}
			$result = $tempArray;
		}

		if ($theLimit != 0) {
			if ($theLimit < 0) {
				$result = array_slice($result, $theLimit);
			} elseif (count($result) > $theLimit) {
				$result = array_slice($result, 0, $theLimit);
			}
		}

		return $result;
	}
}
?>