[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://travis-ci.org/frag-seb/supervisor-client.svg?branch=master)](https://travis-ci.org/frag-seb/supervisor-client)
[![Coverage Status](https://coveralls.io/repos/github/frag-seb/supervisor-client/badge.svg?branch=develop)](https://coveralls.io/github/frag-seb/supervisor-client?branch=develop)
[![codecov](https://codecov.io/gh/frag-seb/supervisor-client/branch/master/graph/badge.svg)](https://codecov.io/gh/frag-seb/supervisor-client)


[![Total Downloads](https://poser.pugx.org/frag-seb/supervisor-client/downloads.png)](https://packagist.org/packages/frag-seb/supervisor-client)

**Supervisor API Client**

ToDo:
- documentation
- example
- etc.


Example of a simple way to create a client manager.
```php
<?php


use FragSeb\Supervisor\Factory\ManagerFactory;

/** @var Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';

$config = [
    'master' => [
        'host' => 'http://localhost:9001/RPC2',
        'auth' => [
            'username' => 'user',
            'password' => 123
        ]
    ],
    'slave' => [
        'host' => 'http://localhost2:9001/RPC2',
        'auth' => [
            'username' => 'user',
            'password' => 123
        ]
    ]
];

$factory = new ManagerFactory();

$manager =  $factory->create($config);

try {
    $client = $manager;
    
    var_dump($client->getAllProcessInfo());
} catch (\Exception $exception) {
    echo 'message: ' . $exception->getMessage() . PHP_EOL;
    echo 'code: ' . $exception->getCode() . PHP_EOL;
    exit;
}

```

Example for multi server call. 
```php
<?php

use FragSeb\Supervisor\Factory\ClientFactory;
use FragSeb\Supervisor\Factory\XmlRpcConnectorFactory;
use FragSeb\Supervisor\Serializer\XmlRpcSerializer;
use FragSeb\Supervisor\Registry\ServerRegistry;
use FragSeb\Supervisor\Registry\ClientRegistry;
use FragSeb\Supervisor\ClientManager;
use FragSeb\Supervisor\Factory\ServerFactory;
use FragSeb\Supervisor\Response\ResponseBuilder;

/** @var Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';

$config = [
    'master' => [
        'host' => 'http://localhost:9001/RPC2',
        'auth' => [
            'username' => 'user',
            'password' => 123
        ]
    ],
    'slave' => [
        'host' => 'http://localhost2:9001/RPC2',
        'auth' => [
            'username' => 'user',
            'password' => 123
        ]
    ]
];

$clientRegistry = new ClientRegistry(
    new ServerRegistry($config, new ServerFactory),
    new XmlRpcConnectorFactory(new XmlRpcSerializer),
    new ClientFactory(new ResponseBuilder)
);

/** @var \FragSeb\Supervisor\Client\ClientInterface $manager */
$manager =  new ClientManager($clientRegistry);


try {
    var_dump($manager->getAllProcessInfo());
} catch (\Exception $exception) {
    echo 'message: ' . $exception->getMessage() . PHP_EOL;
    echo 'code: ' . $exception->getCode() . PHP_EOL;
    exit;

}

```

Example for single call.
```php
<?php

use FragSeb\Supervisor\Factory\ClientFactory;
use FragSeb\Supervisor\Factory\XmlRpcConnectorFactory;
use FragSeb\Supervisor\Serializer\XmlRpcSerializer;
use FragSeb\Supervisor\Registry\ServerRegistry;
use FragSeb\Supervisor\Registry\ClientRegistry;
use FragSeb\Supervisor\ClientManager;
use FragSeb\Supervisor\Factory\ServerFactory;
use FragSeb\Supervisor\Response\ResponseBuilder;

/** @var Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';

$config = [
    'master' => [
        'host' => 'http://localhost:9001/RPC2',
        'auth' => [
            'username' => 'user',
            'password' => 123
        ]
    ],
    'slave' => [
        'host' => 'http://localhost2:9001/RPC2',
        'auth' => [
            'username' => 'user',
            'password' => 123
        ]
    ]
];

$clientRegistry = new ClientRegistry(
    new ServerRegistry($config, new ServerFactory),
    new XmlRpcConnectorFactory(new XmlRpcSerializer),
    new ClientFactory(new ResponseBuilder)
);

/** @var \FragSeb\Supervisor\Client\ClientInterface $manager */
$manager =  new ClientManager($clientRegistry);

try {
    $client = $manager->getClient('master');
    
    var_dump($client->getAllProcessInfo());
} catch (\Exception $exception) {
    echo 'message: ' . $exception->getMessage() . PHP_EOL;
    echo 'code: ' . $exception->getCode() . PHP_EOL;
    exit;
}

```

