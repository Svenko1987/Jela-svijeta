<?php


class Category implements Item
{
    private $id;
    private $title;
    private $slug;

    /**
     * Category constructor.
     * @param $id
     * @param $title
     * @param $slug
     */
    public function __construct($id, $title, $slug)
    {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
}