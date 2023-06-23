<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["retry"]) && $_POST["retry"] == "Retry") {
        session_destroy();
        header("Location: test.php");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    if (!isset($_SESSION['questions'])) {
        $level = "beginner";
        $endpoint = "http://host.docker.internal:5000/ll/quiz";

        $curl = curl_init($endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("level" => $level)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_VERBOSE, true);

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response !== false) {
            $decodedResponse = json_decode($response, true);
            if ($decodedResponse !== null && isset($decodedResponse["data"])) {
                $_SESSION["questions"] = $decodedResponse["data"];
                $questions = $_SESSION["questions"];
            } else {
                echo "Error: Invalid quiz questions format";
                exit;
            }
        } else {
            echo "Error: Failed to retrieve quiz questions";
            exit;
        }
    } else {
        $questions = $_SESSION["questions"];
    }
}

$userAnswers = $_SESSION['user_answers'] ?? array();

?>
<!DOCTYPE html>
<html lang="eng">

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
        <?php
        $questions = $_SESSION["questions"];
        foreach ($questions as $index => $item) {
            $answer = $userAnswers[$index] ?? '';
            ?>
            <div class="test">
                <label for="question<?php echo $index; ?>">
                    <?php echo ($index + 1) . '. ' . $item["question"]; ?>
                </label>
                <textarea name="answers[]" id="question<?php echo $index; ?>" ><?php echo $answer; ?></textarea>
            </div>
            <?php
        }
        ?>
        <div class="submit">
            <input type="submit" value="Check">
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["answers"])) {
                echo "<input type='submit' name='retry' value='Retry'>";
                if (isset($_POST["show"])) {
                    echo "<input type='submit' name='show' value='Show Answers' disabled>";
                } else {
                    echo "<input type='submit' name='show' value='Show Answers'>";
                }
            }
        }
        ?>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["answers"])) {
            $questions = $_SESSION["questions"];
            $answers = $_POST["answers"];

            $_SESSION['user_answers'] = $answers;

            $score = 0;
            $incorrectAnswers = array();

            foreach ($questions as $index => $item) {
                $correctAnswer = $item["answer"];
                $userAnswer = trim($answers[$index]);

                if (strtolower($userAnswer) === strtolower($correctAnswer)) {
                    $score++;
                } else {
                    $incorrectAnswers[] = array(
                        'questionNumber' => ($index + 1),
                        'question' => $item["question"],
                        'correctAnswer' => $correctAnswer,
                        'userAnswer' => $userAnswer,
                    );
                }
            }
            $qsTotal = count($questions);
            echo "<p class='total'>Your score: $score out of $qsTotal </p>";

            if (isset($_POST["show"])) {
                echo "<div id='incorrectAnswer'>";
                echo "<h3>Correct answers: </h3> <ul>";
                foreach ($incorrectAnswers as $incorrect) {
                    echo "<li>";
                    echo $incorrect['questionNumber'] . '. ' . $incorrect['question'] . "<br>";
                    echo "Correct answer: " . $incorrect['correctAnswer'] . "<br>";
                    echo "</li>";
                }
                echo "</ul></div>";
            }
        }
    }
    ?>
</div>
</body>

</html>
