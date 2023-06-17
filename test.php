<?php
    $questions = [];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $questions = $_POST["questions"];
        $answers = $_POST["answers"];
    }

    $level = "beginner";
    $endpoint = "http://127.0.0.1:5000/quiz";

    $curl = curl_init($endpoint);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("level" => $level)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    if($response === false) {
        echo "Error: Failed to retrieve quiz questions";
    }
    else{
        $questions = json_decode($response, true);
    }

    if($questions === null) {
        echo "Error: Failed to parse quiz questions";
    }
    else{
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
            <form action="selectQuiz.php" method="POST">
                <?php foreach($questions as $index => $question){ ?>
                    <input type="hidden" name="questions[]" value="<?php echo $question; ?>">
                    <div class="test">
                        <label for="questions[]"><?php echo $index + 1; ?>. <?php echo $question; ?></label>
                        <textarea name="answers[<?php echo $question; ?>]"></textarea>
                    </div>
                <?php } ?>
                <div class="submit">
                    <input type="submit" value="Check">
                </div>
            </form>
        </div>
        </body>
        </html>
<?php
    }
    ?>

