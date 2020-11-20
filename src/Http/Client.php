<?php

namespace Jiajiale\LaravelSeafile\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Guzzle wrapper
 *
 * @package   Seafile\Http
 * @author    Rene Schmidt DevOps UG (haftungsbeschränkt) & Co. KG <rene+_seafile_github@sdo.sh>
 * @copyright 2015-2020 Rene Schmidt DevOps UG (haftungsbeschränkt) & Co. KG <rene+_seafile_github@sdo.sh>
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Schmidt-DevOps/seafile-php-sdk
 */
class Client extends \GuzzleHttp\Client
{
    /**
     * Constructor
     *
     * @param array $config Client configuration settings.
     */
    public function __construct(array $config = [])
    {
        $config = array_merge(
            [
                'http_errors' => true,
                'request.options' => [
                    'verify' => true,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Token none',
                    ],
                ],
            ],
            $config
        );

        parent::__construct($config);
    }

    /**
     * @param string|UriInterface $uri URI for request
     * @param array $args Request args
     * @return ResponseInterface
     */
    public function get($uri, array $args = []): ResponseInterface
    {
        return parent::get($uri, $args);
    }

    /**
     * @param string|UriInterface $uri URI for request
     * @param array $args Request args
     * @return ResponseInterface
     */
    public function put($uri, array $args = []): ResponseInterface
    {
        return parent::put($uri, $args);
    }

    /**
     * @param string|UriInterface $uri URI for request
     * @param array $args Request args
     * @return ResponseInterface
     */
    public function delete($uri, array $args = []): ResponseInterface
    {
        return parent::delete($uri, $args);
    }
}