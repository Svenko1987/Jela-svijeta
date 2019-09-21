<?php


class Dish implements Item
{
    private $id;
    private $title;
    private $description;
    private $status;
    private $slug;
    private $tags = array();
    private $categories = array();
    private $ingredient = array();

    /**
     * Dish constructor.
     * @param $id
     * @param $title
     * @param $description
     * @param $status
     * @param array $tags
     * @param array $categories
     * @param array $ingredient
     */
    public function __construct($id, $title, $description, $status, $slug, array $tags, array $categories, array $ingredient)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->slug = $slug;
        $this->tags = $tags;
        $this->categories = $categories;
        $this->ingredient = $ingredient;

    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return array
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * @param array $ingredient
     */
    public function setIngredient($ingredient)
    {
        $this->ingredient = $ingredient;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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

    public function setSlug($slug)
    {
        $this->$slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}