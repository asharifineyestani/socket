<?php

/*
   |--------------------------------------------------------------------------
   |  Limits the maximum execution time
   |--------------------------------------------------------------------------
   |
   */
set_time_limit(0);

/*
   |--------------------------------------------------------------------------
   | Set variables
   |--------------------------------------------------------------------------
   |
   | Host: 127.0.0.1 is localhost
   | Port : You can select a custom port, for example we use 25003
   | Message: a custom message
   |
   */
$host = "127.0.0.1";
$port = 25003;
$message = "Hello Mr Aghakhani";
echo "Message To server : ".$message;
