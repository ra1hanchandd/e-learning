<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Autoload Configuration
 * E-Learning Bootcamp System
 */

// Packages to autoload
$autoload['packages'] = array();

// Libraries to autoload
$autoload['libraries'] = array(
    'database',     // Database library
    'session',      // Session library
    'form_validation', // Form validation
    'pagination'    // Pagination library
);

// Drivers to autoload
$autoload['drivers'] = array();

// Helpers to autoload
$autoload['helper'] = array(
    'url',          // URL helper
    'form',         // Form helper
    'file',         // File helper
    'text',         // Text helper
    'my_helper'     // Custom helper
);

// Config files to autoload
$autoload['config'] = array();

// Language files to autoload
$autoload['language'] = array();

// Models to autoload
$autoload['model'] = array();
