<?php
    /*
    Plugin Name: Ratail Partners Cache
    Plugin URI:
    Description: 
    Author: Nicolas
    Version: 1.0
    */

    namespace RetailPartners;
        
    defined( 'ABSPATH' ) || die();

    if( !class_exists('Map') )
    {
        class Map
        {
            protected static $instance = null;
            private function __clone(){}
            private function __sleep(){}
            private function __wakeup(){}

            protected function __construct()
            {
                add_action('wp_enqueue_scripts',            array($this,'script_enqueuer'));
                add_action('acf/init',                      array($this,'set_googlemap_api_key'));

            }
                
            public static function init()
            {
                if( !isset(static::$instance) )
                    static::$instance = new static;

                return static::$instance;
            }

            public function script_enqueuer()
            {
                if ( is_page(get_field('map_page','option')) ):

                    $scheme     =   is_ssl() ? 'https':'http';
                    $params 	=	array(
                                        'ajax_url'      =>  admin_url( 'admin-ajax.php', $scheme),
                                        'nonce'         =>  wp_create_nonce( 'cache-nonce' )
                                    );
                                
                    /*wp_register_script('retail-partners', plugin_dir_url(__FILE__) . 'assets/retail_partners.js', array('jquery') );
                    wp_register_script('retail-partners-css', plugin_dir_url(__FILE__) . 'assets/retail_partners.css' );
                    wp_enqueue_style('retail-partners-css');

                    wp_register_script('googlemaps',      '//maps.googleapis.com/maps/api/js?key='.get_field('google_map_api_key','option').'&libraries=places&ver=5.5.3', array('retail-partners'),false,true );

                    wp_localize_script('retail-partners', 'CACHE', $params);
                    wp_enqueue_script( 'retail-partners' );
                    wp_enqueue_script( 'googlemaps' );*/
                
                endif;
           }

            public function set_googlemap_api_key(){
                //set option
                //update_field('google_map_api_key', 'AIzaSyCZMKLPuz3EDmHn87yuIVhjjr_xK6hNOoo', 'option');

                acf_update_setting('google_api_key',get_field('google_map_api_key','option'));
            }
            
        
        
        }

    }


    Map::init();
