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
    </div>

    <br><br>
    <footer>
        <div class="container">
            Copyright &copy; 2023, Singapore General Knowledge Quiz
        </div>
    </footer>

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

</body>
</html>