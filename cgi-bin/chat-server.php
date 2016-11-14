<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Mataam\Chat;
    
    require dirname(__DIR__) . '/vendor/autoload.php';
    require dirname(__DIR__) . '/src/Chat.php';
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        8080
    );

    $server->run();