<?php
include 'includes/includeAll.php';

class ShowData
{
    private $dbr;

    /**
     * ShowData constructor.
     */
    public function __construct($connection)
    {
        $this->dbr = new DatabaseReader($connection);
    }

    public function ShowForCategory($language, $category, $diff_time, $showCategory, $showTag, $showIngredient)
    {
        $meals = $this->dbr->getMealsForCategory($category, $language);

        echo "data : " . "<br>";
        foreach ($meals as $value) {
            echo "Meal id : " . $value->getId() . "<br>";
            echo "Meal title : " . $value->getTitle() . "<br>";
            echo "Meal description : " . $value->getDescription() . "<br>";
            if ($diff_time) echo "Meal status : " . $value->getStatus() . "<br>";
            if ($showCategory) {
                echo "<br>"."Category :"."<br>";
                $temp = $value->getCategory();
                echo "Id :" . $temp->getId() . "<br>";
                echo "Title :" . $temp->getTitle() . "<br>";
            }
            if ($showTag) {
                echo "<br>"."Tags :" . "<br>";
                foreach ($value->getTags() as $tag) {

                    echo "Id :" . $tag->getId() . "<br>";
                    echo "Title :" . $tag->getTitle() . "<br>";

                }
            }
            if ($showIngredient) {
                echo "<br>"."Ingredints :" . "<br>";
                foreach ($value->getIngredient() as $ingredient) {

                    echo "Id :" . $ingredient->getId() . "<br>";
                    echo "Title :" . $ingredient->getTitle() . "<br>";

                }
            }
            echo "<br><br>";
        }

    }
    public function ShowForTag($language, $tag, $diff_time, $showCategory, $showTag, $showIngredient)
    {
        $meals = $this->dbr->getMealsForTag($tag, $language);

        echo "data : " . "<br>";
        foreach ($meals as $value) {
            echo "Meal id : " . $value->getId() . "<br>";
            echo "Meal title : " . $value->getTitle() . "<br>";
            echo "Meal description : " . $value->getDescription() . "<br>";
            if ($diff_time) echo "Meal status : " . $value->getStatus() . "<br>";
            if ($showCategory) {
                echo "<br>"."Category :"."<br>";
                $temp = $value->getCategory();
                echo "Id :" . $temp->getId() . "<br>";
                echo "Title :" . $temp->getTitle() . "<br>";
            }
            if ($showTag) {
                echo "<br>"."Tags :" . "<br>";
                foreach ($value->getTags() as $tag) {

                    echo "Id :" . $tag->getId() . "<br>";
                    echo "Title :" . $tag->getTitle() . "<br>";

                }
            }
            if ($showIngredient) {
                echo "<br>"."Ingredints :" . "<br>";
                foreach ($value->getIngredient() as $ingredient) {

                    echo "Id :" . $ingredient->getId() . "<br>";
                    echo "Title :" . $ingredient->getTitle() . "<br>";

                }
            }
            echo "<br><br>";
        }

    }

}