<?php

namespace App\Controllers;

/**
 * Class UserController
 *
 * @package Zphalcon\Api\Controllers
 */
class TestsController extends ControllerBase
{


    /**
     * indexAction function.
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {
        echo "This is method get";
    }
    public function token()
    {
        $this->oauth->server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
    }
    public function getToken()
    {
        $response = new \Phalcon\Http\Response();
        $response->setStatusCode(405);
        print_r($response->getStatusCode());
    }

    public function authorize()
    {
        $request  = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();
        $server   = $this->oauth;

        // validate the authorize request
        if (!$server->validateAuthorizeRequest($request, $response)) {
            $response->send();
                    d(var_dump($is_authorized));

            //die;
        }
        // display an authorization form
        if (!$this->request->isPost()) {
          exit('
        <form method="post">
          <label>Do You Authorize TestClient?</label><br />
          <input type="submit" name="authorized" value="yes">
          <input type="submit" name="authorized" value="no">
        </form>');
        }

        // print the authorization code if the user has authorized your client
        $is_authorized = ($_POST['authorized'] == 'yes');

        $server->handleAuthorizeRequest($request, $response, $is_authorized);
        if ($is_authorized) {
          // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
          $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
          exit("SUCCESS! Authorization Code: $code");
        }
        $response->send();
    }
}
