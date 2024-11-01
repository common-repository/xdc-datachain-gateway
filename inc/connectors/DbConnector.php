<?php

namespace Datachin\XdcDatachainGateway\connectors;
use Datachin\XdcDatachainGateway\base\UtilsProvider;

class DbConnector
{
    use UtilsProvider;
    private $xdcDatachainGateway;
    private $wpdb;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->xdcDatachainGateway = $this->getTableName("xdc_datachain_gateway");
    }

    public function insertXdcDatachainGateway($data) {
        $this->wpdb->insert($this->xdcDatachainGateway, $data);
    }

    public function getXdcDatachainGatewayByTxId($txId) {
        return $this->wpdb->get_results("SELECT * FROM $this->xdcDatachainGateway WHERE tx_id = '$txId'");
    }

    public function getAuctionHistoryByProductId($id) {
        return $this->wpdb->get_results("SELECT * FROM $this->auctionHistory WHERE auction_id = '$id'");
    }
}