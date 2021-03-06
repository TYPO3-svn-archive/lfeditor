<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) Stefan Galinski (stefan.galinski@gmail.com)
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
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * adds a new error exception
 */
class LFException extends Exception {
	/**
	 * @var string
	 */
	private static $errorWrap = '|';

	/**
	 * @var string
	 */
	private static $noticeWrap = '|';

	/**
	 * @var string
	 */
	protected $generatedContent = '';

	/**
	 * @param string $content
	 * @return void
	 */
	public function setGeneratedContent($content) {
		$this->generatedContent = $content;
	}

	/**
	 * @return string
	 */
	public function getGeneratedContent() {
		return $this->generatedContent;
	}

	/**
	 * Constructor
	 *
	 * @param string $msg error message (this message would be translated by TYPO3)
	 * @param integer $wrapType type of wrap (0 = error (default), 1 = notice)
	 * @param string $staticMsg static message (appended at the localized string)
	 */
	public function __construct($msg, $wrapType = 0, $staticMsg = '') {
		if (!empty($msg)) {
			/** @var \TYPO3\CMS\Lang\LanguageService $lang */
			$lang = $GLOBALS['LANG'];
			$msg = $lang->getLL($msg);
		}

		if (empty($msg)) {
			$msg = 'LFExeption: no error message given !!!';
		}

		parent::__construct($this->prepare($msg . ' ' . $staticMsg, $wrapType));
	}

	/**
	 * set the error wrap
	 *
	 * @param string $errorWrap error wrap
	 * @param string $noticeWrap notice wrap
	 * @return void
	 */
	public static function setWrap($errorWrap, $noticeWrap) {
		self::$errorWrap = $errorWrap;
		self::$noticeWrap = $noticeWrap;
	}

	/**
	 * preparation of the error message
	 *
	 * @param string $msg error message (this message would be translated)
	 * @param integer $wrapType type of wrap (0 = error (default), 1 = notice)
	 * @return string prepared message
	 */
	private function prepare($msg, $wrapType = 0) {
		if (!$wrapType) {
			return str_replace('|', $msg, self::$errorWrap);
		} else {
			return str_replace('|', $msg, self::$noticeWrap);
		}
	}
}

?>
