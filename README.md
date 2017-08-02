**Supervisor API Client**

ToDo:
- documentation
- example
- etc.


Example for multi server call. 
```php
<?php

use FragSeb\Supervisor\ServerRegistry;
use FragSeb\Supervisor\Client\ClientRegistry;
use FragSeb\Supervisor\ClientManager;

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

$registry = new ClientRegistry(new ServerRegistry($config));
$manager = new ClientManager($registry);


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

use FragSeb\Supervisor\ServerRegistry;
use FragSeb\Supervisor\Client\ClientRegistry;
use FragSeb\Supervisor\ClientManager;

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

$registry = new ClientRegistry(new ServerRegistry($config));
$manager = new ClientManager($registry);


try {
    $client = $manager->getClient('master');
    
    var_dump($client->getAllProcessInfo());
} catch (\Exception $exception) {
    echo 'message: ' . $exception->getMessage() . PHP_EOL;
    echo 'code: ' . $exception->getCode() . PHP_EOL;
    exit;
}

```