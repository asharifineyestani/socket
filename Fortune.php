<?php

/*
   |--------------------------------------------------------------------------
   | Initial config
   |--------------------------------------------------------------------------
   | don't timeout!
   | ignore_user_abort
   |
   */

set_time_limit(0);


/*
   |--------------------------------------------------------------------------
   | Set some variables
   |--------------------------------------------------------------------------
   |
   | Host: 127.0.0.1 is localhost
   | Port : You can select a custom port
   | Command : relative with fortune
   */

$host = "127.0.0.1";
$port = 25003;
$command = "/usr/games/fortune";


/*
   |--------------------------------------------------------------------------
   |  Create socket
   |--------------------------------------------------------------------------
   |
   */
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or
die("Could not create socket" . PHP_EOL);


/*
   |--------------------------------------------------------------------------
   |  Binds host and port to the socket
   |--------------------------------------------------------------------------
   |
   */

$result = socket_bind($socket, $host, $port) or
die("Could not bind to socket" . PHP_EOL);

/*
   |--------------------------------------------------------------------------
   |  Listens for connection on the socket
   |--------------------------------------------------------------------------
   | start listening for connections
   |
   */

$result = socket_listen($socket, 3) or
die("Could not setup socket listener" . PHP_EOL);

echo "Please wait..." . PHP_EOL;

/*
   |--------------------------------------------------------------------------
   |   Accepts a connection on the socket
   |--------------------------------------------------------------------------
   | accept incoming connections
   | accepted another socket to handle communication
   |
   */

$accepted = socket_accept($socket) or
die("Could not accept incoming connection" . PHP_EOL);

echo "Received connection request" . PHP_EOL;


/*
   |--------------------------------------------------------------------------
   |   run command and send back output
   |--------------------------------------------------------------------------
   |
   */

$output = `$command`;
socket_write($accepted, $output, strlen($output)) or die("Could not write output\n");
echo "Sent output: $output\n";


/*
   |--------------------------------------------------------------------------
   |   Closes the socket resource
   |--------------------------------------------------------------------------
   | socket_close ( resource $socket ) : void
   | socket_close() closes the socket resource given by socket.
   | This function is specific to sockets and cannot be used on any other type of resources.
   |
   */

socket_close($accepted);
socket_close($socket);


echo "Socket closed\n";
