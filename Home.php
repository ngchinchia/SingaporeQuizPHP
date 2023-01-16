<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
</head>

<body>
    
    <form action="Home.php" method="post" onsubmit="return validateForm()">
        
        <h1>Please insert your nickname:</h1>
        <input type="text" name="nickname" id="nickname">
        <br><br>

        <h2>Please choose a topic:</h2>
        <input type="radio" name="topic" value="Singapore History"> Singapore History
        <input type="radio" name="topic" value="Singapore Geography"> Singapore Geography
        <br><br>

        <input type="submit" name="submit" value="Start Quiz">
    </form>

    <?php
        session_start();
        $history_questions = array(
            "In what year did Singapore gain independence?",
            "Who is the first Prime Minister of Singapore?",
            "What was the name of Singapore before it became a British colony?",
            "When did Singapore become a republic?",
            "Who founded modern Singapore?"
        );

        $geography_questions = array(
            "What is the highest point in Singapore?",
            "What is the name of the river that runs through Singapore?",
            "How many main islands make up Singapore?",
            "What is the name of Singapore's largest island?",
            "What is the name of Singapore's famous waterfront area?"
        );

    if(isset($_POST['submit'])){            // $_POST superglobal checks if form is submitted
        $nickname = $_POST['nickname'];
        $topic = $_POST['topic'];

        if($topic == "Singapore History"){
            $_SESSION['nickname'] = $nickname;
            $_SESSION['topic'] = $topic;
            $_SESSION['questions'] = $history_questions;
           
            header('Location: quiz.php');
            exit();
        } else if ($topic == "Singapore Geography") {
            $_SESSION['nickname'] = $nickname;
            $_SESSION['topic'] = $topic;
            $_SESSION['questions'] = $geography_questions;
           
            header('Location: quiz.php');
            exit();
        }
    }
    ?>

    

    <script>
        // Function to validate user entered a name 
        function validateForm() {

            var name = document.getElementById("nickname").value;

            if (name == "") {
                alert("Please fill in the name!");
                if (event) event.preventDefault();
            }
        }
    </script>

    <br><br>

    
   
</body>


</html>