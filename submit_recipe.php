<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Submit Recipe</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <style>
            body {
                background-color: bisque;
            }
            h1 {
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div class="topnav">
            <p><a href="index.html">Home</a></p>
            <p><a href="recipe.html">Add A New Recipe</a></p>
            <p><a href="search.php">Look For A Recipe</a></p>
            <p><a href="display.php">Display All Recipes</a></p>
        </div>
        <h1>Submit A Recipe</h1>
        <div class="form">
        <form action='submit_recipe.php' method='post'>
        <p>Please fill in all fields and click submit.</p>
        <label for="name">Recipe:</label>
        <input type="text" name="name" required><br><br>
        
        <label for="ingredients">Ingredients:</label><br>
        <textarea name="ingredients" rows="5" cols="40" required></textarea><br><br>
        
        <label for="instructions">Instructions:</label><br>
        <textarea name="instructions" rows="10" cols="40" required></textarea><br><br>
        
        <label for="cooking_time">Cooking Time (in minutes):</label>
        <input type="number" name="cooking_time" required><br><br>
        
        <input type="submit" name = 'submit' value="Submit">
        </form>
        </div>

        <?php
        $localhost = "peicloud.ca";
        $username = "u121";
        $password = "u121";
        $dbname = "db121";
        $conn = mysqli_connect($localhost, $username, $password, $dbname);

        // Check for errors
        if (mysqli_connect_errno()) {
            echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
            exit();
        }

        // check if the form was submitted

        $name =  isset($_POST[ "name" ]) ? $_POST[ "name" ] : "";
        $ingredients =  isset($_POST[ "ingredients" ]) ? $_POST[ "ingredients" ] : "";
        $instructions =  isset($_POST[ "instructions" ]) ? $_POST[ "instructions" ] : "";
        $cooking_time =  isset($_POST[ "cooking_time" ]) ? $_POST[ "cooking_time" ] : "";
        $iserror = false;
        $formerrors = 
        array("nameerror" => false, "ingredientserror" => false, "instructionserror" => false,
        "cooking_timeerror" => false);

        $inputlist = 
        array("name" => "Name", "ingredients" => "Ingredients", "cooking_time" => "Cooking Time");

        if (isset($_POST["submit"])) {
            if ($name == "") {
                $formerrors["nameerror"] = true;
                $iserror = true;
            }
            if ($ingredients == "") {
                $formerrors["ingredientserror"] = true;
                $iserror = true;
            }
            if ($instructions == "") {
                $formerrors["instructionserror"] = true;
                $iserror = true;
            }
            if ($cooking_time == "") {
                $formerrors["cooking_timeerror"] = true;
                $iserror = true;
            }
        }

        if(!$iserror) {
          $query = "INSERT INTO recipes (Name, Ingredients, Instructions, CookingTime) " .
          "VALUES ('$name', '$ingredients', '$instructions', '$cooking_time')"; 
        }

        if (!($database = mysqli_connect("peicloud.ca", "u121", "u121", "db121")))
          die("<p>Could not connect to database</p>");

        if (!($result = mysqli_query($database, $query))) {
          echo ("<p>Could not execute query!</p>");
          die(mysqli_error($database));
        }

        mysqli_close($database);


        if($iserror) {
          print("<p class = 'error'>Fields with * need to be filled in properly.</p>");
        }


        // Close the connection
        mysqli_close($conn);
        ?>
        
    </body>
</html>