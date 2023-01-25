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

        // Stores identifier in a session 
        if (isset($_POST['nickname'])) {
            $_SESSION['nickname'] = $_POST['nickname'];
        }

        // Create a new array to store the user's answers
        if (!isset($_SESSION['userinput'])) {
            $_SESSION['userinput'] = array();
        }


        /* Set default topic to history if not selected */
        if (!isset($_POST['topic'])) {
            $topic = "history";
        } else {
            $topic = $_POST['topic'];
        }

        /* Generate 5 qns, store it in a session */
        if (!isset($_SESSION['random_keys']) || $_SESSION['topic'] != $topic) {
            $random_keys = array_rand($quiz[$topic], 5);
            if (count($random_keys) != 5) {
                echo "Error in generating random questions please try again";
                exit;
            }
            $_SESSION['random_keys'] = $random_keys;
            $_SESSION['topic'] = $topic;

        }

        /* Set no. qns to 5 */
        $totalQuestions = 5;

        /* Set default score to 0 */
        if (!isset($_SESSION['score'])) {
            $_SESSION['score'] = 0;
        }


        /* If submitted curr qns not null, increment by 1, else default to 0 */
        if (isset($_POST['current_question'])) {
            $currentQuestion = $_POST['current_question'] + 1;
        } else {
            $currentQuestion = 0;
        }

        /* Set default answer to empty string */
        if (!isset($_POST['answer'])) {
            $_POST['answer'] = '';
        }

        /* Store user answer to curr qn in userinput session if submit is clicked. */
        if (isset($_POST['submit'])) {
            $_SESSION['userinput'][$currentQuestion] = $_POST['answer'];
        }

        /* Generate a random_key session */
        $random_keys = $_SESSION['random_keys'];

        /* Array session to store user's attempts */
        if (!isset($_SESSION['attempts'])) {
            $_SESSION['attempts'] = array();
        }

        


        /* If else check for quiz ending */
        if ($currentQuestion >= $totalQuestions) {

            echo "You have completed the quiz" . "<br>";

            $correct = 0;
            $incorrect = 0;

            if (!isset($_SESSION['attempts'][$_SESSION['nickname']])) {
                $_SESSION['attempts'][$_SESSION['nickname']] = 1;
            } else {
                $_SESSION['attempts'][$_SESSION['nickname']]++;
            }

            for ($i = 0; $i < 5; $i++) {
                $key = $random_keys[$i];
                $question = $quiz[$topic][$key];
                $correctAnswer = $question['answer'];
                //$_SESSION['userinput'][0] = " ";
                $userAnswer = $_SESSION['userinput'][$i + 1];

                //Checks user answer
                //var_dump($userAnswer);
        
                if (strtolower($userAnswer) == strtolower($correctAnswer)) {
                    echo "Question " . ($i + 1) . ": Correct" . "<br>";
                    $correct++;

                } else {
                    echo "Question " . ($i + 1) . ": Incorrect. Correct answer: " . $correctAnswer . "<br>";
                    $incorrect++;
                }
            }
            //Checks last qns answer
            //var_dump($_SESSION['userinput'][5]);
            $score = ($correct * 5) - ($incorrect * 3);
            echo "Well done! You have accumulated " . $score . " points in this attempt." . "<br>";
            

            $nickname = $_SESSION['nickname'];
            $leaderboard[] = array("nickname" => $nickname, "score" => $score, "Final score for current quiz:" => array('correct' => $correct, 'incorrect' => $incorrect), "attempts" => $_SESSION['attempts'][$_SESSION['nickname']]);

            // Writes into leaderboard text file
            file_put_contents('LeaderBoard.txt', json_encode($leaderboard), FILE_APPEND);

            // Retrieve data from text file
            $userData = json_decode(file_get_contents('LeaderBoard.txt'), true);
            //$overall_points = $userData[]['score'];

            //echo "Your overall points in the current attempt is: " . $overall_points;




        } else {
            $key = $random_keys[$currentQuestion];
            $question = $quiz[$topic][$key];

            echo "<form method='post' action='next.php' id='quizForm'>";

            echo "TOPIC: " . strtoupper($topic) . "<br>";

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
            echo "<input type='hidden' name='current_question' value='" . $currentQuestion . "'>";
            echo "<input type='hidden' name='topic' value='" . $topic . "'>";

            if (isset($_POST['answer'])) {

                $userAnswer = $_POST['answer'];
                $_SESSION['userinput'][$currentQuestion] = $userAnswer;

                /* Checks current question */
                //var_dump($currentQuestion);
        
                /* Checks user answer */
                //var_dump($userAnswer);
        
                // Compare the user's answer to the correct answer
                $key = $random_keys[$currentQuestion];
                $question = $quiz[$topic][$key];
                $correctAnswer = $question['answer'];
                if (strtolower($userAnswer) == strtolower($correctAnswer)) {

                    $_SESSION['score']++;
                }
                $currentQuestion++;
            }


            if ($currentQuestion < $totalQuestions) {
                echo "<input type='submit' value='Next'/>";
            }



            if ($currentQuestion == $totalQuestions) {
                echo "<form method='post' action='next.php'>";

                echo "Are you sure you want to submit? <br>";
                echo "<input type='submit' name='submit' value='Submit'>";
                echo "<input type='hidden' name='userinput[$currentQuestion]' value='" . $_POST['answer'] . "'>";

                echo "</form>";
                //exit;
            }
            echo "</form>";


            if (isset($_POST['current_question'])) {
                $prevQuestion = $_POST['current_question'] - 1;
            } else {
                $prevQuestion = 0;
            }

            if ($currentQuestion > 1) {
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