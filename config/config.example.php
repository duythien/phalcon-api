<?php
/**
 * The base configuration for Phanbook
 *
 * The config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Application
 * * Languages
 * * Token google,github,facebook
 * * Mail
 *
 * @link https://github.com/phanbook/docs/config.md
 *
 * @package Phanbook
 */
define('VERSION', 'v1');

return new \Phalcon\Config(
    [
        /**
         * The name of the database
         */
        'database'  => [
            'mysql'     => [
                'host'     => 'localhost',
                'username' => 'root',
                'password' => '',
                'dbname'   => 'app',
                'charset'  => 'utf8',
            ]
        ],
        /**
         * Application settings
         */
        'app' => [
            //The site name, you should change it to your name website
            'name'  => 'Phanbook',

            //In a few words, explain what this site is about.
            'publicUrl' => 'http://phanbook.com',
            /**
             * Change URL cdn if you want it
             */
            'development'    => [
                'staticBaseUri' => '/',
            ],
            'production'  => [
                'staticBaseUri' => '/',
            ],
            /**
             * For developers: Phanbook debugging mode.
             *
             * Change this to true to enable the display of notices during development.
             * It is strongly recommended that plugin and theme developers use
             * in their development environments.
             */
            'debug' => true
        ],

        /**
         * You need to change mail parameters below
         *
         * @link http://github.com/phanbook/docs/mail.md
         */
        'mail'        => [
            'fromName'     => 'Phanbook',
            'fromEmail'    => 'phanbook@no-reply',
            'smtp'         => [
                'server'   => 'smtp.mandrillapp.com',
                'port'     => '587',
                'security' => 'tls',
                'username' => 'phanbook@phanbook.com',
                'password' => '',
            ]
        ],
        /**
         * Set languages you want to it, you can see example
         *
         * @link http://github.com/phanbook/docs/lanuage.md
         */
        'language' => 'en_EN'
    ]
);
