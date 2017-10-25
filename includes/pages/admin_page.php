<?php

  //Exit if accessed directly.
  if ( ! defined( 'ABSPATH' ) ) {
    exit;
  }
?>

<div class="sbv-admin-container">
  <h1><?php _e( 'Shogo\'s Block Visitor' ) ?></h1>
  <div class="sbv-block-specific-ch">
    <input type="checkbox" class="sbv-enable-specific" /> Block Specific countries or IP Addresses
  </div>
  <div class="sbv-block-all-ch">
    <input type="checkbox" class="sbv-enable-all" /> Block all countries or IP Addresses with exceptions
  </div>
  <div class="sbv-block-specific-container">
    <div class="sbv-block-specific-contents">
      <h3><?php _e( 'Block Countries' ) ?></h3>
      <div class="sbv-block-specific-countries-list">&nbsp;</div>
      <div class="sbv-block-specific-btns-container">
        <input type="button" class="sbv-btn-specific-add" value=">>" />
        <input type="button" class="sbv-btn-specific-remove" value="<<" />
      </div>
      <div class="sbv-block-specific-countries-current"></div>
      <div class="clear"></div>
      <h3><?php _e( 'Block IP Address' ) ?></h3>
      <div class="sbv-block-specific-ip-contents">
        <label><?php _e( 'Add IP Address:' ) ?></label>
        <div class="sbv-block-specific-ip-error"></div>
        <input type="text" class="sbv-block-specific-ip-input" />
        <input type="button" class="sbv-block-specific-ip-add" value="Add" />
        <div class="sbv-block-specific-ip-block-list"></div>
      </div>
    </div>
  </div>
  <div class="sbv-block-all-container">
    <div class="sbv-block-all-contents">
      <h3><?php _e( 'Countries Exception' ); ?></h3>
      <div class="sbv-block-all-country-list"></div>
      <div class="sbv-block-all-btns-container">
        <input type="button" class="sbv-block-all-btn-add" value=">>" />
        <input type="button" class="sbv-block-all-btn-remove" value="<<" />
      </div>
      <div class="sbv-block-all-country-list-current"></div>
      <div class="clear"></div>
      <h3><?php _e( 'IP Adress Exceptions' ); ?></h3>
      <label for="sbv-block-all-ip-input"><?php _e( 'Add IP Address' ) ?></label>
      <div class="sbv-block-all-error"></div>
      <input type="text" class="sbv-block-all-ip-input" />
      <input type="button" class="sbv-block-all-ip-add" value="Add" />
      <div class="sbv-block-all-ip-list-current"></div>
      <div class="sbv-block-all-bots-container">
        <input type="checkbox" class="sbv-block-all-bots-ch" /> Unblock crawler SEO bots to access your website.
      </div>
    </div>
  </div>
  <h1>Set Blocked Page Redirect</h1>
  <div class="sbv-block-page-container">
    <select class="sbv-list-pages"></select>
    <input type="button" class="sbv-list-page-set" value="Set" />
    <div class="sbv-page-selected"></div>
  </div>
</div>

<div class="sbv-admin-container-mobile">
  <h3><?php _e( 'Block Countries' ) ?></h3>
  <div class="sbv-block-specific-ch">
    <input type="checkbox" class="sbv-enable-specific-mobile" /> Block Specific countries or IP Addresses
  </div>
  <div class="sbv-block-all-ch">
    <input type="checkbox" class="sbv-enable-all-mobile" /> Block all countries or IP Addresses with exceptions
  </div>
  <div class="sbv-block-specific-contents-mobile">
    <h3><?php _e( 'Block Countries' ); ?></h3>
    <select class="sbv-block-specific-country-list-mobile"></select><br />
    <input type="button" class="sbv-specific-btn-add-mobile" value="Add" />
    <input type="button" class="sbv-specific-btn-remove-mobile" value="Remove" />
    <div class="sbv-block-specific-country-list-current-mobile"></div>
    <h3><?php _e( 'Block IP Adress' ); ?></h3>
    <div class="sbv-block-block-specific-ip-contents">
      <label for="sbv-block-specific-ip-input-mobile"><?php _e( 'Add IP Address' ) ?></label>
      <div class="sbv-block-specific-error-mobile"></div>
      <input type="text" class="sbv-block-specific-ip-input-mobile" />
      <input type="button" class="sbv-btn-specific-add-mobile" value="Add" />
      <div class="sbv-block-specific-countries-current-mobile"></div>
    </div>
  </div>
  <div class="sbv-block-all-container-mobile">
    <h3><?php _e( 'Countries Exception' ); ?></h3>
    <select class="sbv-block-all-country-list-mobile"></select><br />
    <input type="button" class="sbv-block-all-btn-add-mobile" value="Add" />
    <input type="button" class="sbv-block-all-btn-remove-mobile" value="Remove" />
    <div class="sbv-block-all-country-list-current-mobile"></div>
    <h3><?php _e( 'IP Adress Exceptions' ); ?></h3>
    <label for="sbv-block-all-ip-input-mobile"><?php _e( 'Add IP Address' ) ?></label>
    <div class="sbv-block-all-error-mobile"></div>
    <input type="text" class="sbv-block-all-ip-input-mobile" />
    <input type="button" class="sbv-block-all-ip-add-mobile" value="Add" />
    <div class="sbv-block-all-ip-list-current-mobile"></div>
    <div class="sbv-block-all-bots-container-mobile">
      <input type="checkbox" class="sbv-block-all-bots-ch-mobile" /> Unblock crawler SEO bots to access your website.
    </div>
  </div>
  <h1>Set Blocked Page Redirect</h1>
  <div class="sbv-block-page-container-mobile">
    <select class="sbv-list-pages-mobile"></select>
    <input type="button" class="sbv-list-page-set-mobile" value="Set" />
    <div class="sbv-page-selected-mobile"></div>
  </div>
