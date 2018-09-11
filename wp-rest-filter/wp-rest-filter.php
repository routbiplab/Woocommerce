<?php
/**
 * Plugin Name: WP REST Filter
 * Description: This plugin helps to fetch customers/orders/products via API using date filter.
 * Author: Biplab Rout
 * Version: 1.0.3
 **/
add_action( 'rest_api_init', 'wp_rest_filter_add_filters' );
function wp_rest_filter_add_filters() {
    /*
     * Rest Customer API v1 and v2
     */
    //../wp-json/wc/v1/customers?created_after=2018-04-20T10:42:35
  add_filter( 'woocommerce_rest_customer_query', function( $args, $request ) {
	    if( isset( $request['created_after'] ) && ! isset( $request['after'] ) ) {
	        $args['date_query'][0]['after'] = $request['created_after'];
	        $args['date_query'][0]['column'] = 'user_registered';
	    }
      //..//wp-json/wc/v2/customers?filter[meta_key]=last_update&filter[meta_value]=2018-09-10T06:43:07&last_update=eq
      if( $request['filter']['meta_key']=='last_update' ) {
          $filter = $request['filter'];
          global $wp;
          $vars = apply_filters( 'rest_query_vars', $wp->public_query_vars );
          function allow_meta_query( $valid_vars )
          {
              $valid_vars = array_merge( $valid_vars, array( 'meta_query', 'meta_key', 'meta_value', 'meta_compare' ) );
              return $valid_vars;
          }
          $vars = allow_meta_query( $vars );
          foreach ( $vars as $var ) {
              if ( isset( $filter[ $var ] ) ) {
                  $args[ $var ] = $filter[ $var ];
              }
          }
          $dateTime = new DateTime($args[ 'meta_value' ]);
          $args[ 'meta_value' ] = $dateTime->format('U');
          if (isset($request['last_update']) && ($request['last_update'] == 'after'))
              $args[ 'meta_compare' ] = '>';
          elseif (isset($request['last_update']) && ($request['last_update'] == 'before'))
              $args[ 'meta_compare' ] = '<';
          elseif (isset($request['last_update']) && ($request['last_update'] == 'eq'))
              $args[ 'meta_compare' ] = '=';
      }

	    return $args;
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


