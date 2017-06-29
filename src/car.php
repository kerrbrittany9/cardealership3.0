<?php
class Car
{
    private $make_type;
    private $cost;
    private $mileage;
    private $condition;
    private $picture;

    function __construct($make_model, $price, $mileage, $condition, $image_location)
    {
        $this->make_type = $make_model;
        $this->cost = $price;
        $this->mileage = $mileage;
        $this->condition = $condition;
        $this->picture = $image_location;
    }

    function getPrice()
    {
        return $this->cost;
    }

    function getMiles()
    {
        return $this->mileage;
    }

    function getType()
    {
        return $this->make_type;
    }

    function getPicture()
    {
        return $this->picture;
    }

    function getCondition()
    {
        return $this->condition;
    }

    function save()
    {
        array_push($_SESSION['listings'], $this);
    }
    static function getAll()
    {
        return $_SESSION['listings'];
    }
}
?>