</div>

<script type="text/javascript">

sbv_check_status();
sbv_specific_list_countries_ul();
sbv_specific_list_countries_current();
sbv_specific_block_ip_current();
sbv_excemption_country_list_current();
sbv_excemption_ip_list_current();
sbv_list_pages();
sbv_current_redirect_page();
sbv_country_list_dropdown();

jQuery(window).resize(function() {
  sbv_check_status();
});

jQuery(".sbv-enable-specific, .sbv-enable-specific-mobile").on("change", function() {
  if ( jQuery(this).is(":checked") ) {
    var checked = 1;
  } else {
    checked = 0;
  }

  sbv_enable_blocker( "specific", checked );
});

jQuery(".sbv-enable-all, .sbv-enable-all-mobile").on("change", function() {
  if ( jQuery(this).is(":checked") ) {
    var checked = 1;
  } else {
    checked = 0;
  }

  sbv_enable_blocker( "all", checked );
});

jQuery(".sbv-block-all-bots-ch, .sbv-block-all-bots-ch-mobile").on("change", function() {
  if ( jQuery(this).is(":checked") ) {
    var checked = 1
  } else {
    var checked = 0;
  }

  var data = {
    "action": "sbv",
    "operation": "enable_bots",
    "checked": checked
  };

  jQuery.post(ajaxurl, data);
});

jQuery(".sbv-btn-specific-add").on("click", function() {
  var data = {
    "action": "sbv",
    "operation": "add_block_country",
    "country": sbv_country,
    "country_code": sbv_country_code
  };

  jQuery.post(ajaxurl, data, function(r) {
    sbv_specific_list_countries_current();
  });
});

jQuery(".sbv-specific-btn-add-mobile").on("click", function() {
  var country_code = jQuery(".sbv-block-specific-country-list-mobile").val();
  var country = jQuery(".sbv-block-specific-country-list-mobile option:selected").html();
  var data = {
    "action": "sbv",
    "operation": "add_block_country",
    "country": country,
    "country_code": country_code
  };

  jQuery.post(ajaxurl, data, function(r) {
    sbv_specific_list_countries_current();
  });
});

jQuery(".sbv-btn-specific-remove, .sbv-specific-btn-remove-mobile").on("click", function() {
  var data = {
    "action": "sbv",
    "operation": "remove_block_country",
    "pos": sbv_selected_country_current
  };

  jQuery.post(ajaxurl, data, function(r) {
    sbv_specific_list_countries_current();
  });
})

jQuery(".sbv-block-specific-ip-add").on("click", function() {
  var ip = jQuery(".sbv-block-specific-ip-input").val();

  if ( ! ip.match(/^(?!.*\.$)((?!0\d)(1?\d?\d|25[0-5]|2[0-4]\d)(\.|$)){4}$/) ) {
    jQuery(".sbv-block-specific-ip-error").html("Invalid IP Address.");
  } else {
    jQuery(".sbv-block-specific-ip-error").html("");

    var data = {
      "action": "sbv",
      "operation": "add_specific_ip_address",
      "ip": ip
    };

    jQuery.post(ajaxurl, data, function(r) {
      jQuery(".sbv-block-specific-ip-input").val("");
      sbv_specific_block_ip_current();
    });
  }
});

