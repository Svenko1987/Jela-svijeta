<?php


interface Item
{
    public function setId($id);
    public function setTitle($title);
    public function setSlug($slug);
    public function getId();
    public function getTitle();
    public function getSlug();


}