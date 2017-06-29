<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    session_start();

    if (empty($_SESSION['listings'])) {
        $_SESSION['listings'] = array();
    }
    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    $app->get("/search", function() use ($app) {
        $cars = Car::getAll();
        $cars_matching_search = array();

        if (empty($cars_matching_search) == true) {
            foreach ($cars as $car) {
                if ($car->getMiles() < $_GET['distance'] && $car->getPrice() < $_GET['price']) {
                    array_push($cars_matching_search, $car);
                }
            }
        }
        return $app['twig']->render('search_results.html.twig', array('matching_car' => $cars_matching_search));
    });

    $app->post("/added_car", function() use ($app) {
        $sale = new Car($_POST['make-model'], $_POST['price'], $_POST['mileage'], $_POST['condition'], $_POST['picture']);
        $sale->save();
        return $app['twig']->render('addedcar.html.twig', array('car_sale' => $sale));
    });

    $app->get('/sellcar', function() use ($app) {
        return $app['twig']->render('sellcar.html.twig');
    });

    $app->get('/delete', function() use ($app) {
        Car::deleteAll();
        return $app['twig']->render('deleted.html.twig');
    });

        return $app;
  ?>
