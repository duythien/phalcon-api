<?php
namespace App\Auth;

use OAuth2\Storage\Pdo;

/**
 * Class StoragePdo
 * The overwrite some method of class
 *
 * @package FoxOMS\Auth
 */
class StoragePdo extends Pdo
{
    /**
     * @param $username
     * @return array|bool
     */
    public function getUser($username)
    {
        $stmt = $this->db->prepare($sql = sprintf('SELECT * from %s where username=:username', $this->config['user_table']));
        $stmt->execute(array('username' => $username));

        if (!$userInfo = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return false;
        }
        // the default behavior is to use "username" as the user_id but I did replace it to Id
        return array_merge(array(
            'user_id' => $userInfo['id']
        ), $userInfo);
    }

    /* OAuth2\Storage\UserCredentialsInterface */
    public function checkUserCredentials($username, $password)
    {
        if ($user = $this->getUser($username)) {
            return $this->checkPassword($user, $password);
        }

        return false;
    }
    // plaintext passwords are bad!  Override this for your application
    protected function checkPassword($user, $password)
    {
        return $user['password'] == sha1($password);//Maybe you need change phalcon security check hash
    }

}
