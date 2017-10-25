<?php

/*
* Main Ajax Functionality File.
*/

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

//Import Bootrstrap Class.
use Shogo\SBV\Classes\Bootstrap;

//Import Actions Class.
use Shogo\SBV\Classes\Actions;

//Initiate Bootstrap Class.
$bootstrap = new Bootstrap();

//Plugin's Main Ajax Method.
function SBV_ajax() {

  //Global Bootstrap.
  global $bootstrap;

  //Ajax Operation.
  $operation = $_POST['operation'];

  //The Switch Method.
  switch ( $operation ) {
    case 'check_status':

      //Plugin's Option.
      $options = $bootstrap->get_ops();

      //Encode to JSON.
      $options = json_decode( $options, true );

      /*
      * Block all options switch to enable or disable.
      * Accept vals 1 and 0.
      * If val is 1 means enabled, 0 means disabled.
      */
      $block_all_enabled = $options['sbv_options']['ban_all']['enabled'];

      /*
      * Block specific options switch to enable or disable.
      * Accept vals 1 and 0.
      * If val is 1 means enabled, 0 means disabled.
      */
      $block_specific_enabled = $options['sbv_options']['ban_some']['enabled'];

      /*
      * SEO Bots Unblock switch to enable or disable.
      * Accept vals 1 and 0.
      * If val is 1 means enabled, 0 means disabled.
      */
      $seo_bots_enabled = $options['sbv_options']['bots'];


      //echo out as Ajax Response.
      echo $block_all_enabled . '||' . $block_specific_enabled . '||' . $seo_bots_enabled;
    break;

    //Enable or disable specific block option or block all option.
    case 'enable_block':

      //Value from post request. value must be 1 or 0.
      //1 is enabled, 0 is disabled.
      $type = $_POST['type'];

      //Post Request if checkbox is checked or not. value should be 1 or 0.
      //1 is checked, 0 is checked.
      $checked = $_POST['checked'];

      //Plugin's Options.
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      /*
      * The 2 types of options for this plugin. 'specific'( Block specific countries and IP address ) and 'all' ( Block all
      * countries and IP Address with exceptions). Values should be 0 and 1. 1 is enabled and 0 is disable.
      * Do not set all options to 1 to avoid errors.
      */
      if ( $type == 'specific' ) {

        //If Specific Block is checked.
        if ( $checked == 1 ) {

          //Enable Specific Block Option.
          $options['sbv_options']['ban_some']['enabled'] = 1;
        } else {

          //Disable Specific Option.
          $options['sbv_options']['ban_some']['enabled'] = 0;
        }

        //Disable Block all Option.
        $options['sbv_options']['ban_all']['enabled'] = 0;

        //The Block All Option.
      } else if ( $type == 'all' ) {

        //If Block all Option is checked.
        if ( $checked == 1 ) {

          //Enable Block All Option.
          $options['sbv_options']['ban_all']['enabled'] = 1;
        } else {

          //Disable Block All Option.
          $options['sbv_options']['ban_all']['enabled'] = 0;
        }

        //Disable Specific Block Option.
        $options['sbv_options']['ban_some']['enabled'] = 0;
      }

      //Encode to JSON.
      $new_option = json_encode( $options );

      //Update Plugin's Option.
      $bootstrap->update_ops( $new_option );
    break;

      //Enable Unblock SEO Bots.
      case 'enable_bots':

      //Post Request if checkbox is checked or not. value should be 1 or 0.
      //1 is checked, 0 is checked.
      $checked = $_POST['checked'];

      //Plugin's Options.
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //Update SEO Bots option.
      $options['sbv_options']['bots'] = $checked;

      //Encode to JSON.
      $new_options = json_encode( $options );

      //Update Plugin's Option.
      $bootstrap->update_ops( $new_options );
    break;

    //List of Countries Respons. (unorder list)
    case 'specific_list_countries_ul':
      ob_start();
      include_once( SBV . '/includes/ajax-contents/list-countries.php' );
      echo ob_get_clean();
    break;

    //Add Block Country.
    case 'add_block_country':

      //Country value via POST Request.
      $country = $_POST['country'];

      //Country code value via POST Request.
      $country_code = $_POST['country_code'];

      //Plugin's Options.
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //If $country and $country_code not NULL or empty.
      if ( $country && $country_code ) {

        //If Specific Block Country List is empty.
        if ( empty( $options['sbv_options']['ban_some']['banned']['country'] ) ) {

          //Create first country's array value.
          $options['sbv_options']['ban_some']['banned']['country'][] = [$country_code => $country];
        } else {

          //If Country list not empty and check if country is already in the list.
          if ( ! $bootstrap->specific_country_exists( $country_code ) ) {

            //Country array list.
            $arr1 = $options['sbv_options']['ban_some']['banned']['country'];

            //Country to be added.
            $arr2[] = [$country_code => $country];

            //Merge the 2 arrays.
            $merge = array_merge_recursive( $arr1 , $arr2 );

            //Update country list.
            $options['sbv_options']['ban_some']['banned']['country'] = $merge;
          }
        }

        //Encode to JSON.
        $new_options = json_encode( $options );

        //Update Plugin's Option.
        $bootstrap->update_ops( $new_options );
      }
    break;

    //List of Specific Blocked Countries.
    case 'specific_list_countries_current':
      ob_start();
      include_once( SBV . '/includes/ajax-contents/specific_list_countries_current.php' );
      echo ob_get_clean();
    break;

    //Remove County from Block List.
    case 'remove_block_country':

      //County's Position.
      $pos = $_POST['pos'];

      //Plugin's Option.
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //Check if $pos is not NULL.
      if ( $pos !== '' ) {

        //Unset the country's position number to remove a country from the block list.
        unset( $options['sbv_options']['ban_some']['banned']['country'][$pos] );

        //Reorder List.
        $new_list = $bootstrap->reorder( $options['sbv_options']['ban_some']['banned']['country'] );

        //Replace old list.
        $options['sbv_options']['ban_some']['banned']['country'] = $new_list;
      }

      //Encode to JSON.
      $new_options = json_encode( $options );

      //Update Plugin's Option.
      $bootstrap->update_ops( $new_options );
    break;

    //Add IP Address to Block List.
    case 'add_specific_ip_address':

      //The Value of IP Address from POST Request.
      $ip = $_POST['ip'];

      //Plugin's Option.
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //Check if IP addres is already on the block list.
      if ( ! $bootstrap->specific_ip_exists( $ip ) ) {

        //If Block IP Address List is empty.
        if ( empty( $options['sbv_options']['ban_some']['banned']['ip'] ) ) {

          //Create first array value.
          $options['sbv_options']['ban_some']['banned']['ip'] = [$ip];
        } else {

          //List of Blocked IP Address.
          $arr1 = $options['sbv_options']['ban_some']['banned']['ip'];

          //IP Address to be added.
          $arr2 = [$ip];

          //Merge the 2 arrays.
          $merge = array_merge( $arr1, $arr2 );

          //Update IP Blocked List.
          $options['sbv_options']['ban_some']['banned']['ip'] = $merge;
        }

        //Encode to JSON.
        $new_options = json_encode( $options );

        //Update Plugin's Options.
        $bootstrap->update_ops( $new_options );
      }
    break;

    //List of Blocked IP Address.
    case 'specific_block_ip_list':
      ob_start();
      include_once( SBV . '/includes/ajax-contents/specific_list_ip.php' );
      echo ob_get_clean();
    break;

    //Delete Specific IP Address.
    case 'delete_specific_ip_current':

      //Position of IP Address.
      $pos = $_POST['pos'];

      //Plugin's Options.empty( $options['sbv_options']['ban_all']['excemption']['ip']
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //Uset IP Address position as deleted.
      unset( $options['sbv_options']['ban_some']['banned']['ip'][$pos] );

      //Reoder List.
      $new_list = $bootstrap->reorder( $options['sbv_options']['ban_some']['banned']['ip'] );

      //Replace old list.
      $options['sbv_options']['ban_some']['banned']['ip'] = $new_list;

      //Encode to JSON.
      $new_options = json_encode( $options );

      //Update Plugin's Options.
      $bootstrap->update_ops( $new_options );
    break;

    //Add Excempt Country.
    case 'add_excempt_country':

      //Value of $country from POST Request.
      $country = $_POST['country'];

      //Value of $country_code from POST Reqeust.
      $country_code = $_POST['country_code'];

      //Plugin's Options.
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //Check if $country and $country_code are not NULL.
      if ( $country && $country_code ) {
        //Check if country is already in excemption list.
        if ( ! $bootstrap->block_all_country_exists( $country_code ) ) {

          //Check if excemption list is empty.
          if ( empty( $options['sbv_options']['ban_some']['ban_all']['exception']['country'] ) ) {

            //Create first array value.
            $options['sbv_options']['ban_all']['exception']['country'][] = [$country_code => $country];
          } else {

            //List of Country Exception.
            $arr1 = $options['sbv_options']['ban_all']['exception']['country'];

            //Country will be added.
            $arr2[] = [$country_code => $country];

            //Merge 2 arrays.
            $merge = array_merge_recursive( $arr1, $arr2 );

            //Update Country Exception List.
            $options['sbv_options']['ban_all']['exception']['country'][] = $merge;
          }

          //Encode to JSON.
          $new_options = json_encode( $options );

          //Update Plugin's Options.
          $bootstrap->update_ops( $new_options );
        }
      }
    break;

    //List of Excemtion Country List.
    case 'excemption_country_list_current':
      ob_start();
      include_once( SBV . '/includes/ajax-contents/excemption_country_list_current.php' );
      echo ob_get_clean();
    break;

    //Delete Excempted Country.
    case 'remove_excempted_country':

      //Position number via POST Request.
      $pos = $_POST['pos'];

      //Plugin's Options.
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //If $pos is not NULL.
      if ( $pos !== '' ) {

        //Unset the country's position.
        unset( $options['sbv_options']['ban_all']['exception']['country'][$pos] );

        //Reorder List.
        $new_list = $bootstrap->reorder( $options['sbv_options']['ban_all']['exception']['country'] );

        //Replace old list.
        $options['sbv_options']['ban_all']['exception']['country'] = $new_list;
      }

      //Encode to JSON.
      $new_options = json_encode( $options );

      //Update Plugin's Options.
      $bootstrap->update_ops( $new_options );
    break;

    //Add Excempted IP Address.
    case 'add_excempt_ip':

      //IP Address Value from POST Reqeust.
      $ip = $_POST['ip'];

      //Plugin's Options.
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //Check if IP Address is already in the excemption list.
      if ( ! $bootstrap->excemption_ip_exists( $ip ) ) {

        //Check if IP Excemption list is empty.
        if ( empty( $options['sbv_options']['ban_all']['exception']['ip'] ) ) {

          //Create first value.
          $options['sbv_options']['ban_all']['exception']['ip'] = [$ip];
        } else {

          //List of Excemption IP List.
          $arr1 = $options['sbv_options']['ban_all']['exception']['ip'];

          //IP will be added.
          $arr2 = [$ip];

          //Merge 2 arrays.
          $merge = array_merge( $arr1, $arr2 );

          //Update IP Excemption List.
          $options['sbv_options']['ban_all']['exception']['ip'] = $merge;
        }

        //Encode to JSON.
        $new_options = json_encode( $options );

        //Update Plugin's Options.
        $bootstrap->update_ops( $new_options );
      }
    break;

    //IP Address Excemption List Current.
    case 'ip_address_excemption_list':
      ob_start();
      include_once( SBV . '/includes/ajax-contents/excemption_ip_address_list_current.php' );
      echo ob_get_clean();
    break;

    //Remove Excempted IP Address.
    case 'remove_excempted_ip_address':

      //Position value from POST Request.
      $pos = $_POST['pos'];

      //Plugin's Options.
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //Unset position as delete.
      unset( $options['sbv_options']['ban_all']['exception']['ip'][$pos] );

      //Reorder List.
      $new_list = $bootstrap->reorder( $options['sbv_options']['ban_all']['exception']['ip'] );

      //Replace old list.
      $options['sbv_options']['ban_all']['exception']['ip'] = $new_list;

      //Encode to JSON.
      $new_options = json_encode( $options );

      //Update Plugin's Options.
      $bootstrap->update_ops( $new_options );
    break;

    //List of Wordpres Pages.
    case 'list_of_pages':
      ob_start();
      include_once( SBV . '/includes/ajax-contents/list_of_pages.php' );
      echo ob_get_clean();
    break;

    //Add Selected Page.
    case 'select_page':

      //Value of page from POST Request.
      $page = $_POST['page'];

      //Seperate Post Name and Post Title. Seperator is ||.
      $page = explode( '||', $page );

      //Plugin's Options
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //Set Page.
      $options['sbv_options']['page_redirect'] = [$page[0] => $page[1]];

      //Encode to JSON.
      $new_options = json_encode( $options );

      //Update Plugin's Options.
      $bootstrap->update_ops( $new_options );
    break;

    //Current Redirect Page Selected.
    case 'current_page_selected':

      //Seperate Post Name and Post Title. Seperator is ||.
      $page = explode( '||', $page );

      //Plugin's Options
      $options = $bootstrap->get_ops();

      //Decode JSON to PHP Array.
      $options = json_decode( $options, true );

      //Current Page Redirect.
      $redirect_page = $options['sbv_options']['page_redirect'];

      if ( empty( $redirect_page ) ) {
        echo '
        <span style="color: red;">Blocked Page Redirect is not set. Set now or plugin would not work proplerly.<br />
        Page should have no parent.
        </span>';
      } else {
        foreach ( $redirect_page as $page ) {
          echo '<span style="color: green;">Page Redirect is set to: ' . $page . '</span>';
        }
      }
    break;

    //Get user's info from http://ipinfo.io.
    case 'get_user_info':

      //IP Value from ipinfo response.
      $ip = $_POST['data']['ip'];

      //Country code Value from ipinfo.
      $country = $_POST['data']['country'];

      //Store User's info to session.
      $bootstrap->put_to_session( $ip, $country );
    break;

    //Country List in Dropdown.
    case 'country_list_dropdown':
      ob_start();
      include_once( SBV . '/includes/ajax-contents/list-countries-select.php' );
      echo ob_get_clean();
    break;

    case 'clear_stats':

      //Execute Clear Stats.
      $bootstrap->clear_stats();
    break;
  }

  wp_die();
}
