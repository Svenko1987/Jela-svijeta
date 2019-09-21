<?php


class DatabaseReader
{
    private $connection;

    /**
     * DatabaseReader constructor.
     * @param $connector
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Function returns array of object Meal
     * that are selected from database.
     * Condition for search is Tag
     */
        public function getMealsForTag($tagID, $language)
    {
        $meals = array();

        if ($language == "english") {
            $query = "SELECT * FROM meals LEFT JOIN meals_tag ON meals.id = meals_tag.meals_id WHERE meals_tag.tag_id =$tagID ";
            $response = mysqli_query($this->connection, $query);
            while ($row = mysqli_fetch_assoc($response)) {
                $categoryId = $this->getCategoryForMeal($row['id']);
                $tags = $this->getTagsForMeal($row['id']);
                $ingredients = $this->getIngredientsForMeal($row['id']);
                $meal = new  Meal($row['id'], $row['title'], $row['description'], $row['status'], $row['slug'], $tags, $categoryId, $ingredients);
                array_push($meals, $meal);
            }
        }
        return $meals;
    }

    /**
     * Function returns array of object Meal
     * that are selected from database.
     * Condition for search is Category
     */
    public function getMealsForCategory($category, $language)
    {
        $meals = array();

        if ($language == "english") {
            $query = "SELECT meals.id, title, description, status, slug FROM meals LEFT JOIN meals_category ON meals.id = meals_category.meals_id WHERE meals_category.category_id = $category ;";
            $response = mysqli_query($this->connection, $query);
            while ($row = mysqli_fetch_assoc($response)) {
                $categoryId = $this->getCategoryForMeal($row['id']);
                $tags = $this->getTagsForMeal($row['id']);
                $ingredients = $this->getIngredientsForMeal($row['id']);
                $meal = new  Meal($row['id'], $row['title'], $row['description'], $row['status'], $row['slug'], $tags, $categoryId, $ingredients);
                array_push($meals, $meal);
            }
        }
        return $meals;
    }

    /**
     * Function returns array of object Tag
     * that are selected from database.
     * Condition for search is Meal
     */
    public function getTagsForMeal($mealId)
    {
        $tags = array();

        $query = "SELECT tag.id, title, slug FROM tag LEFT JOIN meals_tag ON tag.id = meals_tag.tag_id WHERE meals_tag.meals_id = $mealId  ORDER BY title ASC;";
        $response = mysqli_query($this->connection, $query);
        while ($row = mysqli_fetch_assoc($response)) {
            $tag = new Tag($row['id'], $row['title'], $row['slug']);
            array_push($tags, $tag);
        }
        return $tags;
    }

    /**
     * Function returns array of object Ingredients
     * that are selected from database.
     * Condition for search is Meal
     */
    public function getIngredientsForMeal($mealId)
    {
        $ingredients = array();

        $query = "SELECT ingredient.id, title, slug FROM ingredient LEFT JOIN meals_ingredient ON ingredient.id = meals_ingredient.ingredient_id WHERE meals_ingredient.meals_id =$mealId  ORDER BY title ASC;";
        $response = mysqli_query($this->connection, $query);
        while ($row = mysqli_fetch_assoc($response)) {
            $ingredient = new Ingredient($row['id'], $row['title'], $row['slug']);
            array_push($ingredients, $ingredient);
        }
        return $ingredients;
    }

    /**
     * Function returns category
     * that is selected from database.
     * Condition for search is Meal
     */
    public function getCategoryForMeal($mealId)
    {
        $query = "SELECT category.id FROM category LEFT JOIN meals_category ON category.id = meals_category.category_id WHERE meals_id =$mealId;";
        $response = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($response);
        $categoryId = $row['id'];
        return $categoryId;
    }
}
