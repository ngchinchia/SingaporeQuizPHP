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
        <form action="question.php" method="post">

            <h1>Please insert your nickname:</h1>
            <input type="text" name="nickname" id="nickname">
            <br><br>

            <h2>Please choose a topic:</h2>
            <input type="radio" name="topic" value="history"> Singapore History
            <input type="radio" name="topic" value="geography"> Singapore Geography
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

   

</body>

</html>