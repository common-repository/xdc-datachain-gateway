<?php

namespace Hathoriel\NftMaker\Services;

use Hathoriel\NftMaker\Connectors\DbConnector;

class AuctionService
{
    const FAVORITES_KEY = 'odyssea_auction_favorites_sum';

    private $dbConnector;

    public function __construct() {
        $this->dbConnector = new DbConnector();
    }

    public function getHistoryByProductId($id) {
        $history = $this->dbConnector->getAuctionHistoryByProductId($id);
        foreach ($history as $row) {
            $row->username= get_userdata($row->userid)->data->display_name;
        }
        return $history;
    }

    public static function addViews($productId) {
        $key = 'odyssea_auction_views_count';
        $count = get_post_meta($productId, $key, true);
        if ($count === false) {
            delete_post_meta($productId, $key);
            add_post_meta($productId, $key, '1');
        } else {
            $count++;
            update_post_meta($productId, $key, $count);
        }
        if (!empty($count)) {
            return $count + 1;
        }
        return 0;
    }

    public static function addFavorites($productId, $userId) {
        $favorites = get_post_meta($productId, self::FAVORITES_KEY);
        $fav = $favorites[0];
        if(!isset($fav[$userId])) {
            $fav[$userId] = $userId;
        } else {
            unset($fav[$userId]);
        }
        update_post_meta($productId, self::FAVORITES_KEY, $fav);
        return count($fav);
    }

    public static function getFavorites($productId) {
        $favorites = get_post_meta($productId, self::FAVORITES_KEY);
        if (!isset($favorites[0])) {
            return 0;
        }
        return count($favorites[0]);
    }

    public static function getStoreInfo($productId) {
        $vendor_id = get_post_field( 'post_author', $productId );
        $store_info = dokan_get_store_info( $vendor_id );
        return ['name' => $store_info['store_name'], 'url' => dokan_get_store_url($vendor_id)];
    }
}