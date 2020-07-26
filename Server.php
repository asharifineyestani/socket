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

/*
   |--------------------------------------------------------------------------
   |  Create socket
   |--------------------------------------------------------------------------
   | socket_create ( int $domain , int $type , int $protocol ) : resource
   | domain = AF_INIT: IPv4 Internet based protocols. TCP and UDP are common protocols of this protocol family.
   | type = SOCK_STREAM: Provides sequenced, reliable, full-duplex, connection-based byte streams. An out-of-band data transmission mechanism may be supported. The TCP protocol is based on this socket type.
   | protocol = 0 , you can use tcp, udp or icmp
   |
   */
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or
die("Could not create socket" . PHP_EOL);


/*
   |--------------------------------------------------------------------------
   |  Binds host and port to the socket
   |--------------------------------------------------------------------------
   | socket_bind ( resource $socket , string $address [, int $port = 0 ] ) : bool
   | address = localhost
   | port = custom port for example 25003
   |
   */

$result = socket_bind($socket, $host, $port) or
die("Could not bind to socket" . PHP_EOL);

/*
   |--------------------------------------------------------------------------
   |  Listens for a connection on the socket
   |--------------------------------------------------------------------------
   | socket_listen ( resource $socket [, int $backlog = 0 ] ) : bool
   | backlog = A maximum of backlog incoming connections will be queued for processing.
   | for example we use 3
   |
   */

$result = socket_listen($socket, 3) or
die("Could not setup socket listener" . PHP_EOL);

/*
   |--------------------------------------------------------------------------
   |   Accepts a connection on the socket
   |--------------------------------------------------------------------------
   | socket_accept ( resource $socket ) : resource
   | accept incoming connections
   | spawn another socket to handle communication
   |
   */

$spawn = socket_accept($socket) or
die("Could not accept incoming connection" . PHP_EOL);


/*
   |--------------------------------------------------------------------------
   |   Reads a maximum of length bytes from the socket
   |--------------------------------------------------------------------------
   | socket_read ( resource $socket , int $length [, int $type = PHP_BINARY_READ ] ) : string
   | length =  The maximum number of bytes read is specified by the length parameter
   |
   */

$input = socket_read($spawn, 1024) or
die("Could not read input". PHP_EOL);


/*
   |--------------------------------------------------------------------------
   |   Write to the socket
   |--------------------------------------------------------------------------
   | socket_write ( resource $socket , string $buffer [, int $length = 0 ] ) : int
   | buffer =  The buffer to be written.
   | length =  The optional parameter length can specify an alternate length of bytes written to the socket.
   |
   |--------------------------------------------------------------------------
   |
   | we use trim to clean up input string
   | Strip whitespace (or other characters) from the input
   |
   |--------------------------------------------------------------------------
   | we use strtoupper() to react to the message
   | we could to use strrev() or strtolower()
   |
   */

$input = trim($input);
echo " Client Message : " . $input;
$buffer = strtoupper($input) . PHP_EOL;

socket_write($spawn, $buffer, strlen($buffer)) or die("Could not write output\n");

/*
   |--------------------------------------------------------------------------
   |   Closes the socket resource
   |--------------------------------------------------------------------------
   | socket_close ( resource $socket ) : void
   | socket_close() closes the socket resource given by socket.
   | This function is specific to sockets and cannot be used on any other type of resources.
   |
   */

socket_close($spawn);
socket_close($socket);

