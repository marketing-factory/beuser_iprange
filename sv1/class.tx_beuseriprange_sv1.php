<?php
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
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */


/**
 * Service "IP-Range Authentication" for the "beuser_iprange" extension.
 *
 * @author    Steffen Kamper <info@sk-typo3.de>
 * @package    TYPO3
 * @subpackage    tx_beuseriprange
 */
class tx_beuseriprange_sv1 extends \TYPO3\CMS\Sv\AbstractAuthenticationService
{
    /**
     * authenticate a user
     *
     * @param    array $user Data of user.
     * @return    boolean
     */
    public function authUser($user)
    {
        global $TYPO3_CONF_VARS;

        // if there's no IP-list given then the user is valid
        $OK = 100;

        // given IP-Address
        $userIP = $this->authInfo['REMOTE_ADDR'];

        // configured IP-range
        // Example for admins:
        // $TYPO3_CONF_VARS['BE']['adminAuth']['ipRange'] = '192.168.0.1-192.168.0.15,96.0.112.80-96.0.112.96';
        // Example for other BE-user:
        // $TYPO3_CONF_VARS['BE']['userAuth']['ipRange'] = '192.168.0.1-192.168.0.15,96.0.112.80-96.0.112.96';
        if ($user['admin']) {
            $ipData = $TYPO3_CONF_VARS['BE']['adminAuth']['ipRange'];
        } else {
            $ipData = $TYPO3_CONF_VARS['BE']['userAuth']['ipRange'];
        }

        if ($ipData) {
            $ranges = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $ipData, true);

            if ($ranges) {
                // set to false, so only user within range get allowed
                $OK = false;
                // now check the ranges
                foreach ($ranges as $range) {
                    $ipAddresses = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('-', $range, true);
                    if (\TYPO3\CMS\Core\Utility\GeneralUtility::validIP($ipAddresses[0]) &&
                        \TYPO3\CMS\Core\Utility\GeneralUtility::validIP($ipAddresses[1])) {
                        if ($this->inIPrange($ipAddresses[0], $ipAddresses[1], $userIP)) {
                            //valid, allow login
                            $OK = 100;
                        }
                    }
                }
            }
        }

        return $OK;
    }

    protected function inIPrange($ipStart, $ipEnd, $givenIP)
    {
        $start = ip2long($ipStart);
        $end = ip2long($ipEnd);
        $cmp = ip2long($givenIP);

        return ($cmp >= $start && $cmp <= $end);
    }
}
