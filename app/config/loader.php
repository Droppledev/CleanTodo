<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    array(
        'CleanTodo\Domain'    => "../domain/",
        'CleanTodo\Domain\Entity'    => "../domain/entity",
        'CleanTodo\Domain\Repository'    => "../domain/repository",
        'CleanTodo\Domain\UseCase'    => "../domain/usecase",
        'CleanTodo\Domain\Service'    => "../domain/service",
        'CleanTodo\Persistence'    => "../persistence/",
        'CleanTodo\Persistence\Repository'    => "../persistence/repository",
        'CleanTodo\Persistence\Service'    => "../persistence/service"
    )
);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->entityDir
    )
)->register();
