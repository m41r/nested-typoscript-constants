<?php

defined('TYPO3') or die();

use BN\BnPackage\Globals\Constants;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function () {
    $extKey = Constants::EXT_KEY;

    // add userTsConfig
    ExtensionManagementUtility::addUserTSConfig(
        "@import 'EXT:{$extKey}/Configuration/TSconfig/User/_ALL.tsconfig'>"
    );

    // add pageTsConfig
    ExtensionManagementUtility::addPageTSConfig(
        "@import 'EXT:{$extKey}/Configuration/TSconfig/Page/_ALL.tsconfig'>"
    );

    // add overrides for xlf labels
    $maskXLF = 'EXT:mask/Resources/Private/Language/locallang_mask.xlf';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride'][$maskXLF][] = 'EXT:bn_package/Resources/Private/Language/locallang_mask.xlf';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['de'][$maskXLF][] = 'EXT:bn_package/Resources/Private/Language/de.locallang_mask.xlf';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['it'][$maskXLF][] = 'EXT:bn_package/Resources/Private/Language/it.locallang_mask.xlf';
})();
