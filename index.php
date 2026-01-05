<?php
/**
 * E-Learning Bootcamp System
 * CodeIgniter 3 Entry Point
 */

// Set environment (development, testing, production)
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

// Error reporting based on environment
switch (ENVIRONMENT)
{
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
    break;

    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
    break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'Environment tidak valid.';
        exit(1);
}

// System folder path
$system_path = 'system';

// Application folder path
$application_folder = 'application';

// View folder (default: application/views/)
$view_folder = '';

// Set the current directory correctly
if (defined('STDIN'))
{
    chdir(dirname(__FILE__));
}

// Validate system path
if (($_temp = realpath($system_path)) !== FALSE)
{
    $system_path = $_temp.DIRECTORY_SEPARATOR;
}
else
{
    $system_path = strtr(
        rtrim($system_path, '/\\'),
        '/\\',
        DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
    ).DIRECTORY_SEPARATOR;
}

// Is the system path correct?
if ( ! is_dir($system_path))
{
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'System path tidak ditemukan. Pastikan folder system ada.';
    exit(3);
}

// Define path constants
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', $system_path);
define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('SYSDIR', basename(BASEPATH));

// Application path
if (is_dir($application_folder))
{
    if (($_temp = realpath($application_folder)) !== FALSE)
    {
        $application_folder = $_temp;
    }
    else
    {
        $application_folder = strtr(
            rtrim($application_folder, '/\\'),
            '/\\',
            DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
        );
    }
}
elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
{
    $application_folder = BASEPATH.strtr(
        trim($application_folder, '/\\'),
        '/\\',
        DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
    );
}
else
{
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Application folder tidak ditemukan.';
    exit(3);
}

define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

// View folder path
if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
{
    $view_folder = APPPATH.'views';
}
elseif (is_dir($view_folder))
{
    if (($_temp = realpath($view_folder)) !== FALSE)
    {
        $view_folder = $_temp;
    }
    else
    {
        $view_folder = strtr(
            rtrim($view_folder, '/\\'),
            '/\\',
            DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
        );
    }
}
elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
{
    $view_folder = APPPATH.strtr(
        trim($view_folder, '/\\'),
        '/\\',
        DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
    );
}
else
{
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'View folder tidak ditemukan.';
    exit(3);
}

define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

// Load CodeIgniter Bootstrap
require_once BASEPATH.'core/CodeIgniter.php';
