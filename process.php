<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Quizzer</title>
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
        include 'qna.php';
        function form_validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function generate_random_questions($topic)
        {
            global $quiz;
            $questions = $quiz[$topic];
            $randomQuestionKeys = array_rand($questions, 5);
            foreach ($randomQuestionKeys as $key) {
                echo $questions[$key]["question"] . "<br>";
                if (isset($questions[$key]["options"])) {
                    echo "A. " . $questions[$key]["options"][0] . "<br>";
                    echo "B. " . $questions[$key]["options"][1] . "<br>";
                    echo "C. " . $questions[$key]["options"][2] . "<br>";
                    echo "D. " . $questions[$key]["options"][3] . "<br>";
                } else {
                    echo "<input type='text' name='answer' placeholder='Type your answer here'>";
                }
                echo "<br>";
            }
        }

        if (isset($_POST['submit'])) {
            if (isset($_POST["nickname"]) && !empty($_POST["nickname"]) && isset($_POST["topic"]) && !empty($_POST["topic"])) {
                $nickname = form_validate($_POST["nickname"]);
                $topic = form_validate($_POST["topic"]);
                echo "Welcome " . $nickname . "<br>";
                generate_random_questions($topic);
            }
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