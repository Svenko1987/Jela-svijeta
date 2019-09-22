<?php
include_once 'includes/includeAll.php';



$dbReader = new DatabaseReader($connection);

print_r($dbReader->getMealsForCategory("placeat","hr"));