jQuery(".sbv-btn-specific-add-mobile").on("click", function() {
  var ip = jQuery(".sbv-block-specific-ip-input-mobile").val();

  if ( ! ip.match(/^(?!.*\.$)((?!0\d)(1?\d?\d|25[0-5]|2[0-4]\d)(\.|$)){4}$/) ) {
    jQuery(".sbv-block-specific-error-mobile").html("Invalid IP Address.");
  } else {
    jQuery(".sbv-block-specific-error-mobile").html("");
  }

  var data = {
    "action": "sbv",
    "operation": "add_specific_ip_address",
    "ip": ip
  };

  jQuery.post(ajaxurl, data, function(r) {
    jQuery(".sbv-block-all-ip-input-mobile").val("");
    sbv_specific_block_ip_current();
  });
});

jQuery(".sbv-block-all-btn-add").on("click", function() {
  var data = {
    "action": "sbv",
    "operation": "add_excempt_country",
    "country": sbv_country,
    "country_code": sbv_country_code
  };

  jQuery.post(ajaxurl, data, function() {
    sbv_excemption_country_list_current();
  });
});

jQuery(".sbv-block-all-btn-add-mobile").on("click", function() {
  var country_code = jQuery(".sbv-block-all-country-list-mobile").val();
  var country = jQuery(".sbv-block-all-country-list-mobile option:selected").html();
  var data = {
    "action": "sbv",
    "operation": "add_excempt_country",
    "country": country,
    "country_code": country_code
  };

  jQuery.post(ajaxurl, data, function() {
    sbv_excemption_country_list_current();
  });
});

jQuery(".sbv-block-all-btn-remove, .sbv-block-all-btn-remove-mobile").on("click", function() {
  var data = {
    "action": "sbv",
    "operation": "remove_excempted_country",
    "pos": excempt_country_selected
  };

  jQuery.post(ajaxurl, data, function() {
    sbv_excemption_country_list_current();
  });
});

jQuery(".sbv-block-all-ip-add").on("click", function() {
  var ip = jQuery(".sbv-block-all-ip-input").val();

  if ( ! ip.match(/^(?!.*\.$)((?!0\d)(1?\d?\d|25[0-5]|2[0-4]\d)(\.|$)){4}$/) ) {
    jQuery(".sbv-block-all-error").html("Invalid IP Address.");
  } else {
    var data = {
      "action": "sbv",
      "operation": "add_excempt_ip",
      "ip": ip
    };

    jQuery.post(ajaxurl, data, function() {
      jQuery(".sbv-block-all-error").html("");
      jQuery(".sbv-block-all-ip-input").val("");
      sbv_excemption_ip_list_current();
    });
  }
});

jQuery(".sbv-block-all-ip-add-mobile").on("click", function() {
  var ip = jQuery(".sbv-block-all-ip-input-mobile").val();

  if ( ! ip.match(/^(?!.*\.$)((?!0\d)(1?\d?\d|25[0-5]|2[0-4]\d)(\.|$)){4}$/) ) {
    jQuery(".sbv-block-all-error-mobile").html("Invalid IP Address.");
  } else {
    var data = {
      "action": "sbv",
      "operation": "add_excempt_ip",
      "ip": ip
    };

    jQuery.post(ajaxurl, data, function() {
      jQuery(".sbv-block-all-error-mobile").html("");
      jQuery(".sbv-block-all-ip-input-mobile").val("");
      sbv_excemption_ip_list_current();
    });
  }
});

jQuery(".sbv-list-page-set").on("click", function() {
  var value = jQuery(".sbv-list-pages").val();
  var data = {
    "action": "sbv",
    "operation": "select_page",
    "page": value
  };

  jQuery.post(ajaxurl, data, function(r) {
    sbv_current_redirect_page();
  });
});

jQuery(".sbv-list-page-set-mobile").on("click", function() {
  value = jQuery(".sbv-list-pages-mobile").val();
  var data = {
    "action": "sbv",
    "operation": "select_page",
    "page": value
  };

  jQuery.post(ajaxurl, data, function(r) {
    sbv_current_redirect_page();
  });
});

