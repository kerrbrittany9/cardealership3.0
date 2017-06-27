<?php
  date_default_timezone_set('America/Los_Angeles');
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/car.php";


  $app = new Silex\Application();

  $app->get("/", function() {
      return
      "<!DOCTYPE html>
      <html>
      <head>
          <title>Your Car Dealership's Homepage</title>
      </head>
      <body>
          <h1>Your Car Dealership</h1>
          <form action='/search'>
              </div><div class='form-group'>
                  <label for='price'>Preferred Price</label>
                  <input id='price' name='price' class='form-control' type='number'>
              </div><div class='form-group'>
                  <label for='distance'>Preferred mileage</label>
                  <input id='distance' name='distance' class='form-control' type='number'>
              </div>
              <button type='submit' class='btn'>Go!</button>
          </form>
          <ul>
          </ul>
      </body>
      </html>
          ";
      });

  $app->get("/search", function() {
        $porsche = new Car('2011 Porsche 911', 114991, 7864, 'Lightly used', 'porsche.jpg');
        $ford = new Car('2008 Ford F450', 80000, 14241, 'Brilliant', 'ford.jpeg');
        $lexus = new Car('2016 Lexus RX 350', 44700, 20000, 'Shiney', 'Lexus.png');
        $mercedes = new Car('2025 Mercedes Benz CLS550', 3990000, 37979, 'Fantastic', 'Mercedes.png');
        $warning = "";
        $header = "<!DOCTYPE html>
        <html>
        <head>
            <title>Your Car Dealership's Homepage</title>
        </head>
        <body>";
        $footer = "</body>
        </html>";
        $cars = array($porsche, $ford, $lexus, $mercedes);

        $cars_matching_search = array();

        foreach ($cars as $car) {
            if ($car->getMiles() < $_GET['distance'] && $_GET['price'] == ''){
                  array_push($cars_matching_search, $car);
            } elseif ($car->getPrice() < $_GET['price'] && $_GET['distance'] == '') {
                array_push($cars_matching_search, $car);
            } elseif ($car->getPrice() < $_GET['price'] && $car->getMiles() < $_GET['distance']) {
                  array_push($cars_matching_search, $car);
            }
        }
        if (empty($cars_matching_search)) {
            $warning = 'Your search has provided no results!';
        }
        $output = "";
        foreach ($cars_matching_search as $car) {
            $output = $output .
            "<p>" . $car->getType() . "</p> <br>
            <p> <img src = img/" . $car->getPicture() . "></p><br>
            <p> $" . $car->getPrice() . "</p><br>
            <p> Miles:" . $car->getMiles() . "</p><br>
            <p> Condition:" . $car->getStatus() . " </p><br>
            ";
        }
        return $header . $output . $footer;
    });
        return $app;
  ?>
