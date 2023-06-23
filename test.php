<?php
    include "languages/config.php";
?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["retry"]) && $_POST["retry"] == "New quiz") {
        session_destroy();
        header("Location: selectQuiz.php");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    if (!isset($_SESSION['questions'])) {
        if ($_GET['level'] == "beginner") {
            $level = "beginner";
        } elseif ($_GET['level'] == "mid") {
            $level = "intermediate";
        } elseif ($_GET['level'] == "advanced") {
            $level = "advanced";
        }


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
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div id="container">

<?php include_once "header.php"; ?>

    <div id="intro">
        <h2 class="first"><?php echo $lang['welcome']; ?></h2>
        <h1 class="second"> <?php echo $lang['explanation']; ?> </h1>
        <p><?php echo $lang['tip']; ?></p>
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
                echo "<input type='submit' name='retry' value='New quiz'>";
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
    <footer>
    <div class="select-menu">
    <div class="select-btn">
        <img src="img/globe-icon.jpg" alt="logo">
        <span class="sBtn-text">English</span>
        <i class="bx bx-chevron-up"></i>
    </div>
    <ul class="options">
        <li class="option">
        <span class="option-text"><a class="option-text" href="test.php?lang=en"><?php echo $lang['lang_en']; ?></a></span>
        </li>
        <li class="option">
        <span class="option-text"><a class="option-text" href="test.php?lang=nl"><?php echo $lang['lang_nl']; ?></a></span>
        </li>
    </ul>
    </div>
    <p> <?php echo $lang['footer']; ?> </p>
    </footer>
</div>
</body>
<script src="dropdown.js"></script>
</html>
