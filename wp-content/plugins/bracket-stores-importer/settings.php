<?php
/*
    Plugin Name: Stores Importer
    Plugin URI:
    Description: 
    Author: Nicolas
    Version: 1.0
    */

namespace RetailPartners;
use Exception;

defined('ABSPATH') || die();

if (!class_exists('StoresImporter')) {
    class StoresImporter
    {
        protected static $instance = null;
        private function __clone()
        {
        }
        private function __sleep()
        {
        }
        private function __wakeup()
        {
        }
        var $importer_option;

        protected function __construct()
        {
            add_action('admin_menu',                    array($this, 'importer_admin_option'));
            add_action('admin_enqueue_scripts',         array($this, 'script_enqueuer'));
        
            add_action('wp_ajax_import_stores',         array($this,'import_stores'));
        }

        public static function init()
        {
            if (!isset(static::$instance))
                static::$instance = new static;

            return static::$instance;
        }

        public function script_enqueuer()
        {
            $scheme     =   is_ssl() ? 'https' : 'http';
            $params     =    array(
                'ajax_url'      =>  admin_url('admin-ajax.php', $scheme),
                'nonce'         =>  wp_create_nonce('cache-nonce')
            );
            wp_register_script('stores-importer', plugin_dir_url(__FILE__) . 'assets/importer.js', array('jquery'));
            wp_localize_script('stores-importer', 'CACHE', $params);
            wp_enqueue_script('stores-importer');
        }

        public function importer_admin_option()
        {
            add_submenu_page('edit.php?post_type=wpsl_stores', 'Stores Importer', 'Stores Importer', 'manage_options', 'stores_importer', array($this, 'plugin_page'));
        }

        public function plugin_page()
        { ?>
            <div class='stores-importer'>
                <h2>STORES IMPORTER</h2>
                <button id='importer-button'>Import</button>
                <div class='importer-results'></div>
            </div>
        <?php
        }
        
        public function import_stores()
        {
            if( !wp_verify_nonce( $_POST['nonce'], 'cache-nonce' ) ):
                echo 'Invalid nonce';
                exit;
            endif;

            if (($fp = fopen(dirname(__FILE__) . "/wpsl_stores.csv", "r")) !== FALSE) {

                $html   = '';
                ob_start();

                echo '<p> READING CSV...</p>';
                $post_type          = 'wpsl_stores';
                $last_post_title    = '';
                $last_post_status   = '';
                $valid_meta_keys    = array('wpsl_address', 'wpsl_city', 'wpsl_state', 'wpsl_country', 'wpsl_country_ISO', 'wpsl_zip', 'wpsl_lat', 'wpsl_lng', 'wpsl_hours');
                $meta_data          = array();
                $new_stores         = array();
                $errors             = false;

                while (($data = fgetcsv($fp)) !== FALSE) {
                    

                    if ($data == ['post_title', 'post_status', 'post_type', 'meta_key', 'meta_value']) {
                        continue;
                    } elseif (sizeof($data) == 5) {
                        $post_title = $data[0];
                        $post_status = $data[1];

                        if ($post_title == $last_post_title) {
                            $meta_key       = $data[3]; //isset($data[3]) && in_array($data[3],$stores_meta) ? $data[3]:'';
                            $meta_value     = $data[4];
                            echo '<p>META KEY => ' . $meta_key . '</p>';
                            echo '<p>META VALUE =>' . $meta_value . '</p>';
                            if (!empty($meta_key) && in_array($meta_key, $valid_meta_keys) && !empty($meta_value))
                                $meta_data[strval($meta_key)] = $meta_value;
                            /*echo '<pre>';
                            var_dump($meta_data);
                            echo '</pre>';*/
                        } else {
                            if (empty($last_post_title)) {
                                $last_post_title = $post_title;
                                $last_post_status = $post_status;
                            } else {
                                try {
                                    global $wpdb;
                                    $query = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = %s AND post_status = %s
                                                                            AND post_title = %s", $post_type, $last_post_status, $last_post_title));

                                    if ($query === 0 || empty($query)) {
                                        echo 'INSIDE INSERT POST';
                                        $new_post = wp_insert_post(array(
                                            'post_title'    => $last_post_title,
                                            'post_type'     => $post_type,
                                            'post_status'   => $last_post_status,
                                            'meta_input'    => $meta_data
                                        ));
                                        array_push($new_stores, $new_post);
                                        //echo '<p> new post ID =>'. $new_p.'</p>';*/
                                    }
                                    $last_post_title    = $post_title;
                                    $last_post_status   = $post_status;
                                    $meta_data          = array();
                                } catch (Exception $e) {
                                    $errors = true;
                                    echo $e->getMessage();
                                }
                            }
                        }
                    }
                }
                fclose($fp);

                $html   = ob_get_clean();
                $msg    = $errors ? 'Importer was executed but errors was occurred' : 'Successful executed!';
                if ( $errors ) 
                    $new_stores = 'No one new store was created';
                $result = array('status' => 'ok', 'msg' => $msg, 'new_stores' => $new_stores);
            }else{
                $result = array('status' => 'err', 'msg' => 'Error! CSV not found');
            }

            wp_reset_postdata();
            wp_send_json($result);

            exit;
        }
    }
}


StoresImporter::init();


?>