<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results</title>
</head>
<body>
    <h1>Book Search Results</h1>
    <?php
    // TODO 1: Create short variable names.
    $searchtype=$_POST['searchtype'];
    $searchterm=$_POST['searchterm'];

    // TODO 2: Check and filter data coming from the user.
    if(isset($searchtype)&&
    isset($searchterm)){

    // TODO 3: Setup a connection to the appropriate database.
    $conn=new mysqli('localhost','ng','password','publications');
    if($conn->connect_error) die("Fatal Error");

    // TODO 4: Query the database.
    $query="SELECT * FROM catalogs WHERE $searchtype LIKE '%$searchterm%'";
    $result=$conn->query($query);
    }

    // TODO 5: Retrieve the results.
    $rows = $result->num_rows;
    

    // TODO 6: Display the results back to user.
    if(!$rows) {
        echo "Item cannnot be found, please try again!";
    }   
    else{
        for($j = 0;$j < $rows;++$j)
        {
            $row = $result->fetch_array(MYSQLI_NUM);

            $r0 = htmlspecialchars($row[0]);
            $r1 = htmlspecialchars($row[1]);
            $r2 = htmlspecialchars($row[2]);
            $r3 = htmlspecialchars($row[3]);

            echo "
            ISBN: $r0 <br>
            Author: $r1 <br>
            Title: $r2 <br>
            Price: $r3 <br>
            <br>";
        }
    }
    // TODO 7: Disconnecting from the database.
    $result->close();
    $conn->close();

    ?>
</body>
</html>