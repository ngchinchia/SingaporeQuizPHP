<body>
    <header>
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

        // CREATE CONNECTION
        $conn = mysqli_connect(
            $servername,
            $username,
            $password,
            $databasename
        );

        // GET CONNECTION ERRORS
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // SQL QUERY
        $topic = $_POST['topic'];
        $query = "SELECT * FROM `questions` WHERE topic='$topic' ORDER BY RAND() LIMIT 5;";

        // FETCHING DATA FROM DATABASE
        $result = mysqli_query($conn, $query);

        // Check if there are any results
        if ($result->num_rows > 0) {
            // Loop through the results
            while ($row = $result->fetch_assoc()) {
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