<?php
include 'classes/application/Inserts.php';
include_once 'includes/DatabaseConnector.php';
include_once 'vendor/autoload.php';


$insert=new Inserts($connection);
$numberOfEntries=20;

$insert->insertIntoMeals($numberOfEntries);
$insert->insertBasic($numberOfEntries,'category');
$insert->insertBasic($numberOfEntries,'tag');
$insert->insertBasic($numberOfEntries,'ingredient');
$insert->randomInsert($numberOfEntries);
