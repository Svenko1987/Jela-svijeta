<?php


class Dish implements Item
{
    private $id;
    private $title;
    private $description;
    private $status;

    /**
     * Dish constructor.
     * @param $id
     * @param $title
     * @param $description
     * @param $status
     */
    public function __construct($id, $title, $description, $status)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
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
        $this->id=$id;
    }

    public function setTitle($title)
    {
        $this->title=$title;
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