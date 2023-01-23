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
        <form action="next.php" method="post">
            <label for="nickname">Nickname:</label>
            <input type="text" name="nickname" id="nickname" required>

            <label for="topic">Topic:</label>
            <select name="topic" id="topic" required>
                <option value="history">History</option>
                <option value="geography">Geography</option>
            </select>

            <input type="submit" name="submit" value="Submit">
        </form>

    </div>




    <br><br>
    <footer>
        <div class="container">
            Copyright &copy; 2023, Singapore General Knowledge Quiz
        </div>
    </footer>



</body>

</html>