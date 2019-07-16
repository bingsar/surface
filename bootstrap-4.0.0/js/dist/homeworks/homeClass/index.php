<?php

 class Car {

     public $topSpeed;
     public $horsePower;

     function moveForward($topSpeed){
         echo $this->topSpeed = $topSpeed;
 }

 }

 class TV {

    public $resolution;
    public $os;

    function playChannel_MTV() {
        echo 'В эфире канал MTV';
    }
     function chooseOs($os) {
         echo $this->os = $os;
     }
 }

 class Pen {

    public $type;
    public $material;

    function write(){
        echo 'Напишите текст'
    }

 }

 class Duck {

    public $geo;
    public $color;

    function multiply(){
        echo 'Внимание! Утка снесла яйцо';
    }

 }

 class Product {

    public $title;
    public $price;

    function getPrice(){
        $this->price;
    }

 }

$bently = new Car();
$ford = new Car();

$sony = new TV();
$samsung = new TV();

$bic = new Pen();
$parker = new Pen();

$eastDuck = new Duck();
$westDuck = new Duck();

$obFive = new Product();
$zero = new Product();



