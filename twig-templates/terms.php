<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/Term.php';

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
echo $twig->render('terms.twig', array(
    'pageData' => array(
        'title' => 'Algemene Voorwaarden',
        'description' => 'Do’s en dont’s omtrent het lenen van onze wagens.',
    ),
    'terms' => array(
        new Term('Artikel 01', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque accusamus omnis repellat nesciunt enim deleniti similique, fugiat nostrum, consequatur eaque optio voluptates cupiditate dicta eligendi a assumenda. Suscipit modi dolorem nostrum temporibus nam vel nulla quam veritatis natus quasi itaque, rerum ut, sunt consequuntur tempora totam cupiditate, aperiam esse facere autem illum! Ullam a expedita eos animi id debitis amet recusandae odit explicabo unde vel nesciunt hic at quos, fugit esse autem quis aliquam, rerum inventore eius beatae sequi aut.'),
        new Term('Artikel 02', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam corporis adipisci, eligendi libero ullam praesentium nostrum eius, quod inventore corrupti dicta accusamus earum quo quae architecto animi, tempore assumenda beatae delectus at ut enim. Nostrum explicabo, eveniet iste, voluptate mollitia ad pariatur magnam, aut suscipit fugit, at molestias quos ea. Qui illo ab repellat voluptate iste, ipsa fugiat laboriosam. Neque rerum est quibusdam doloremque distinctio, dolor, perferendis vel, quo perspiciatis veritatis repellat obcaecati quis molestias et amet repellendus, minus inventore.'),
        new Term('Artikel 03', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, perferendis iure nostrum praesentium aperiam odio tenetur dolorum, quis, dolores maiores sunt! Numquam maxime obcaecati aperiam at cupiditate, minima a ipsa perferendis repellat vero commodi, necessitatibus ea. Illo dignissimos, illum veniam, quos quis corporis omnis necessitatibus odio velit. In illum tempore delectus magni, assumenda repellat, iste alias, obcaecati consectetur inventore iure et soluta neque dolorem nihil. Exercitationem, atque incidunt dignissimos minima, pariatur non dolorum earum odio doloremque quae debitis dolore tempora.'),
        new Term('Artikel 04', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente animi fugiat doloribus, harum officia, odio voluptas nostrum asperiores deleniti, earum sint quos illo dolor cumque inventore nam et voluptatem optio quam! Aut dolor, ab expedita quaerat ducimus, corporis possimus quisquam vitae. Voluptate voluptatum aliquid illo libero aperiam ipsa ad adipisci, nostrum quod totam laudantium, recusandae quaerat labore consequatur omnis. Blanditiis, aliquam laborum asperiores, a ex esse necessitatibus vel ratione quod, minima delectus velit fugiat numquam quaerat sint recusandae accusamus praesentium.'),
        new Term('Artikel 05', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium sunt consequuntur facere magni odit quas labore nostrum, dicta, optio, ipsa necessitatibus iusto. Deleniti autem iusto maxime repellendus accusamus, accusantium, amet adipisci ab, itaque modi veritatis. Impedit qui voluptatum molestiae deserunt, fuga hic eligendi inventore magni eveniet animi sequi, voluptatem! Beatae magnam voluptatem amet explicabo reprehenderit aut tenetur rem vel non officiis dolorem accusantium, modi deleniti pariatur omnis ea aliquam voluptatum iusto obcaecati. Tempore, vitae ut perferendis placeat architecto doloribus dignissimos.'),
        new Term('Artikel 06', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum temporibus beatae doloremque, reiciendis magnam laudantium fuga autem, placeat, soluta, possimus saepe eius! Natus molestias ratione voluptate veniam ex hic blanditiis quia. Atque ad accusantium ea autem aliquam inventore quibusdam minima necessitatibus, assumenda molestias nihil a quasi molestiae esse ratione obcaecati, iure dignissimos nostrum fugiat vitae reprehenderit eveniet eius asperiores. Libero fugiat, voluptates vero possimus autem quia iste delectus cum iure impedit sed ipsam praesentium totam laboriosam, beatae unde accusamus! Expedita.'),
    )
));