<?php
namespace App\Auth;

use Phalcon\Mvc\User\Component;
use OAuth2\Server as OAuth2Server;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\GrantType\AuthorizationCode;
use OAuth2\GrantType\UserCredentials;

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

    /**
     * OAuth constructor.
     */
    public function __construct()
    {
        $this->server = $this->bootstrap();
    }

    /**
     * @return OAuth2Server
     */
    protected function bootstrap()
    {
        $db = $this->db;
        $config = ['user_table' => 'users'];
        $storage = new StoragePdo($db->getInternalHandler(), $config);

        // Pass a storage object or array of storage objects to the OAuth2 server class
        $server = new OAuth2Server($storage);

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $server->addGrantType(new ClientCredentials($storage));

        // Add the "Authorization Code" grant type (this is where the oauth magic happens)
        $server->addGrantType(new AuthorizationCode($storage));

        // add the grant type to your OAuth server
        $server->addGrantType(new UserCredentials($storage));

        return $server;
    }
}
