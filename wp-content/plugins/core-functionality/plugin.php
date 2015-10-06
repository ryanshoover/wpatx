<?php
/**
 * Plugin Name: Core Functionality
 * Plugin URI: http://www.billerickson.net
 * Description: This contains all your site's core functionality so that it is theme independent.
 * Version: 1.1
 * Author: Bill Erickson
 * Author URI: http://www.billerickson.net
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package BE_Genesis_Child
 * @version 1.0
 * @author Bill Erickson <bill@billerickson.net>
 * @copyright Copyright (c) 2011, Bill Erickson
 * @link http://www.billerickson.net/shortcode-to-display-posts/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Plugin Directory
define( 'BE_DIR', dirname( __FILE__ ) );

// Post Types
//include_once( BE_DIR . '/lib/functions/post-types.php' );

// Post to Posts Connections
include_once( BE_DIR . '/lib/functions/connections.php' );

// Post Formats
include_once( BE_DIR . '/lib/functions/cf-post-formats.php' );

// Taxonomies
//include_once( BE_DIR . '/lib/functions/taxonomies.php' );

// Metaboxes
include_once( BE_DIR . '/lib/functions/metaboxes.php' );

// Shortcodes
include_once( BE_DIR . '/lib/functions/shortcodes.php' );

// Facebook Open Graph Tags
// -- Set default image in general.php
//include_once( BE_DIR . '/lib/functions/facebook.php' );

// Widgets
//include_once( BE_DIR . '/lib/widgets/member-list.php' );

// General
include_once( BE_DIR . '/lib/functions/general.php' );

// Gform Placeholder
//include_once( BE_DIR . '/lib/functions/gform-placeholder.php' );
