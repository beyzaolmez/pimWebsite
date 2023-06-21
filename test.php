<?php
session_start();
$questions = [];

if($_SERVER["REQUEST_METHOD"] !== "POST") {
    if(!isset($_SESSION['questions'])){
        $level = "beginner";
        $endpoint = "http://host.docker.internal:5000/quiz";

        $curl = curl_init($endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("level" => $level)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_VERBOSE, true);


        $response = curl_exec($curl);
        curl_close($curl);

        if ($response !== false) {
            $questions = json_decode($response, true);
            $_SESSION['questions'] = $questions;
        } else {
            echo "Error: Failed to retrieve quiz questions";
            exit;
        }
        if ($questions === null) {
            echo "Error: failed to parse quiz questions";
            exit;
        }
    }
    else{
        $questions = $_SESSION['questions'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="css/test.css">
</head>

<body>
<div id="container">
    <div id="intro">
        <h2 class="first">Welcome Username,</h2>
        <h1 class="second">Translate the following Dutch words to English in the provided boxes.
            When you finish the quiz, click check to get your result and the correct answers. Good luck!</h1>
        <p>Tip: make sure the spelling is correct</p>
    </div>
    <form action="test.php" method="POST">
        <?php foreach($questions['data'] as $index => $item){ ?>
            <div class="test">
                <label for="question" <?php echo $index; ?>">
                <?php echo ((int)$index + 1) . '. ' . $item['question']; ?>
                </label>
                <textarea name="answers[]" id="question<?php echo $index; ?>"></textarea>
            </div>
        <?php } ?>
        <div class="submit">
            <input type="submit" value="Check">
        </div>
    </form>

    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //$question = $_POST["question"];
        $answers = $_POST["answers"];

        $score = 0;
        $incorrectAnswers = array();

        foreach ($questions['data'] as $index => $item){
            $correctAnswer = $item['answer'];
            $userAnswer = trim($answers[$index]);

            if(strtolower($userAnswer) === strtolower($correctAnswer)){
                $score++;
            }
            else{
                $incorrectAnswers[] = array(
                    'questionNumber' => ($index + 1),
                    'question' => $item['question'],
                    'correctAnswer' => $correctAnswer,
                    'userAnswer' => $userAnswer,
                );
            }
        }
        ?>
        <p class='total'>Your score: <?php echo $score ?> out of <?php echo count($questions['data']);?></p>
        <button class="button" onclick="showIncorrectAnswers()">Show incorrect answers</button>
        <div id="incorrectAnswer">
            <h3>Incorrect answers: </h3>
            <ul>
                <?php foreach ($incorrectAnswers as $incorrect){ ?>
                    <li><?php echo $incorrect['questionNumber'] . '. ' . $incorrect['correctAnswer']; ?></li>
                <?php } ?>
            </ul>
        </div>
        <script>
            function showIncorrectAnswers() {
                var container = document.getElementById("incorrectAnswer");
                container.style.display = "block";
            }
        </script>
        <?php
    }
    ?>
</div>
</body>
</html>
<?php

?>


