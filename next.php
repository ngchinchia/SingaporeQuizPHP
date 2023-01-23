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

        if (!isset($_POST['topic'])) {
            $topic = "history";
        } else {
            $topic = $_POST['topic'];
        }
       
        // If 5 random qns null, store it in a session 
        if (!isset($_SESSION['random_keys']) || $_SESSION['topic'] != $topic) {
            $random_keys = array_rand($quiz[$topic], 5);
            if (count($random_keys) != 5) {
                echo "Error in generating random questions please try again";
                exit;
            }
                $_SESSION['random_keys'] = $random_keys;
                $_SESSION['topic'] = $topic;
            
        }

        $totalQuestions = 5;
        $totalKeys = count($_SESSION['random_keys']);

        if (!isset($_SESSION['score'])) {
            $_SESSION['score'] = 0;
        }


        // If submitted curr qns not null, increment by 1
        if (isset($_POST['current_question'])) {
            $currentQuestion = $_POST['current_question'] + 1;
        } else {
            $currentQuestion = 0;
        }

        $random_keys = $_SESSION['random_keys'];
        $arr = array();

        if ($currentQuestion >= $totalQuestions) {
            if (isset($_SESSION['score'])) {
                echo "You have completed the quiz" . "<br>";
                echo "Your score is: " . $_SESSION['score'] . " out of " . $totalQuestions. "<br>";

                for ($i = 0; $i < $totalQuestions; $i++) {
                    $key = $random_keys[$i];
                    $question = $quiz[$topic][$key];
                    $correctAnswer = $question['answer'];
                    $userAnswer = $_SESSION['userAnswers'][$i];
        
                    if ($userAnswer == $correctAnswer) {
                        echo "Question " . ($i + 1) . ": Correct" . "<br>";
                    } else {
                        echo "Question " . ($i + 1) . ": Incorrect. Correct answer: " . $correctAnswer . "<br>";
                    }
                }
                
            }
        } else {
            $key = $random_keys[$currentQuestion];
            $question = $quiz[$topic][$key];

            echo "<form method='post' action='next.php' id='quizForm'>";

            echo "TOPIC: " . strtoupper($topic). "<br>";
            
            echo "<p class='question'>" . $question['question'] . "</p>";
            if (array_key_exists('options', $question)) {
                echo "<ul class='choices'>";
                foreach ($question['options'] as $option) {
                    echo "<li><input type='radio' name='answer' value='" . $option . "' id='answer_option' required>" . $option . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<input type='text' name='answer' id='answer_text' required>";
            }
            echo "<input type='text' name='current_question' value='" . $currentQuestion . "'>";
            echo "<input type='text' name='topic' value='" . $topic . "'>";
            
           
             // Create a new array to store the user's answers
    if (!isset($_SESSION['userAnswers'])) {
        $_SESSION['userAnswers'] = array();
    }

    if (isset($_POST['answer'])) {
        $userAnswer = $_POST['answer'];
        $currentQuestion = $_POST['current_question'];
        $_SESSION['userAnswers'][$currentQuestion] = $userAnswer;

        // Compare the user's answer to the correct answer
        $key = $random_keys[$currentQuestion];
        $question = $quiz[$topic][$key];
        $correctAnswer = $question['answer'];
        if ($userAnswer == $correctAnswer) {
            $_SESSION['score']++;
        }
    }
           
            echo "<input type='submit' value='Next'/>";
            echo "</form>";
           

            if (isset($_POST['current_question'])) {
                $prevQuestion = $_POST['current_question'] - 1;
            } else {
                $prevQuestion = 0;
            }

            if ($currentQuestion > 0) {
                echo "<form method='post' action='next.php'>";
                echo "<input type='hidden' name='topic' value='" . $topic . "'>";
                echo "<input type='hidden' name='current_question' value='" . $prevQuestion . "'>";
                echo "<input type='submit' value='Previous'/>";
                echo "</form>";
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

<script>
    
    </script>

</html>