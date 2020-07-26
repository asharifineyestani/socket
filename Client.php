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
