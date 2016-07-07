<?php
/**
 * Phanbook : Delightfully simple forum software
 *
 * Licensed under The GNU License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */
$loader = new Phalcon\Loader();
/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
    [
        'App\Controllers'  => ROOT_DIR . 'controllers/',
        'App\Models'       => ROOT_DIR . 'core/models/',
        'App\Responses'    => ROOT_DIR . 'core/responses',
        'App\Auth'         => ROOT_DIR . 'core/auth'
    ]
);
$loader->register();
