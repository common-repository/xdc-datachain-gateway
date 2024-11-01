<?php
namespace Datachin\XdcDatachainGateway;

use Datachin\XdcDatachainGateway\base\UtilsProvider;
use Hathoriel\Utils\Activator as UtilsActivator;

// @codeCoverageIgnoreStart
defined('ABSPATH') or die('No script kiddies please!'); // Avoid direct file request
// @codeCoverageIgnoreEnd

/**
 * The activator class handles the plugin relevant activation hooks: Uninstall, activation,
 * deactivation and installation. The "installation" means installing needed database tables.
 */
class Activator {
    use UtilsProvider;
    use UtilsActivator;

    /**
     * Method gets fired when the user activates the plugin.
     */
    public function activate() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $datachain_gateway = $this->getTableName('xdc_datachain_gateway');
        $sql = "CREATE TABLE IF NOT EXISTS $datachain_gateway (
            id bigint NOT NULL AUTO_INCREMENT,
            tx_id varchar(256) NOT NULL,
            amount bigint,
            tx_from varchar(256),
            tx_to varchar(256),
            rate bigint,
            fiat varchar(256),
            order_id bigint NOT NULL,
            UNIQUE KEY id (id),
            UNIQUE KEY order_id (id),
            UNIQUE KEY tx_id (id),
            INDEX(order_id),
            INDEX(tx_id)
        ) $charset_collate;";

        $wpdb->query($sql);
    }

    /**
     * Method gets fired when the user deactivates the plugin.
     */
    public function deactivate() {
        // Your implementation...
    }

    /**
     * Install tables, stored procedures or whatever in the database.
     * This method is always called when the version bumps up or for
     * the first initial activation.
     *
     * @param boolean $errorlevel If true throw errors
     */
    public function dbDelta($errorlevel) {

    }
}
