<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    session_start();

    if (empty($_SESSION['listings'])) {
        $_SESSION['listings'] = array();
    }

    // use Symfony\Component\Debug\Debug;
    // Debug::enable();

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig', array('listings' => Car::getAll()));
    });

    $app->get("/search", function() use ($app) {
        $porsche = new Car('2011 Porsche 911', 114991, 7864, 'Lightly used', '/../img/porsche.jpg');
        $ford = new Car('2008 Ford F450', 80000, 14241, 'Brilliant', '/../img/ford.jpeg');
        $lexus = new Car('2016 Lexus RX 350', 44700, 20000, 'Shiney', '/../img/Lexus.png');
        $mercedes = new Car('2025 Mercedes Benz CLS550', 3990000, 37979, 'Fantastic', '/../img/Mercedes.png');

        $cars = array($porsche, $ford, $lexus, $mercedes);
        $cars_matching_search = array();

        if (empty($cars_matching_search) == true) {
            foreach ($cars as $car) {
                if ($car->getMiles() < $_GET['distance'] && $car->getPrice() < $_GET['price']) {
                      array_push($cars_matching_search, $car);
                }
            }
        }
        // var_dump($cars_matching_search);
        return $app['twig']->render('search_results.html.twig', array('matching_car' => $cars_matching_search));
    });
        return $app;
  ?>
