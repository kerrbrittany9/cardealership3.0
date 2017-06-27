<?php
class Car
{
    private $make_type;
    private $cost;
    private $distance;
    private $status;
    private $picture;

    function __construct($make_model, $price, $miles, $condition, $image_location)
    {
        $this->make_type = $make_model;
        $this->cost = $price;
        $this->distance = $miles;
        $this->status = $condition;
        $this->picture = $image_location;
    }

    function getPrice()
    {
        return $this->cost;
    }

    function getMiles()
    {
        return $this->distance;
    }

    function getType()
    {
        return $this->make_type;
    }

    function getPicture()
    {
        return $this->picture;
    }

    function getStatus()
    {
        return $this->status;
    }


}
?>
