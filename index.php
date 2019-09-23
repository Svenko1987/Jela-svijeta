<?php
include 'includes/includeAll.php';

$connection = mysqli_connect("localhost", "root", "", "sven_jela")
OR die('Could not connect to database' . (mysqli_connect_error()));
$dbr = new DatabaseReader($connection);

$languages = $dbr->getLanguages();
$categories = $dbr->getCategorys();
$tags = $dbr->getTags();


?>
<html>
<body>

<form method="get" action="">
    <fieldset>
        <legend>Page</legend>
        Items per page <input type="text" name="per_page" value=""><br>
        Page numbe <input type="text" name="page" value="">
    </fieldset>
    <fieldset>
        <legend>Select language(required)</legend>
        <?php
        foreach ($languages as $value) {
            $title = $value->getTitle();
            $slug = $value->getSlug();
            echo "<input type=\"radio\" name=\"language\" value=\"$slug\">$title<br>";
        }
        ?>
    </fieldset>
    <fieldset>
        <legend>Select category</legend>
        <?php
        foreach ($categories as $value) {
            $title = $value->getTitle();
            $id = $value->getId();
            echo "<input type=\"radio\" name=\"category\" value=\"$id\">$title";
        }
        ?>
    </fieldset>
    <fieldset>
        <legend>Select tag</legend>
        <?php
        foreach ($tags as $value) {
            $title = $value->getTitle();
            $id = $value->getId();
            echo "<input type=\"radio\" name=\"tag\" value=\"$id\">$title";
        }
        ?>
    </fieldset>
    <legend>What to show</legend>
    <fieldset>
        <legend>Tags</legend>
        <input type="radio" name="showTag" value="true" checked="checked"> Yes
        <input type="radio" name="showTag" value="false"> No
    </fieldset>
    <fieldset>
        <legend>Categories</legend>
        <input type="radio" name="showCategory" value="true" checked="checked"> Yes
        <input type="radio" name="showCategory" value="false"> No
    </fieldset>
    <fieldset>
        <legend>Ingredients</legend>
        <input type="radio" name="showIngredient" value="true" checked="checked"> Yes
        <input type="radio" name="showIngredient" value="false"> No
    </fieldset>
    </fieldset>
    <fieldset>
        <legend>Diff time</legend>
        <input type="radio" name="diff_time" value="true" checked="checked"> Yes
        <input type="radio" name="diff_time" value="false"> No
    </fieldset>
    <input type="submit" value="Submit now">
</form>
</body>
</html>

<?php
$per_page = "";
$page = "";
$selectedLanguage = "eng";
$selectedTag = "";
$selectedCategory = "";
$showTag = true;
$showCategory = true;
$showIngredient = true;
$diff_time = false;
if (isset($_GET['language'])) {
    $selectedLanguage = $_GET['language'];
    if (isset($_GET['per_page'])) $per_page = $_GET['per_page'];
    if (isset($_GET['page'])) $page = $_GET['page'];
    if (isset($_GET['tag'])) $selectedTag = $_GET['tag'];
    if (isset($_GET['category'])) $selectedCategory = $_GET['category'];
    if (isset($_GET['showTag'])) $showTag = $_GET['showTag'];
    if (isset($_GET['showCategory'])) $showCategory = $_GET['showCategory'];
    if (isset($_GET['showIngredient'])) $showIngredient = $_GET['showIngredient'];
}

$showData = new ShowData($connection);

if (isset($_GET['category'])) {
    $showData->ShowForCategory($selectedLanguage, $selectedCategory, $diff_time, $showCategory, $showTag, $showIngredient);

}
if (isset($_GET['tag'])) {
    $showData->ShowForTag($selectedLanguage, $selectedTag, $diff_time, $showCategory, $showTag, $showIngredient);

}
?>


</body>
</html>







