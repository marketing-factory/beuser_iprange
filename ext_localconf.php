<?php
defined('TYPO3_MODE') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    'beuser_iprange',
    'auth',
    \Mfc\BeuserIprange\Services\AuthenticationService::class,
    array(
        'title' => 'IP-Range Authentication',
        'description' => 'Authenticates against IP-range lists',
        'subtype' => 'authUserBE',
        'available' => true,
        'priority' => 70,
        'quality' => 75,
        'os' => '',
        'exec' => '',
        'className' => \Mfc\BeuserIprange\Services\AuthenticationService::class,
    )
);
