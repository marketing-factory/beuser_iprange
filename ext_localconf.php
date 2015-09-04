<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    $_EXTKEY,
    'auth' /* sv type */,
    'tx_beuseriprange_sv1' /* sv key */,
    array(
        'title' => 'IP-Range Authentication',
        'description' => 'Authenticates against IP-range lists',
        'subtype' => 'authUserBE',
        'available' => true,
        'priority' => 70,
        'quality' => 75,
        'os' => '',
        'exec' => '',
        'classFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) .
            'sv1/class.tx_beuseriprange_sv1.php',
        'className' => 'tx_beuseriprange_sv1',
    )
);
