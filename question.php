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
            
            echo "<form method='post' action='next.php'>";
            echo "TOPIC: ".strtoupper($topic);
            $_SESSION['topic'] = $topic;

            $currentQuestion = 1; // Initialize current question number
            $totalQuestions = 5; // Total number of questions
            
            
            
                
                echo "<form method='post' action='next.php'>";

                // Select 5 random keys from the $quiz[$topic] array
                $random_keys = array_rand($quiz[$topic], 5);

                // Store the selected keys in a session variable
                $_SESSION['random_keys'] = $random_keys;

                // Retrieve the current question from the session variable
                $key = $_SESSION['random_keys'][$currentQuestion-1];
                $question = $quiz[$topic][$key];
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
                // Add a hidden input field to store the current question number
                echo "<input type='text' name='current_question' value='".($currentQuestion + 1)."'>";

                // Retrieve the current question number from the hidden input field
                if(isset($_POST['current_question'])) {
                    $currentQuestion = $_POST['current_question'];
                }

                if($currentQuestion <= $totalQuestions){
                    echo "<input type='submit' value='Next'/>";
                }else{
                    echo "You have completed the quiz";
                }

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