<?php
namespace Mfc\BeuserIprange\Services;

use TYPO3\CMS\Core\Authentication\AbstractUserAuthentication;
use TYPO3\CMS\Core\Service\AbstractService;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008 Steffen Kamper <info@sk-typo3.de>
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
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Service "IP-Range Authentication" for the "beuser_iprange" extension.
 *
 * configured IP-range
 *      Example for admins:
 *      $GLOBALS['TYPO3_CONF_VARS']['BE']['adminAuth']['ipRange'] = '192.168.0.1-192.168.0.15,96.0.112.80-96.0.112.96';
 *      Example for other BE-user:
 *      $GLOBALS['TYPO3_CONF_VARS']['BE']['userAuth']['ipRange'] = '192.168.0.1-192.168.0.15,96.0.112.80-96.0.112.96';
 *
 */
class AuthenticationService extends AbstractService
{
    /**
     * @param $subType
     * @param array $loginData
     * @param array $authenticationInformation
     * @param AbstractUserAuthentication $parentObject
     */
    public function initAuth(
        $subType,
        array $loginData,
        array $authenticationInformation,
        AbstractUserAuthentication &$parentObject
    ) {

    }

    /**
     * authenticate a user
     *
     * @param    array $user Data of user.
     * @return    boolean
     */
    public function authUser($user)
    {
        // if there's no IP-list given then the user is valid
        $result = 100;

        $userIP = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REMOTE_ADDR');
        if ($user['admin']) {
            $ipData = $GLOBALS['TYPO3_CONF_VARS']['BE']['adminAuth']['ipRange'];
        } else {
            $ipData = $GLOBALS['TYPO3_CONF_VARS']['BE']['userAuth']['ipRange'];
        }

        if ($ipData) {
            $ranges = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $ipData, true);

            if ($ranges) {
                // set to false, so only user within range get allowed
                $result = false;
                // now check the ranges
                foreach ($ranges as $range) {
                    $ipAddresses = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('-', $range, true);
                    if (\TYPO3\CMS\Core\Utility\GeneralUtility::validIP($ipAddresses[0]) &&
                        \TYPO3\CMS\Core\Utility\GeneralUtility::validIP($ipAddresses[1])) {
                        if ($this->inIPrange($ipAddresses[0], $ipAddresses[1], $userIP)) {
                            // valid, allow login
                            $result = 100;
                        }
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @param string $ipStart
     * @param string $ipEnd
     * @param string $givenIP
     *
     * @return bool
     */
    protected function inIPrange($ipStart, $ipEnd, $givenIP)
    {
        $start = ip2long($ipStart);
        $end = ip2long($ipEnd);
        $cmp = ip2long($givenIP);

        return ($cmp >= $start && $cmp <= $end);
    }
}
