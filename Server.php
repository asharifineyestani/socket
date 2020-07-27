<?php

class Server
{
    public $port;
    public $address;
    public $length;
    public $socket;
    public $accepted;


    public function __construct($port = 1234, $length = 1024)
    {
        $this->port = $port;
        $this->length = $length;
        $this->address = 'localhost';
        $this->connect();
    }


    public function connect()
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, 0) or
        die("Could not create socket\n");

        $result = socket_bind($this->socket, $this->address, $this->port) or
        die("Could not bind to socket\n");

        socket_listen($this->socket, 3) or
        die("Could not setup socket listener" . PHP_EOL);

        $this->accepted = socket_accept($this->socket) or
        die("Could not accept incoming connection" . PHP_EOL);
    }

    public function close($message)
    {
        socket_close($this->socket);
        socket_close($this->accepted);
        die($message ?? "the socket closed");
    }

    public function loop()
    {

        while (1) {
            $input = socket_read($this->accepted, 1024) or
            die("Could not read input \n");

            if (trim($input) == ":q") {
                $this->close("user exit successfully.");
            }

            $output = strrev($input);
            socket_write($this->accepted, $output, strlen($output)) or
            die("could not write output \n");

        }

        $this->close();
    }

}

$socket = new ServerClass(5502);
$socket->loop();