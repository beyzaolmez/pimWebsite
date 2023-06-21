<?php
session_start();

// Function to retrieve quiz questions from Python endpoint
function retrieveQuizQuestions($level) {
    $endpoint = "http://127.0.0.1:5000/quiz";

    $curl = curl_init($endpoint);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("level" => $level)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    if ($response !== false) {
        $questions = json_decode($response, true);
        return $questions;
    } else {
        return false;
    }
}

// Check if the retry button was clicked
if (isset($_POST['retry'])) {
    // Retrieve new quiz questions from the Python endpoint
    $questions = retrieveQuizQuestions("beginner");

    if ($questions) {
        // Store the retrieved questions in session
        $_SESSION['quiz'] = $questions;
        unset($_SESSION['results']); // Clear previous results
    }
}

if (isset($_POST['end'])){
    $end = retrieveQuizQuestions('beginner');

    if ($end) {
        // Store the retrieved questions in session
        $_SESSION['quiz'] = $end;
        unset($_SESSION['results']); // Clear previous results
    }

    header("Location: selectQuiz.php");
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['retry'])) {
    $userAnswers = $_POST['answers'];
    $questions = $_SESSION['quiz'];
    $correctAnswers = array_column($questions['data'], 'answer');

    $results = array();
    foreach ($userAnswers as $index => $userAnswer) {
        $questionText = $questions['data'][$index]['question'];
        $correctAnswer = $correctAnswers[$index];
        $isCorrect = strtolower($userAnswer) === strtolower($correctAnswer);

        $result = array(
            'question' => $questionText,
            'userAnswer' => $userAnswer,
            'correctAnswer' => $correctAnswer,
            'isCorrect' => $isCorrect
        );

        $results[] = $result;
    }

    $_SESSION['results'] = $results;
}

// Retrieve or use the stored quiz questions from session
$questions = isset($_SESSION['quiz']) ? $_SESSION['quiz'] : retrieveQuizQuestions("beginner");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <style>
        .question {
            margin-bottom: 10px;
        }
        .correct {
            color: green;
        }
        .wrong {
            color: red;
        }
    </style>
</head>
<body>
<h2>Welcome Username,</h2>
<h1>Translate the following Dutch words to English:</h1>
<form id="quizForm" method="POST">
    <?php foreach ($questions['data'] as $index => $item) { ?>
        <div class="question">
            <label for="question<?php echo $index; ?>">
                <?php echo $item['question']; ?>
            </label>
            <input type="text" name="answers[]" id="question<?php echo $index; ?>" value="<?php echo isset($_SESSION['results'][$index]['userAnswer']) ? $_SESSION['results'][$index]['userAnswer'] : ''; ?>">
        </div>
    <?php } ?>
    <input type="submit" value="Submit">
    <button type="submit" name="retry" id="retryBtn">Retry</button>
    <button type="submit" name="end" id="endBtn">end</button>

</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['retry']) && isset($_SESSION['results'])) { ?>
    <h2>Results:</h2>
    <div id="resultsDiv">
        <?php foreach ($_SESSION['results'] as $result) { ?>
            <p>
                <strong><?php echo $result['question']; ?></strong><br>
                <?php if ($result['isCorrect']) { ?>
                    <span class="correct">Correct!</span>
                <?php } else { ?>
                    <span class="wrong">Wrong! The correct answer is: <?php echo $result['correctAnswer']; ?></span>
                <?php } ?>
            </p>
        <?php } ?>
    </div>
<?php } ?>

<script>
    document.getElementById('retryBtn').addEventListener('click', function() {
        fetch('http://127.0.0.1:5000/quiz', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'level=beginner'
        })
            .then(function(response) {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Failed to retrieve quiz questions');
                }
            })
            .then(function(data) {
                sessionStorage.setItem('quizQuestions', JSON.stringify(data));
                sessionStorage.removeItem('results');
                document.getElementById('quizForm').innerHTML = generateQuizQuestions(data);
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
    });

    function generateQuizQuestions(questions) {
        var html = '';
        questions.data.forEach(function(item, index) {
            html += '<div class="question">';
            html += '<label for="question' + index + '">' + item.question + '</label>';
            html += '<input type="text" name="answers[]" id="question' + index + '" value="">';
            html += '</div>';
        });
        html += '<input type="submit" value="Submit">';
        html += '<button type="button" id="retryBtn">Retry</button>';
        return html;
    }
</script>
</body>
</html>