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
   */
$socket = socket_create(AF_INET, SOCK_STREAM, 0)
or die("Could not create socket" . PHP_EOL);


/*
   |--------------------------------------------------------------------------
   |  Binds host and port to the socket
   |--------------------------------------------------------------------------
   | socket_bind ( resource $socket , string $address [, int $port = 0 ] ) : bool
   | address = localhost
   | port = custom port for example 25003
   */

$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");

