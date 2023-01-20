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
        session_start();
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $topic = $_POST['topic'];
            echo "<div class='container'>";

            $five_questions = array_rand($quiz[$topic], 5);
            $_SESSION['questions'] = $five_questions;
            $_SESSION['question_number'] = 1;
            
            $question = $quiz[$topic][$_SESSION['questions'][$_SESSION['question_number'] - 1]];
            echo "<div>Question ".$_SESSION['question_number']." of 5</div>";
            echo "<p class='question'>" . $question['question'] . "</p>";
            echo "<form method='post' action='question.php'>";
            if (array_key_exists('options', $question)) {
              echo "<ul class='choices'>";
              foreach ($question['options'] as $option) {
                echo "<li><input name='choice' type='radio' value='" . $option . "'>" . $option . "</li>";
              }
              echo "</ul>";
            } else {
              echo "<input type='text' name='answer' required>";
            }
            echo "<input type='submit' value='Submit' />";
            echo "</form>";
            $_SESSION['question_number']++;

            if ($_SESSION['question_number'] <= 5) {
                // Display question
            } else {
                echo "Quiz finished!";
            }
            


            echo "</div>";
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