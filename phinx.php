<?php
return [
    'paths' => [
        'migrations' => 'src/migrations', // Pasta onde as migrações serão armazenadas
        'seeds' => 'src/seeds', // Pasta para seeds (dados iniciais)
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog', // Tabela de logs do Phinx
        'development' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8mb4',
        ],
        'production' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8mb4',
        ],
    ],
];
