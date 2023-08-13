<?php

use DI\Container;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

// Instanciez le conteneur de dépendances
$container = new Container();



// Exemple de configuration d'une dépendance pour la classe Articlephp -S localhost:3000
$container->set('Article', function (ContainerInterface $container) {
    $db = $container->get('db');
    return new Article($db);
});

// Ajoutez d'autres configurations de dépendances selon vos besoins

// Retournez le conteneur
return $container;
