<!DOCTYPE html>
<html>
    <head>
        <title>Search</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="topnav">
            <p><a href="index.html">Home</a></p>
            <p><a href="recipe.html">Add A New Recipe</a></p>
            <p><a href="search.php">Look For A Recipe</a></p>
            <p><a href="display.php">Display All Recipes</a></p>
        </div>
        
        
        <h3 class="header"> Enter the name of the recipe you're looking for.</h3>
        <div class="form">
        <form action="search.php" method="post">
          <label for="query">Recipe information:</label><br><br>
          <input type="text" id="query" name="query"><br><br>
          <input type="submit" value="Submit">
        </form>
        <!-- </div> -->
        
        <?php
            // Connect to the database
            // Establish database connection
            $localhost = "peicloud.ca";
            $username = "u121";
            $password = "u121";
            $dbname = "recipes";
            $db = mysqli_connect( "peicloud.ca", "u121", "u121", "db121");

            // Retrieve the search query from the form submission
            if(isset($_POST['query'])) {
            $query = $_POST['query'];

            // Search the database for matching recipes
            $sql = "SELECT * FROM recipes WHERE Name LIKE '%$query%'";
            $result = $db->query($sql);

            // Display the search results
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                // Output the recipe information
  
                $field2name = $row["Name"];
                $field3name = $row["Ingredients"];
                $field4name = $row["Instructions"];
                $field5name = $row["CookingTime"]; 

                echo '
                        <h3>Recipe</h3>
                        <p>'.$field2name.'</p>
                        <h3>Ingredients</h3>
                        <p>'.$field3name.'</p>
                        <h3>Instructions</h3>
                        <p>'.$field4name.'</p>
                        <h3>Cooking Time</h3>
                        <p>'.$field5name.'</p></div>';
                      }
            } else {
              echo "No matching recipes found.</div>";
            }

            // Close the database connection
            $db->close();
          }
            ?>
          
      </body>
  </html>

