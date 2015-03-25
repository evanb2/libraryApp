<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Patron.php";
    require_once __DIR__."/../src/Book.php";

    $app = new Silex\Application();

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.twig');
    });

    //READ all patrons
    $app->get("/patrons", function() use ($app) {
        return $app['twig']->render('patrons.twig', array('patrons' => Patron::getAll()));
    });

    //READ all books
    $app->get("/books", function() use ($app) {
        return $app['twig']->render('books.twig', array('books' => Book::getAll()));
    });

    //READ singular book
    $app->get("/books/{id}", function($id) use ($app) {
        $book = Book::find($id);
        return $app['twig']->render('books.twig', array('book' => $book, 'patrons' => $book->getPatrons(), 'all_patrons' => Patron::getAll()));
    });

    //READ singular patron
    $app->get("/patrons/{id}", function($id) use ($app) {
        $patron = Patron::find($id);
        return $app['twig']->render('patron.twig', array('patron' => $patron, 'books' => $patron->getBooks(), 'all_books' => Book::getAll()));
    });

    //READ edit forms
    // $app->get("/books")

    //CREATE book
    $app->post("/books", function() use ($app) {
        $author = $_POST['author'];
        $title = $_POST['title'];
        $book = new Book($author, $title);
        $book->save();
        return $app['twig']->render('books.twig', array('books' => Book::getAll()));
    });

    //CREATE patron
    $app->post("/patrons", function() use ($app) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $patron = new Patron($name, $phone);
        $patron->save();
        return $app['twig']->render('patrons.twig', array('patrons' => Patron::getAll()));
    });

    //CREATE add patrons to books
    // $app->post("/add_patrons", function () use ($app) {
    //     $book = Book::find($_POST['book_id']);
    //     $patron = Patron::find($_POST['patron_id']);
    //     $book->addPatron($patron);
    //     return $app['twig']->render('book.twig', array('book' => $book, 'books' =>
    //         Book::getAll(), 'patrons' => $book->getPatrons(), 'all_patrons' => Patron::getAll()));
    // });

    //CREATE add books to patrons
    $app->post("/add_books", function() use ($app) {
        $book = Book::find($_POST['book_id']);
        $patron = Patron::find($_POST['patron_id']);
        $patron->addBook($book);
        return $app['twig']->render('patron.twig', array('patron' => $patron, 'patrons' =>
            Patron::getAll(), 'books' => $patron->getBooks(), 'all_books' => Book::getAll()));
    });

    //DELETE all patrons
    $app->post("/delete_patrons", function() use ($app) {
        Patron::deleteAll();
        return $app['twig']->render('index.twig');
    });

    //DELETE all books
    $app->post("/delete_books", function() use ($app) {
        Book::deleteAll();
        return $app['twig']->render('index.twig');
    });

    //DELETE singular patron

    //DELETE singular book

    //PATCH routes

    return $app;

?>
