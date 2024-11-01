<?php
namespace Datachin\XdcDatachainGateway\rest;

use Datachin\XdcDatachainGateway\services\XdcService;
use Hathoriel\Utils\Service;
use Datachin\XdcDatachainGateway\base\UtilsProvider;
use WP_REST_Response;

// @codeCoverageIgnoreStart
defined('ABSPATH') or die('No script kiddies please!'); // Avoid direct file request
// @codeCoverageIgnoreEnd

/**
 * Create an example REST Service.
 *
 * @codeCoverageIgnore Example implementations gets deleted the most time after plugin creation!
 */
class XdcDatachainApi {
    use UtilsProvider;

    /**
     * C'tor.
     */
    private function __construct() {
        // Silence is golden.
    }

    /**
     * Register endpoints.
     */
    public function rest_api_init() {
        $namespace = Service::getNamespace($this);
        register_rest_route($namespace, '/rate', [
            'methods' => 'GET',
            'callback' => [$this, 'getRate'],
            'permission_callback' => '__return_true'
        ]);

        register_rest_route($namespace, '/receive-address', [
            'methods' => 'GET',
            'callback' => [$this, 'getReceiveAddress'],
            'permission_callback' => '__return_true'
        ]);
    }

    /**
     * See API docs.
     *
     * @api {get} /xdc-datachain-gateway/v1/hello Say hello
     * @apiHeader {string} X-WP-Nonce
     * @apiName SayHello
     * @apiGroup HelloWorld
     *
     * @apiSuccessExample {json} Success-Response:
     * {
     *     "hello": "world"
     * }
     * @apiVersion 0.1.0
     */
    public function getRate() {
        return new WP_REST_Response(XdcService::getAndUpdateUserRate());
    }

    public function getReceiveAddress() {
        return new WP_REST_Response(XdcService::getReceiverAddress());
    }

    /**
     * New instance.
     */
    public static function instance() {
        return new XdcDatachainApi();
    }
}
