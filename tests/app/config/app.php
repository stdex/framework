<?php

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

return [
    'encoding' => 'UTF-8',
    'timezone' => 'UTC',
    'locale' => 'en',
    'error' => [
        'level' => -1,
        'logger' => false,
        'skip' => [
            NotFoundException::class,
            MethodNotAllowedException::class,
        ],
    ],
    'viewEngine' => 'twig',
    'providers' => [
        'twig' => 'TwigProvider',
    ],
    'middlewares' => [
        'app' => [
            'animal' => 'AnimalMiddleware',
        ],
        'route' => [
            'zoo' => 'ZooMiddleware',
        ],
    ],
    'httpVersion' => '1.1',
    'responseChunkSize' => 4096,
    'outputBuffering' => 'prepend',
    'determineRouteBeforeAppMiddleware' => false,
    'displayErrorDetails' => true,
];
