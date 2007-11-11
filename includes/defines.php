<?php
/**
 * This file is part of MythWeb, a php-based interface for MythTV.
 * See http://www.mythtv.org/ for details.
 *
 * @url         $URL: svn+ssh://svn.mythtv.org/var/lib/svn/trunk/mythplugins/mythweb/includes/init.php $
 * @date        $Date: 2007-07-28 21:46:51 -0700 (Sat, 28 Jul 2007) $
 * @version     $Revision: 14075 $
 * @author      $Author: xris $
 * @license     GPL
 *
 * @package     MythWeb
 *
/**/

// Figure out the root path for this mythweb installation.  We need this in order
// to cleanly reference things like the /js directory from subpaths.
    define('root', str_replace('//', '/', dirname($_SERVER['SCRIPT_NAME']).'/'));

// Several sections of this program require the current hostname
    define('hostname', empty($_SERVER['hostname']) ? trim(`hostname`) : $_SERVER['hostname']);

// Define the error email, or set it to a null string if there isn't a valid one
    define('error_email', array_key_exists('error_email', $_SERVER) && strstr($_SERVER['error_email'], '@')
                          ? $_SERVER['error_email']
                          : '');

/**
 * $Path is an array of PATH_INFO passed into the script via mod_rewrite or some
 * other lesser means.  It contains most of the information required for
 * figuring out what functions the user wants to access.
 *
 * @global  array   $GLOBALS['Path']
 * @name    $Path
/**/
    $Path = explode('/', preg_replace('/^\/+/',   '',    // Remove leading slashes
                         preg_replace('/[\s]+/', ' ',    // Convert extra whitespace
                                                         // Grab the path info from various different places.
                             array_key_exists('PATH_INFO', $_SERVER)
                             && $_SERVER['PATH_INFO']
                                ? $_SERVER['PATH_INFO']
                                : (array_key_exists('PATH_INFO', $_ENV)
                                   && $_ENV['PATH_INFO']
                                    ? $_ENV['PATH_INFO']
                                    : (array_key_exists('PATH_INFO', $_GET)
                                       ? $_GET['PATH_INFO']
                                       : ''
                                      )
                                  )
                         ))
                   );

// Handy reference to the current module
    define('module', $Path[0]);

// Find the modules path
    $path = dirname(dirname(find_in_path('modules/tv/init.php')));
    define('modules_path', $path);

// Set up some constants used by nice_filesystem()
    define('kb', 1024);         // Kilobyte
    define('mb', 1024 * kb);    // Megabyte
    define('gb', 1024 * mb);    // Gigabyte
    define('tb', 1024 * gb);    // Terabyte