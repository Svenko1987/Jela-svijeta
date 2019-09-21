<?php
include_once 'includes/includeAll.php';

$tag = new Tag("2", "tittt", "nekislug");
echo $tag->getId();
echo "<br>";

$dbReader = new DatabaseReader($connection);
//$meals=$dbReader->getMealsForTag(1,"english");

$array = $dbReader->getIngredientsForMeal(1);
foreach ($array as $value){
    print_r($value);
} ;


$arrayMealsTag = $dbReader->getMealsForTag(1, "english");
foreach ($arrayMealsTag as $value){
    print_r($value);
} ;
$arrayMealsCat = $dbReader->getMealsForCategory(3,"english");
foreach ($arrayMealsCat as $value){
    print_r($value);
} ;





