<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Quizzer</title>

    <style>
        h2 {
            padding: 10px;
        }

        th {
            padding: 10px;
        }

        td {
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Singapore General Knowledge Quiz</h1>
        </div>
    </header>
    <br>


    <div class="container">
        <?php

        // Read the content from the text file
        $getAsString = file_get_contents("LeaderBoard.txt");
        $lines = explode("\n", $getAsString);
        $newarray = array();
        foreach ($lines as $line) {
            if (!empty(trim($line))) {
                $score = json_decode($line, true);
                $newarray[] = $score;
            }
        }

        if (isset($_GET["sortbyscore"])) {

            function sortByDesc($a, $b)
            {
                return $b[1] - $a[1];
            }
        
            usort($newarray, "sortByDesc");
        
        }

         
        if (isset($_GET["sortbyname"])) {

            function sortByName($a, $b)
            {
                $a = preg_replace('/[^a-zA-Z0-9]+/', '', $a[0]);
                $b = preg_replace('/[^a-zA-Z0-9]+/', '', $b[0]);
                return strcmp(strtolower($a), strtolower($b));
            }

            usort($newarray, "sortByName");
        
        }
        
        // Display the table
        echo "<table class='table-record'>";
        echo "<div class='heading-topic'>";
        echo strtoupper("<h2>l e a d e r B o a r d</h2>");
        echo "</div>";
        echo "<br>";

        
        echo "<tr><th>Nickname</th><th>Score</th></tr>";
        foreach ($newarray as $score) {
            echo "<tr><td>" . $score[0] . "</td><td>" . $score[1] . "</td></tr>";
        }
        
        echo "</table>";
        echo "<br>";
        
        echo "<form action='LeaderBoard.php' method='GET'>";
        echo "<div class='sort-buttons'>";
        echo "<input type='submit' name='sortbyname' value='Sort by Name' class='sortname-btn'>";
        echo "<br>";
        echo "<input type='submit' name='sortbyscore' value='Sort by Score' class='sortscore-btn'>";
        echo "<br>";
        echo "<input type='submit' name='navigateback' value='Go Back' class='prev-btn'>";
        echo "</div>";
        echo "</form>";
       

        if (isset($_GET['navigateback'])) {
            header("Location:result.php");
            exit;
          }
       
        
        
        



        ?>
    </div>




    <br><br>
    <footer>
        <div class="container">
            Copyright &copy; 2023, Singapore General Knowledge Quiz
        </div>
    </footer>



</body>



</html>