<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Display Recipes</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="topnav">
            <p><a href="index.html">Home</a></p>
            <p><a href="recipe.html">Add A New Recipe</a></p>
            <p><a href="search.php">Look For A Recipe</a></p>
            <p><a href="display.php">Display All Recipes</a></p>
        </div>
        <h1>Recipes</h1>
        <?php
        $host = "peicloud.ca";
        $username = "u121";
        $password = "u121";
        $dbname = "db121";

        $conn = mysqli_connect($host,$username,$password,$dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM recipes";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            print("<p>Could not execute query</p>");
            die(mysqli_error($conn). "</body></html>");
        }
        
        
        echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">ID</font> </td> 
          <td> <font face="Arial">Recipe</font> </td> 
          <td> <font face="Arial">Ingredients</font> </td> 
          <td> <font face="Arial">Instructions</font> </td> 
          <td> <font face="Arial">Cooking Time</font> </td> 
      </tr>';


    while ($row = $result->fetch_assoc()) {
        $field1name = $row["ID"];
        $field2name = $row["Name"];
        $field3name = $row["Ingredients"];
        $field4name = $row["Instructions"];
        $field5name = $row["CookingTime"]; 

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td> 
              </tr>';
    }

        $conn->close();

        ?>
    
    </body>
</html>


