<body>
    <header>
    <link rel="stylesheet" type="text/css" href="style.css">
        <div class="container">
            <h1>Singapore General Knowledge Quiz</h1>
        </div>
    </header>
    <br>

    <div class="container">
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $databasename = "quiz_db";

        // Stores a SQL database connection into $conn using mysqli_connect function
        $conn = mysqli_connect(
            $servername,
            $username,
            $password,
            $databasename
        );

        // Checks for connection error
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Access data from form using POST method and store it in variables 
        $topic = $_POST['topic'];
        $nickname = $_POST['nickname'];
       

        // Check if the nickname already exists in the "users" table
        $check_query = "SELECT * FROM users WHERE nickname='$nickname'";
        $check_name_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_name_result) > 0) {

        } else {
            // Nickname does not exist, insert it
            $sql = "INSERT INTO users (nickname) VALUES ('$nickname')";
            if (mysqli_query($conn, $sql)) {
                echo "Records inserted successfully.";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        }


        
        // Fetch random 5 questions data of selected topic
        $rand_question_query = "SELECT * FROM `questions` WHERE topic='$topic' ORDER BY RAND() LIMIT 5;";
        $result = mysqli_query($conn,  $rand_question_query);

        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            echo $nickname . "<br><br>";

            // Loop through the results
            if ($row = $result->fetch_assoc()) {
                // Display the question
                echo $row['question'] . "<br>";

                // Check the question type
                if ($row['question_type'] == "mcq") {
                    // Display radio buttons for the choices
                    echo "<input type='radio' name='choice' value='" . $row['choice1'] . "'> " . $row['choice1'] . "<br>";
                    echo "<input type='radio' name='choice' value='" . $row['choice2'] . "'> " . $row['choice2'] . "<br>";
                    echo "<input type='radio' name='choice' value='" . $row['choice3'] . "'> " . $row['choice3'] . "<br>";
                    echo "<input type='radio' name='choice' value='" . $row['choice4'] . "'> " . $row['choice4'] . "<br>";
                } else {
                    // Display an input field for the answer
                    echo "<input type='text' name='answer'><br>";
                }
            }
        } else {
            echo "No questions found.";
        }



        $conn->close();

        ?>
    </div>


    <br><br>
    <footer>
        <div class="container">
            Copyright &copy; 2023, Singapore General Knowledge Quiz
        </div>
    </footer>



</body>