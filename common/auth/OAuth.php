<?php
namespace Phanbook\Auth;

use Phalcon\Mvc\User\Component;

/**
 * Class Auth2
 */
class OAuth extends Component
{


    public function bootstrap()
    {
        $dsn      = 'mysql:dbname=store;host=localhost';
        $username = 'root';
        $password = 'phanbook';
        $storage = new \OAuth2\Storage\Pdo(
            array(
                'dsn' => $dsn,
                'username' => $username,
                'password' => $password
            )
        );
        // Pass a storage object or array of storage objects to the OAuth2 server class
        $server = new \OAuth2\Server($storage);

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

        // Add the "Authorization Code" grant type (this is where the oauth magic happens)
        $server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));
        return $server;
    }
}
