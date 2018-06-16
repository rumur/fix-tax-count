<?php

namespace Rumur;

// Make sure this file is called by wp.
defined( 'ABSPATH' ) || die();

// Make sure this file is called in the Admin Panel.
if ( is_admin() ) {
    // Include the whole directory.
    Helpers\dir_loader( __DIR__, __FILE__ );
}
