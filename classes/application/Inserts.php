<?php



include_once 'includes/DatabaseConnector.php';
require "vendor/autoload.php";

class Inserts
{
    private $connection;
    private $faker;

    /**
     * Inserts constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->faker = Faker\Factory::create();
    }

    public function insertIntoMeals($number)
    {
        for ($x = 1; $x <= $number; $x++) {
            $title = $this->faker->unique()->word;
            $slug = $this->faker->unique()->word;
            $description = $this->faker->sentence(10, true);
            $query = "INSERT INTO `meals` (`id`, `title`, `description`, `status`, `slug`) VALUES (NULL, '$title', '$description', 'created', '$slug')";
            $this->insertIntoMealsCategory($number ,$x);
            $this->insertIntoJoinTable($number,'meals_ingredient','ingredient', $x);
            $this->insertIntoJoinTable($number,'meals_tag','tag', $x);
            $this->insertIntoLanguages('eng', $title, $slug, 'title');
            $this->insertIntoLanguages('eng', $description, $slug, 'description');
            $this->insertIntoLanguages('ger', $title, $slug, 'title');
            $this->insertIntoLanguages('ger', $description, $slug, 'description');
            $this->insertIntoLanguages('hr', $title, $slug, 'title');
            $this->insertIntoLanguages('hr', $description, $slug, 'description');
            mysqli_query($this->connection, $query);
        }

    }

    public function insertBasic($number, $table)
    {
        for ($x = 1; $x <= $number; $x++) {
            $title = $this->faker->unique()->word;
            $slug = $this->faker->unique()->word;
            $query = "INSERT INTO `$table` (`id`, `title`, `slug`) VALUES (NULL, '$title', '$slug') ";
            $this->insertIntoLanguages('eng', $title, $slug, 'title');
            $this->insertIntoLanguages('ger', $title, $slug, 'title');
            $this->insertIntoLanguages('hr', $title, $slug, 'title');
            mysqli_query($this->connection, $query);
        }
    }

    public function insertIntoLanguages($table, $title, $slug, $field)
    {
        $translation = $title . "_" . $table;
        $query = "INSERT INTO `$table` (`id`, `field`, `slug`, `translation`) VALUES (NULL, '$field', '$slug', '$translation')";
        mysqli_query($this->connection, $query);
    }

    public function insertIntoJoinTable($number,$table,$field, $mealId)
    {
        $random = rand(1, $number );
        $fieldID = $field . "_id";
        $query = "INSERT INTO `$table` (`id`, `meals_id`, `$fieldID`) VALUES (NULL, '$mealId', '$random')";
        mysqli_query($this->connection, $query);

    }

    public function insertIntoMealsCategory($number,$mealId)
    {
        $haveCategory = rand(1, 100);
        if ($haveCategory>25) {
            $random = rand(1, $number);
            $query = "INSERT INTO `meals_category` (`id`, `meals_id`, `category_id`) VALUES (NULL, '$mealId', '$random')";
            mysqli_query($this->connection, $query);
        }

    }

    public function randomInsert($number)
    {
        for ($x = 1; $x <= $number; $x++) {
            $random = rand(1, $number);
            $this->insertIntoJoinTable($number,'meals_ingredient','title', $random);
            $random = rand(1, $number);
            $this->insertIntoJoinTable($number,'meals_tag','title', $random);

        }
    }

}