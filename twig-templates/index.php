<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/InfoBlock.php';

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
echo $twig->render('homepage.twig', array(
    'pageData' => array(
        'title' => 'CARGO',
        'description' => 'Ontdek de mogelijkheden van CARGO.',
    ),
    'infoblocks' => array(
        new InfoBlock('Elektronische wagens', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque accusamus omnis repellat nesciunt enim deleniti similique, fugiat nostrum, consequatur eaque optio voluptates cupiditate dicta eligendi a assumenda. Suscipit modi dolorem nostrum temporibus nam vel nulla quam veritatis natus quasi itaque, rerum ut, sunt consequuntur tempora totam cupiditate, aperiam esse facere autem illum! Ullam a expedita eos animi id debitis amet recusandae odit explicabo unde vel nesciunt hic at quos, fugit esse autem quis aliquam, rerum inventore eius beatae sequi aut.', 'Tesla-Model-X-2.jpg'),
        new InfoBlock('Elektronische wagens', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque accusamus omnis repellat nesciunt enim deleniti similique, fugiat nostrum, consequatur eaque optio voluptates cupiditate dicta eligendi a assumenda. Suscipit modi dolorem nostrum temporibus nam vel nulla quam veritatis natus quasi itaque, rerum ut, sunt consequuntur tempora totam cupiditate, aperiam esse facere autem illum! Ullam a expedita eos animi id debitis amet recusandae odit explicabo unde vel nesciunt hic at quos, fugit esse autem quis aliquam, rerum inventore eius beatae sequi aut.', 'Tesla-Model-X-2.jpg'),
        new InfoBlock('Elektronische wagens', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque accusamus omnis repellat nesciunt enim deleniti similique, fugiat nostrum, consequatur eaque optio voluptates cupiditate dicta eligendi a assumenda. Suscipit modi dolorem nostrum temporibus nam vel nulla quam veritatis natus quasi itaque, rerum ut, sunt consequuntur tempora totam cupiditate, aperiam esse facere autem illum! Ullam a expedita eos animi id debitis amet recusandae odit explicabo unde vel nesciunt hic at quos, fugit esse autem quis aliquam, rerum inventore eius beatae sequi aut.', 'Tesla-Model-X-2.jpg'),
        new InfoBlock('Elektronische wagens', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque accusamus omnis repellat nesciunt enim deleniti similique, fugiat nostrum, consequatur eaque optio voluptates cupiditate dicta eligendi a assumenda. Suscipit modi dolorem nostrum temporibus nam vel nulla quam veritatis natus quasi itaque, rerum ut, sunt consequuntur tempora totam cupiditate, aperiam esse facere autem illum! Ullam a expedita eos animi id debitis amet recusandae odit explicabo unde vel nesciunt hic at quos, fugit esse autem quis aliquam, rerum inventore eius beatae sequi aut.', 'Tesla-Model-X-2.jpg'),
        )
));