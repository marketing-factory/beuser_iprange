<?php

########################################################################
# Extension Manager/Repository config file for ext "beuser_iprange".
#
# Auto generated 02-10-2011 07:50
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
    'title' => 'IP-range for Admins/Be-user',
    'description' => 'restrict BE-user to IP-range',
    'category' => 'services',
    'shy' => 0,
    'version' => '2.1.0',
    'dependencies' => '',
    'conflicts' => '',
    'priority' => '',
    'loadOrder' => '',
    'module' => '',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearcacheonload' => 1,
    'lockType' => '',
    'author' => 'Steffen Kamper, Simon Schmidt',
    'author_email' => 'typo3@marketing-factory.de',
    'author_company' => '',
    'CGLcompliance' => '',
    'CGLcompliance_note' => '',
    'constraints' => array(
        'depends' => array(
            'php' => '5.3.0-7.0.99',
            'typo3' => '6.2.0-7.9.99',
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
);
