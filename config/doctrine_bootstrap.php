<?php

$isDevMode = true;
$doctrine_config = \Doctrine\ORM\Tools\Setup::createYAMLMetadataConfiguration(array(__DIR__ . '/' . $config->application->yamlDir), $isDevMode);

$conn = array(
    'driver' => 'pdo_' . $config->database->adapter,
    'user'     => $config->database->username,
    'password' => $config->database->password,
    'dbname'   => $config->database->dbname,
);

$entityManager = Doctrine\ORM\EntityManager::create($conn, $doctrine_config);

$di->setShared('entityManager', function () use ($entityManager) {
    return $entityManager;
});
$di->setShared('customerRepository', [
    'className' => 'CleanTodo\Persistence\Repository\CustomerRepository',
    'arguments' => [
        [
            'type' => 'service',
            'name' => 'entityManager'
        ]
    ]
]);
$di->setShared('customerEntity', function () {
    return new CleanTodo\Domain\Entity\Customer;
});
$di->setShared('todoRepository', [
    'className' => 'CleanTodo\Persistence\Repository\TodoRepository',
    'arguments' => [
        [
            'type' => 'service',
            'name' => 'entityManager'
        ]
    ]
]);
$di->setShared('todoEntity', function () {
    return new CleanTodo\Domain\Entity\Todo;
});

$di->setShared('getTodoUseCase', [
    'className' => 'CleanTodo\Domain\UseCase\GetTodoUseCase',
    'arguments' => [
        [
            'type' => 'service',
            'name' => 'todoRepository'
        ]
    ]
]);
$di->setShared('insertTodoUseCase', [
    'className' => 'CleanTodo\Domain\UseCase\InsertTodoUseCase',
    'arguments' => [
        [
            'type' => 'service',
            'name' => 'todoRepository'
        ]
    ]
]);
$di->setShared('deleteTodoUseCase', [
    'className' => 'CleanTodo\Domain\UseCase\DeleteTodoUseCase',
    'arguments' => [
        [
            'type' => 'service',
            'name' => 'todoRepository'
        ]
    ]
]);
$di->setShared('updateTodoUseCase', [
    'className' => 'CleanTodo\Domain\UseCase\UpdateTodoUseCase',
    'arguments' => [
        [
            'type' => 'service',
            'name' => 'todoRepository'
        ]
    ]
]);

$di->set('dompdf', function () {
    return new Dompdf\Dompdf;
});

$di->set('domPdfService', [
    'className' => 'CleanTodo\Persistence\Service\DomPdfService',
    'arguments' => [
        [
            'type' => 'service',
            'name' => 'dompdf'
        ]
    ]
]);

$di->set('generatePdfUseCase', [
    'className' => 'CleanTodo\Domain\UseCase\GeneratePdfUseCase',
    'arguments' => [
        [
            'type' => 'service',
            'name' => 'domPdfService'
        ]
    ]
]);
