<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/AppStore.php';

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
echo $twig->render('app.twig', array(
    'pageData' => array(
        'title' => 'App',
        'description' => 'Tijd om je smartphone erbij te nemen.',
    ),
    'appStores' => array(
        new AppStore('iOS', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque accusamus omnis repellat nesciunt enim deleniti similique, fugiat nostrum, consequatur eaque optio voluptates cupiditate dicta eligendi a assumenda. Suscipit modi dolorem nostrum temporibus nam vel nulla quam veritatis natus quasi itaque, rerum ut, sunt consequuntur tempora totam cupiditate, aperiam esse facere autem illum! Ullam a expedita eos animi id debitis amet recusandae odit explicabo unde vel nesciunt hic at quos, fugit esse autem quis aliquam, rerum inventore eius beatae sequi aut.', 'apple.svg'),
        new AppStore('Android', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam corporis adipisci, eligendi libero ullam praesentium nostrum eius, quod inventore corrupti dicta accusamus earum quo quae architecto animi, tempore assumenda beatae delectus at ut enim. Nostrum explicabo, eveniet iste, voluptate mollitia ad pariatur magnam, aut suscipit fugit, at molestias quos ea. Qui illo ab repellat voluptate iste, ipsa fugiat laboriosam. Neque rerum est quibusdam doloremque distinctio, dolor, perferendis vel, quo perspiciatis veritatis repellat obcaecati quis molestias et amet repellendus, minus inventore.', 'android.png'),
    )
));