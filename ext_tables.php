<?php

defined('TYPO3') or die();

use BN\BnPackage\Globals\Constants;

(static function () {
    $extKey = Constants::EXT_KEY;

    // add custom css in Typo3 backend
    $GLOBALS['TYPO3_CONF_VARS']['BE']['stylesheets'][$extKey] = "EXT:{$extKey}/Resources/Public/Css/Backend";
})();
