<?php 

/**
* Plugin Name: Types Embedded Fields
 * Plugin URI: http://shareprogress.org/types_embed_field
 * Description: This is an awesome custom plugin to support adding embedded custom fields within custom fields. It's meant to work with the Types plug-in Just add the function types_embed(slug-name) on the page where you want things to be embedded.  Then add your embedded slugs into the parent custom field with {{}} curly braces.
 *
 * Author: Justine Lam
 * Author URI: http://shareprogress.org
 * Version: 0.1
 * 
*/


function types_embed($field_slug) {
  //get the rendered custom field and save as $field_val;
  $field_val = types_render_field($field_slug, array('output'=>'raw'));

  $slug_pattern = '/\{\{\s?([-a-z0-9]*)(?:-[a-z0-9])*\s?\}\}/';
  preg_match_all($slug_pattern, $field_val, $matches);
  //if there's a {{ slug }} pattern in the types rendered field then figure out the custom field output for this embedded slug
  $curly_braces = $matches[0]; //array with curly braces
  $slug_array = $matches[1]; //array with slug names
  $types_output = [];
  //create an array of rendered custom fields in $types_output
  foreach ($slug_array as $slug) { 
   $out_field = types_render_field($slug);
   array_push($types_output, $out_field); 
  }
  //string replace the {{slug}} with the rendered custom fields.
  return str_replace($curly_braces,$types_output,$field_val);
}


// register WP-Types custom fields with WP-API
add_action( 'rest_api_init', 'register_rest_state_fields' );
function register_rest_state_fields() {
    register_rest_field( 'state',
        'fields',
        array(
            'get_callback'    => 'get_post_wpcf_fields',
            'update_callback' => null,
            'schema'          => null,
        )
        // update_callback is null, so we cannot change these via the API
    );
}
function get_post_wpcf_fields( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], '', true);
    // passing empty string to get all meta fields for object, and true to return only one copy if duplicates
}
