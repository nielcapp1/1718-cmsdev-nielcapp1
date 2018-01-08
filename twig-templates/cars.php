<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/Car.php';

/*
 * Go to this file in your web-browser to render Twig templates:
 *
 *  * http://localhost/index.php            -> index.twig
 *  * http://localhost/index.php/contact    -> contact.twig
 *
 * ... etc ...
 */

// 1) create a Symfony Request, used only to help make each URL render a different Twig template
use Symfony\Component\HttpFoundation\Request;
$request = Request::createFromGlobals();
$uri = $request->getPathInfo();

// 2) bootstrap Twig!
$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, array(
    // cache disabled, since this is just a testing project
    'cache' => false,
    'debug' => true,
    'strict_variables' => true
));
$twig->addExtension(new Twig_Extension_Debug());


// render twig template
echo $twig->render('cars.twig', array(
    'pageData' => array(
        'title' => 'Onze wagens.',
        'description' => 'Maak kennis met ons gamma.',
    ),
    'cars' => array(
        new Car('Model S', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, ullam.', 'tesla-Model3.png'),
        new Car('Model X', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, ullam.', 'Tesla-Model-X.png'),
        new Car('Model 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, ullam.', 'tesla-ModelS.png'),
        )
));