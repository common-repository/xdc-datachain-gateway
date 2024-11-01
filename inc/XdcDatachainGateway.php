<?php

use Datachin\XdcDatachainGateway\utils\Constants;

add_action('plugins_loaded', 'initializeXdcGateway');
function initializeXdcGateway() {
    class WC_Xdc_Gateway extends WC_Payment_Gateway
    {

        /*
        * Class constructor
        */
        public function __construct() {
            $this->id = Constants::PLUGIN_ID;
            $this->icon = apply_filters('woocommerce_xdc_gateway_icon', plugins_url('/gatewayIcon.png', __FILE__));
            $this->has_fields = true;
            $this->method_title = 'Datachain Payment Gateway';
            $this->method_description = 'Datachain Payment Gateway Pay is the payment gateway for receiving payments via digital XDC token Payment Gateway';
            $this->receive_address = 'Submit your receive address';
            $this->init_form_fields();
            $this->init_settings();
            $this->receive_address = $this->get_option('receive_address');

            // This action hook saves the settings
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
            add_action('woocommerce_api_' . strtolower(get_class($this)), array($this, 'callback_handler'));
            // We need custom JavaScript to obtain a token
            add_action('wp_enqueue_scripts', array($this, 'payment_scripts'));
        }

        /*
        * Plugin options and setting fields
        */
        public function init_form_fields() {
            $this->form_fields = apply_filters('woo_platon_pay_fields', array(
                'enabled' => array(
                    'title' => 'Enable/Disable',
                    'type' => 'checkbox',
                    'label' => 'Enable XDC Payment Module',
                    'default' => 'no'
                ),
                'receive_address' => array(
                    'title' => 'Receive address (starts with xdc)',
                    'type' => 'text',
                    'default' => 'Replace with your receive address.',
                    'desc_tip' => true,
                    'description' => 'Replace with your receive address.',
                ),
            ));
        }

        /*
        *  Payment gateway form fields
        */
        public function payment_fields() {
            echo '<div
            id="' . Constants::PLUGIN_PREFIX . '"
            data-cart-total="' . WC()->cart->total . '"
            data-receive-address="' . $this->receive_address . '"
            class="' . Constants::PLUGIN_PREFIX . '" style="display: flex; justify-content: center;">          
                <div class="text-center flex justify-center flex-col items-center">
                    <div role="status">
                        <svg
                            class="inline mr-2 w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor"
                            />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill"
                            />
                        </svg>                    
                        </div>
                        <div class="font-mulish">Wait please few seconds...</div>
                </div>              
            </div>';
        }

        /*
        * Custom CSS and JS
        */
        public function payment_scripts() {
        }

        /*
        * Fields validation

        public function validate_fields() {
        }

        /*
        * Process the payments here
        */
        public function process_payment($order_id) {
            global $woocommerce;
            $order = wc_get_order($order_id);

            $txId = sanitize_text_field($_POST[Constants::PLUGIN_PREFIX . "-txId"]);
            if (empty($txId)) {
                wc_add_notice('Please click on payment button and finish payment during checkout.', 'error');
                return;
            }
            $tatum = new \Hathoriel\NftMaker\Connectors\TatumConnector(true);
            $tx = $tatum->getTransaction('XDC', $txId);
            if (empty($tx['hash'])) {
                if (empty($txId)) {
                    wc_add_notice("Cannot find transaction $txId in the blockchain. Wait few seconds and click checkout again", 'error');
                    return;
                }
            }

            $db = new Datachin\XdcDatachainGateway\connectors\DbConnector();
            $existingPayments = $db->getXdcDatachainGatewayByTxId($tx['hash']);
            if (count($existingPayments) > 0) {
                wc_add_notice("Transaction $txId was already submitted.", 'error');
                return;
            }

            if (!isset($tx['to']) || str_replace('xdc', '0x', $tx['to']) !== Constants::XDC_CONTRACT) {
                wc_add_notice("Transaction $txId called wrong smart contract instead of " . Constants::XDC_CONTRACT . ".", 'error');
                return;
            }


            if (!isset($tx['logs'][0]['address']) || str_replace('xdc', '0x', $tx['logs'][0]['address']) !== Constants::XDC_CONTRACT) {
                wc_add_notice("Transaction $txId called wrong smart contract instead of " . Constants::XDC_CONTRACT . ".", 'error');
                return;
            }

            if (!isset($tx['logs'][0]['topics'][2]) || $tx['logs'][0]['topics'][2] !== $this->getToTopic()) {
                wc_add_notice("It looks like transaction $txId was sent to different account or with different provider than the XDC Gateway.", 'error');
                return;
            }

            if (!isset($tx['logs'][0]['data'])) {
                wc_add_notice("Transaction $txId dont transfers any value.", 'error');
                return;
            }

            $txValue = hexdec($tx['logs'][0]['data']) / 1000000000000000000;
            $orderRate = get_user_meta(get_current_user_id(), Constants::PLUGIN_PREFIX . '-order-rate', true);

            $txValueFromBlockchain = ceil((float)$order->get_total() / (float)$orderRate);
            if ((float)$txValue !== $txValueFromBlockchain) {
                wc_add_notice("Transaction $txId should transfer exactly $txValue value in DATACHAIN tokens.", 'error');
                return;
            }

            update_post_meta($order_id, Constants::PLUGIN_PREFIX . '-txId', $tx['hash']);
            $db->insertXdcDatachainGateway(['tx_id' => $tx['hash'], 'order_id' => $order_id]);

            // we received the payment
            $order->payment_complete();
            $order->reduce_order_stock();

            // some notes to customer (replace true with false to make it private)
            $order->add_order_note("Hey, your order is paid with tx $txId! Thank you!", true);

            // Empty cart
            $woocommerce->cart->empty_cart();

            // Redirect to the thank you page
            return array(
                'result' => 'success',
                'redirect' => $this->get_return_url($order)
            );
        }

        private function getToTopic() {
            $suffix = $this->get_option('receive_address');
            $splitted = explode("xdc", $suffix);
            return Constants::TO_TOPIC_PREFIX . $splitted[1];
        }
    }
}