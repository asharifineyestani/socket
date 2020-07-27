<?php

ignore_user_abort(true);
set_time_limit(0);
$host = "localhost";
$port = 6565;

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or
die("Could not create socket.\n");

$result = socket_bind($socket, $host, $port) or
die("Could not bind to socket.\n");

$result = socket_listen($socket, 3) or
die("Could not setup socket listener\n");

$spawn = socket_accept($socket) or
die("Could not accept incoming connection. \n");


while (1) {
    $input = socket_read($spawn, 1024) or
    die("Could not read input \n");

    if ($input === "close") {
        socket_close($spawn);
        socket_close($socket);
        break;
    }

    $output = strrev($input);
    echo 'message received';
    socket_write($spawn, $output, strlen($output)) or
    die("could not write output \n");
}


