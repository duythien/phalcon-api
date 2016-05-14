<?php
namespace App\Auth;

use Phalcon\Mvc\User\Component;

/**
 * Class Auth2
 */
class OAuth extends Component
{
    /**
     *
     * @var object
     */
    public $server;

    public function __construct()
    {
        $this->server = $this->bootstrap();

    }
    protected function bootstrap()
    {
        $db = $this->db;
        $storage = new \OAuth2\Storage\Pdo($db->getInternalHandler());
        // Pass a storage object or array of storage objects to the OAuth2 server class
        $server = new \OAuth2\Server($storage);

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

        // Add the "Authorization Code" grant type (this is where the oauth magic happens)
        $server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));
        return $server;
    }
}