function sbv_check_status() {
  var data = {
    "action": "sbv",
    "operation": "check_status",
  };

  jQuery.post(ajaxurl, data, function( r ) {
    var status = r.split( "||" );

    if ( status[0] == 1 ) {
      jQuery(".sbv-enable-all, .sbv-enable-all-mobile").attr("checked", "checked");
      jQuery(".sbv-block-all-contents, .sbv-block-all-container-mobile").show();
    } else {
      jQuery(".sbv-enable-all, .sbv-enable-all-mobile").removeAttr("checked");
      jQuery(".sbv-block-all-contents, .sbv-block-all-container-mobile").hide();
    }

    if ( status[1] == 1 ) {
      jQuery(".sbv-enable-specific, .sbv-enable-specific-mobile").attr("checked", "checked");
      jQuery(".sbv-block-specific-contents, .sbv-block-specific-contents-mobile").show();
    } else {
      jQuery(".sbv-block-specific-contents, .sbv-block-specific-contents-mobile").hide();
      jQuery(".sbv-enable-specific, .sbv-enable-specific-mobile").removeAttr("checked");
    }

    if ( status[2] == 1 ) {
      jQuery(".sbv-block-all-bots-ch, .sbv-block-all-bots-ch-mobile").attr("checked", "checked");
    } else {
      jQuery(".sbv-block-all-bots-ch, .sbv-block-all-bots-ch-mobile").removeAttr("checked");
    }
  });
}

function sbv_enable_blocker( type, checked ) {
  var data = {
    "action": "sbv",
    "operation": "enable_block",
    "type": type,
    "checked": checked
  };

  jQuery.post(ajaxurl, data, function() {
    if ( type == "specific") {
      if ( checked == 1 ) {
        jQuery(".sbv-enable-all, .sbv-enable-all-mobile").removeAttr("checked");
        jQuery(".sbv-block-specific-contents, .sbv-block-specific-contents-mobile").show();
      } else {
        jQuery(".sbv-block-specific-contents, .sbv-block-specific-contents-mobile").hide();
      }

      jQuery(".sbv-block-all-contents, .sbv-block-all-container-mobile").hide();
    } else if ( type == 'all' ) {
      if ( checked == 1 ) {
        jQuery(".sbv-enable-specific, .sbv-enable-specific-mobile").removeAttr("checked");
        jQuery(".sbv-block-all-contents, .sbv-block-all-container-mobile").show();
      } else {
        jQuery(".sbv-block-all-contents, .sbv-block-all-container-mobile").hide();
      }

      jQuery(".sbv-block-specific-contents, .sbv-block-specific-contents-mobile").hide();
    }
  });
}

function sbv_specific_list_countries_ul() {
  var data = {
    "action": "sbv",
    "operation": "specific_list_countries_ul"
  };

  jQuery.post(ajaxurl, data, function( r ) {
    jQuery(".sbv-block-specific-countries-list, .sbv-block-all-country-list").html( r );
  });
}

function sbv_specific_list_countries_current() {
  var data = {
    "action": "sbv",
    "operation": "specific_list_countries_current"
  };

  jQuery.post(ajaxurl, data, function( r ) {
    jQuery(".sbv-block-specific-countries-current, .sbv-block-specific-country-list-current-mobile").html( r );
  });
}

function sbv_specific_block_ip_current() {
  var data = {
    "action": "sbv",
    "operation": "specific_block_ip_list"
  };

  jQuery.post(ajaxurl, data, function( r ) {
    jQuery(".sbv-block-specific-ip-block-list, .sbv-block-specific-countries-current-mobile").html( r );
  });
}

function sbv_excemption_country_list_current() {
  var data = {
    "action": "sbv",
    "operation": "excemption_country_list_current"
  };

  jQuery.post(ajaxurl, data, function( r ) {
    jQuery(".sbv-block-all-country-list-current, .sbv-block-all-country-list-current-mobile").html( r );
  });
}

function sbv_excemption_ip_list_current() {
  var data = {
    "action": "sbv",
    "operation": "ip_address_excemption_list"
  };

  jQuery.post(ajaxurl, data, function( r ) {
    jQuery(".sbv-block-all-ip-list-current, .sbv-block-all-ip-list-current-mobile").html( r );
  });
}

function sbv_list_pages() {
  var data = {
    "action": "sbv",
    "operation": "list_of_pages"
  };

  jQuery.post(ajaxurl, data, function( r ) {
    jQuery(".sbv-list-pages, .sbv-list-pages-mobile").html( r );
  });
}

function sbv_current_redirect_page() {
  var data = {
    "action": "sbv",
    "operation": "current_page_selected"
  };

  jQuery.post(ajaxurl, data, function( r ) {
    jQuery(".sbv-page-selected, .sbv-page-selected-mobile").html( r );
  });
}

function sbv_country_list_dropdown() {
  var data = {
    "action": "sbv",
    "operation": "country_list_dropdown",
  };

  jQuery.post(ajaxurl, data, function( r ) {
    jQuery(".sbv-block-specific-country-list-mobile, .sbv-block-all-country-list-mobile").html( r );
  });
}
</script>
