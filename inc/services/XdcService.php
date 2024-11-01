<?php

namespace Datachin\XdcDatachainGateway\services;

use Datachin\XdcDatachainGateway\utils\Constants;

class XdcService
{

    public static function getRate() {
        $rate = get_option(Constants::PLUGIN_PREFIX . '-rate');
        if ($rate === false || $rate['time'] + 120 < time()) {
            $currency = strtolower(get_woocommerce_currency());
            $response = wp_remote_get("https://api.coingecko.com/api/v3/simple/price?ids=". Constants::COIN_GECKO_DATACHAIN_ID ."&vs_currencies=$currency");
            $server_output = json_decode(wp_remote_retrieve_body($response), true);
            $rate = $server_output[Constants::COIN_GECKO_DATACHAIN_ID][$currency];
            update_option(Constants::PLUGIN_PREFIX . '-rate', ['value' => $rate, 'time' => time()]);
            return $rate;
        }
        return $rate['value'];
    }

    public static function getAndUpdateUserRate() {
        $rate = XdcService::getRate();
        update_user_meta(get_current_user_id(), Constants::PLUGIN_PREFIX . '-order-rate', $rate);
        return ['rate' => $rate];
    }

    public static function getReceiverAddress() {
        $settings = get_option('woocommerce_'.Constants::PLUGIN_ID   . '_settings');
        return ['receiveAddress' => $settings['receive_address']];
    }
}