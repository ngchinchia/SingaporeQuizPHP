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
        session_start();
        include 'qna.php';
        $totalQuestions = 5;
        $totalKeys = count($_SESSION['random_keys']);
        $currentQuestion = $_POST['current_question'] + 1;
        $topic = $_SESSION['topic'];
        $random_keys = $_SESSION['random_keys'];

        if ($currentQuestion > $totalQuestions || $currentQuestion > $totalKeys) {
            echo "You have completed the quiz";
        } else {
            $key = $random_keys[$currentQuestion - 1];
            $question = $quiz[$topic][$key];
            echo "<div class='container'>";
            echo "<form method='post' action='next.php'>";
            echo "TOPIC: " . strtoupper($topic);
            echo "<p class='question'>" . $question['question'] . "</p>";
            if (array_key_exists('options', $question)) {
                echo "<ul class='choices'>";
                foreach ($question['options'] as $option) {
                    echo "<li><input type='radio' name='answer' value='" . $option . "'>" . $option . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<input type='text' name='answer' required>";
            }
            echo "<input type='text' name='current_question' value='" . ($currentQuestion) . "'>";
            echo "<input type='submit' value='Next'/>";
            echo "</form>";
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