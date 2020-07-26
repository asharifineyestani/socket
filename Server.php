<?php

/*
   |--------------------------------------------------------------------------
   | ignore_user_abort
   |--------------------------------------------------------------------------
   |
   | Sets whether a client disconnect should cause a script to be aborted.
   | When running PHP as a command line script, and the script's tty goes away without
   | the script being terminated then the script will die the next time it tries to write
   | anything, unless value is set to TRUE
   |
   */
ignore_user_abort(true);


/*
   |--------------------------------------------------------------------------
   | Set variables
   |--------------------------------------------------------------------------
   |
   | Host: 127.0.0.1 is localhost
   | Port : You can select a custom port
   |
   */

$host = "127.0.0.1";
$port = 25003;

/*
   |--------------------------------------------------------------------------
   |  Limits the maximum execution time
   |--------------------------------------------------------------------------
   |
   */

set_time_limit(0);


?>
