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
            $_SESSION['attempts'] = 0;
        }


        /* If else check for quiz ending */
        echo "<div class='heading-result'>";
        echo "R E S U L T";
        echo "</div>";
        echo "<br>";

        echo "<div class='result-record'>";
        echo "<br>" . "You have completed the quiz" . "<br>";

    
        echo "Number of correct : " . $_SESSION['correct'] . "<br>";
        echo "Number of incorrect : " . $_SESSION['incorrect'] . "<br>";
        echo "Nickname : " . $_SESSION['nickname'] . "<br>";
        echo "Current quiz points : " . $_SESSION['score'] . "<br>";
        echo "Overall points : " . $_SESSION['overall_score'][$_SESSION['nickname']] . "<br>";


        // Display the start quiz button
        echo "<button onclick='selectTopic()' class='newquiz-btn btn-base'>Start a new quiz</button>";
        // Display the select options on click
        echo "<form action='next.php' method='post' id='topic' style='display:none;'>";
        echo "<select name='topic' id='topic' required class='my-input'>";
        echo "<option value='history'>History</option>";
        echo "<option value='geography'>Geography</option>";
        echo "</select>";
        echo "<br>";
        echo "<input type='submit' name='submit' value='Submit' class='submit-btn'>";
        echo "</form>";
        echo "<br>";



        echo "<button onclick='redirectLeaderBoard()' class='record-btn btn-base'>Go to Leaderboard</button>";
        echo "<br>";
        echo "<button id='exit-button' onclick='redirectQuiz()' class='exit-btn btn-base'>Exit</button>";
        echo "</div>";


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

    function selectTopic() {
        var form = document.getElementById("topic");
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }

    function redirectQuiz() {
        window.location.href = "quiz.php";
        exit();
    }

    function redirectLeaderBoard() {
        window.location.href = "LeaderBoard.php";
        exit();
    }

</script>

</html>