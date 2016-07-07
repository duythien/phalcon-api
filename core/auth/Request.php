<?php
namespace App\Auth;

use OAuth2\Request as OAuthRequest;

/**
 * Class StoragePdo
 * The overwrite some method of class
 *
 * @package FoxOMS\Auth
 */
class Request extends OAuthRequest
{
    public static function createFromGlobals()
    {
        $class = get_called_class();
        $request = new $class($_GET, $_POST, array(), $_COOKIE, $_FILES, $_SERVER);

        $contentType = $request->server('CONTENT_TYPE', '');
        $requestMethod = $request->server('REQUEST_METHOD', 'GET');
        if (0 === strpos($contentType, 'application/x-www-form-urlencoded')
            && in_array(strtoupper($requestMethod), array('PUT', 'DELETE'))
        ) {
            parse_str($request->getContent(), $data);
            $request->request = $data;
        } elseif (0 === strpos($contentType, 'application/json')
            && in_array(strtoupper($requestMethod), array('POST', 'DELETE'))
        ) {
            $data = json_decode($request->getContent(), true);
            $request->request = $data;
        }

        return $request;
    }
}
