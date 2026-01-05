<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Configuration
 * E-Learning Bootcamp System
 */

// Base URL - GANTI SESUAI URL ANDA
$config['base_url'] = 'http://localhost/e-learning/';

// Index file (kosong jika pakai .htaccess)
$config['index_page'] = '';

// URI Protocol
$config['uri_protocol']	= 'REQUEST_URI';

// URL suffix
$config['url_suffix'] = '';

// Default language
$config['language']	= 'english';

// Character set
$config['charset'] = 'UTF-8';

// Enable hooks
$config['enable_hooks'] = FALSE;

// Subclass prefix
$config['subclass_prefix'] = 'MY_';

// Composer autoload
$config['composer_autoload'] = FALSE;

// Allowed URL characters
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

// Query strings
$config['allow_get_array'] = TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

// Logging
$config['log_threshold'] = 1;
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';

// Cache
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;

// Encryption key - GANTI DENGAN KEY RANDOM ANDA
$config['encryption_key'] = 'eLearningBootcamp2026SecretKey!!';

// Session configuration
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200; // 2 hours
$config['sess_save_path'] = sys_get_temp_dir();
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

// Cookie settings
$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;

// CSRF Protection
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_token';
$config['csrf_cookie_name'] = 'csrf_cookie';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

// Standardize newlines
$config['standardize_newlines'] = FALSE;

// Global XSS Filtering
$config['global_xss_filtering'] = FALSE;

// Output compression
$config['compress_output'] = FALSE;

// Time reference
$config['time_reference'] = 'local';

// Rewrite PHP short tags
$config['rewrite_short_tags'] = FALSE;

// Proxy IPs
$config['proxy_ips'] = '';
