<?php
/**
 * Plugin Name: WP REST Filter
 * Description: This plugin helps to fetch customers/orders/products via API using date filter.
 * Author: Biplab Rout
 * Version: 1.0.2
 **/
add_action( 'rest_api_init', 'wp_rest_filter_add_filters' );
function wp_rest_filter_add_filters() {
    /*
     * Rest Customer API
     */
    //../wp-json/wc/v1/customers?created_after=2018-04-20T10:42:35
  add_filter( 'woocommerce_rest_customer_query', function( $args, $request ) {
	    if( isset( $request['created_after'] ) && ! isset( $request['after'] ) ) {
	        $args['date_query'][0]['after'] = $request['created_after'];
	        $args['date_query'][0]['column'] = 'user_registered';
	    }
      if( isset( $request['last_update_after'] )) {
          $args['date_query'][0]['after'] = $request['last_update_after'];
      }
	    return $args;
	}, 10, 2 );

  //../wp-json/wc/v1/customers?last_update_after=2018-05-24T10:42:35
    add_filter( 'user_search_columns', function( $meta_query_args, $request ) {
        if( isset( $request['last_update_after'] )) {
            $dateTime = new DateTime($request['last_update_after']);
            $compareValue=">";
            $meta_query_args = array(
                'relation' => 'AND',
                array(
                    'key'     => 'last_update',
                    'value'   => $dateTime->format('U'),
                    'compare' => ''.$compareValue.''
                )
            );
            $this->meta_query = new WP_Meta_Query();
            $this->meta_query->queries=$meta_query_args;

        }
        return $meta_query_args;
    }, 10, 2 );
  
  /*
   * Rest product API.v1
   */  
   //../wp-json/wc/v1/products?modified_after=2018-04-20T10:42:35
   //../wp-json/wc/v1/products?modified_before=2018-03-31T09:33:44
   add_filter( 'woocommerce_rest_product_query', function( $args, $request ) {
       if( isset( $request['modified_after'] )) {
              $args['date_query'][0]['after'] = $request['modified_after'];
              $args['date_query'][0]['column'] = 'post_modified_gmt';
          }
       if( isset( $request['modified_before'] )) {
              $args['date_query'][0]['before'] = $request['modified_before'];
              $args['date_query'][0]['column'] = 'post_modified_gmt';
          }
          return $args;
      }, 10, 2 );

    /*
    * Rest product API.v2
    */
    //../wp-json/wc/v2/products?modified_after=2018-04-20T10:42:35
    //../wp-json/wc/v2/products?modified_before=2018-03-31T09:33:44
    add_filter( 'woocommerce_rest_product_object_query', function( $args, $request ) {
        if( isset( $request['modified_after'] )) {
            $args['date_query'][0]['after'] = $request['modified_after'];
            $args['date_query'][0]['column'] = 'post_modified_gmt';
        }
        if( isset( $request['modified_before'] )) {
            $args['date_query'][0]['before'] = $request['modified_before'];
            $args['date_query'][0]['column'] = 'post_modified_gmt';
        }
        return $args;
    }, 10, 2 );
   
   /*
    * Rest order API.v1
    */   
   //../wp-json/wc/v1/orders?modified_after=2018-04-20T10:42:35
   //../wp-json/wc/v1/orders?modified_before=2018-03-31T09:33:44
   add_filter( 'woocommerce_rest_shop_order_query', function( $args, $request ) {
       if( isset( $request['modified_after'] )) {
               $args['date_query'][0]['after'] = $request['modified_after'];
               $args['date_query'][0]['column'] = 'post_modified_gmt';
           }
           if( isset( $request['modified_before'] )) {
               $args['date_query'][0]['before'] = $request['modified_before'];
               $args['date_query'][0]['column'] = 'post_modified_gmt';
           }
           return $args;
       }, 10, 2 );

    /*
     * Rest order API.v2
     */
    //../wp-json/wc/v2/orders?modified_after=2018-04-20T10:42:35
    //../wp-json/wc/v2/orders?modified_before=2018-03-31T09:33:44
    add_filter( 'woocommerce_rest_shop_order_object_query', function( $args, $request ) {
        if( isset( $request['modified_after'] )) {
            $args['date_query'][0]['after'] = $request['modified_after'];
            $args['date_query'][0]['column'] = 'post_modified_gmt';
        }
        if( isset( $request['modified_before'] )) {
            $args['date_query'][0]['before'] = $request['modified_before'];
            $args['date_query'][0]['column'] = 'post_modified_gmt';
        }
        return $args;
    }, 10, 2 );
	
}


