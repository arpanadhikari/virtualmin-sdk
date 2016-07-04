<?php
namespace Snscripts\Virtualmin;

use GuzzleHttp\ClientInterface;

class Virtualmin extends Object
{
    /**
     * set up Virtualmin Config
     *
     * @param Object $http Guzzle Package
     */
    public function __construct(ClientInterface $http)
    {
        $this->http = $http;
    }

    /**
     *
     * @param string $host The host to connect to
     * @param string $user The main account username
     * @param string $pass The main account password
     * @param bool $secure Use a secure connection?
     */
    public function setConnection($host, $user, $pass, $secure = true)
    {
        $this->setHost($host, $secure);

        $this->data['user'] = $user;
        $this->data['pass'] = $pass;
    }

    /**
     * setter for host variable
     *
     * @param string $host The virtualmin host
     * @param bool $secure Use a secure connection?
     */
    public function setHost($host, $secure)
    {
        if (strpos($host, '://') !== false) {
            $hostBits = explode('://', $host, 2);

            $host = $hostBits[1];
        }

        $this->data['host'] = (isset($secure) && $secure ? 'https://' : 'http://') . $host;
    }
}