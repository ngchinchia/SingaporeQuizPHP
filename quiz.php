<?php
    session_start();
    $nickname = $_SESSION['nickname'];
    $topic = $_SESSION['topic'];
    $questions = $_SESSION['questions']; // Retrieve array of questions
    $total_questions = count($questions); // Counts total number of questions in the array
    $current_question = (isset($_GET['question']) && is_numeric($_GET['question'])) ? $_GET['question'] : 1; // Retrieve current question number in the question parameter in the URL
    $previous_question = ($current_question > 1) ? $current_question - 1 : 1; // Calculate previous question number. Prev = curr - 1
    $next_question = ($current_question < $total_questions) ? $current_question + 1 : $total_questions; // Next question is curr + 1 if curr is less than total number of questions
    
    echo "<h1> Welcome ". $nickname . " </h1>";
    echo "<br>";
    echo "<h2> This topic is on ". $topic ." </h2>";
    echo "<h3> Question ". $current_question . ": " . $questions[$current_question - 1]. "</h3>"; // Display curr question number and the respective question in $questions array
    echo "<br><br>";
    
    $options_for_history = array(
        array("1950", "1965", "1971", "1963"),
        array("Lee Kuan Yew", "Goh Chok Tong", "Lee Hsien Loong", "Ong Teng Cheong"),
        array("Singapura", "Temasek", "Malaya", "Riau"),
        array("1965", "1968", " 1971", "1974"),
        array("Lee Kuan Yew", " Sir Stamford Raffles", "Tan Cheng Lock", " William Farquhar"),
    );

    $options_for_geography = array(
        array("d", "s", "d", "c"),
        array("Option 11", "Option 22", "Option 33", "Option 44"),
        array("Option 111", "Option 222", "Option 333", "Option 444"),
        array("Option 1111", "Option 2222", "Option 3333", "Option 4444"),
        array("Option A", "Option B", "Option C", "Option D"),
    );
    
    if ($topic == "Singapore History")
    {
        echo "<form>";
        foreach($options_for_history[$current_question - 1] as $option) {
        echo "<input type='radio' name='answer' value='$option'> $option<br>";
        }
        echo "</form>";
    }
    else
    {
        echo "<form>";
        foreach($options_for_geography[$current_question - 1] as $option) {
        echo "<input type='radio' name='answer' value='$option'> $option<br>";
        }
        echo "</form>";
    }
    
   
    echo "<a href='quiz.php?question=".$previous_question."'>Prev</a>";
    echo " | ";
    echo "<a href='quiz.php?question=".$next_question."'>Next</a>";
?>