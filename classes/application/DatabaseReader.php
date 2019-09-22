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
    public function getMealsForTag($tag, $language)
    {
        $tagId=$this->getTagId($tag);
        $meals = array();
        $query = "SELECT * FROM meals LEFT JOIN meals_tag ON meals.id = meals_tag.meals_id WHERE meals_tag.tag_id ='$tagId' ";
        $response = mysqli_query($this->connection, $query);
        while ($row = mysqli_fetch_assoc($response)) {
            $categoryId = $this->getCategoryForMeal($row['id'], $language);
            $tags = $this->getTagsForMeal($row['id'], $language);
            $ingredients = $this->getIngredientsForMeal($row['id'], $language);
            $translationTitle = $this->getTranslation($language, $row['slug'], 'title');
            $translationDescription = $this->getTranslation($language, $row['slug'], 'title');
            $meal = new  Meal($row['id'], $translationTitle, $translationDescription, $row['status'], $row['slug'], $tags, $categoryId, $ingredients);
            array_push($meals, $meal);
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
        $categoryId=$this->getCategoryId($category);
        $meals = array();
        $query = "SELECT * FROM meals LEFT JOIN meals_category ON meals.id = meals_category.meals_id WHERE meals_category.category_id ='$categoryId' ";
        $response = mysqli_query($this->connection, $query);
        while ($row = mysqli_fetch_assoc($response)) {
            $categoryId = $this->getCategoryForMeal($row['id'], $language);
            $tags = $this->getTagsForMeal($row['id'], $language);
            $ingredients = $this->getIngredientsForMeal($row['id'], $language);
            $translationTitle = $this->getTranslation($language, $row['slug'], 'title');
            $translationDescription = $this->getTranslation($language, $row['slug'], 'title');
            $meal = new  Meal($row['id'], $translationTitle, $translationDescription, $row['status'], $row['slug'], $tags, $categoryId, $ingredients);
            array_push($meals, $meal);
        }
        return $meals;
    }
    public function getCategoryId($category){
        $query = "SELECT category.id FROM category WHERE  category.title='$category';";
        $response = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($response);
        $categoryId = $row['id'];
        return $categoryId;
    }
    public function getTagId($tag){
        $query = "SELECT tag.id FROM tag WHERE  tag.slug='simple';";
        $response = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_assoc($response);
        $tagId = $row['id'];
        return $tagId;

    }

    /**
     * Function returns array of object Tag
     * that are selected from database.
     * Condition for search is Meal
     */
    public function getTagsForMeal($mealId, $language)
    {
        $tags = array();
        $query = "SELECT tag.id, title, slug FROM tag LEFT JOIN meals_tag ON tag.id = meals_tag.tag_id WHERE meals_tag.meals_id = $mealId  ORDER BY title ASC;";
        $response = mysqli_query($this->connection, $query);
        while ($row = mysqli_fetch_assoc($response)) {
            $translation = $this->getTranslation($language, $row['slug'], 'title');
            $tag = new Tag($row['id'], $translation, $row['slug']);
            array_push($tags, $tag);
        }
        return $tags;
    }

    /**
     * Function returns array of object Ingredients
     * that are selected from database.
     * Condition for search is Meal
     */
    public function getIngredientsForMeal($mealId, $language)
    {
        $ingredients = array();

        $query = "SELECT ingredient.id, title, slug FROM ingredient LEFT JOIN meals_ingredient ON ingredient.id = meals_ingredient.ingredient_id WHERE meals_ingredient.meals_id =$mealId  ORDER BY title ASC;";
        $response = mysqli_query($this->connection, $query);
        while ($row = mysqli_fetch_assoc($response)) {
            $translation = $this->getTranslation($language, $row['slug'], 'title');
            $ingredient = new Ingredient($row['id'], $translation, $row['slug']);
            array_push($ingredients, $ingredient);
        }
        return $ingredients;
    }

    /**
     * Function returns category
     * that is selected from database.
     * Condition for search is Meal
     */
    public function getCategoryForMeal($mealId, $language)
    {
        $query = "SELECT * FROM category LEFT JOIN meals_category ON category.id = meals_category.category_id WHERE meals_id =$mealId;";
        $response = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($response);
        $translation = $this->getTranslation($language, $row['slug'], 'title');
        $category = new Category($row['id'], $translation, $row['slug']);
        return $category;
    }

    /**
     * Function returns translation
     * from wanted database.
     * Condition for search is language, slug and field.
     */

    public function getTranslation($language, $slug, $field)
    {
        $query = "SELECT $language.translation FROM $language WHERE  slug='$slug' AND field='$field';";
        $response = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($response);
        $translation = $row['translation'];
        return $translation;
    }
}
