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
                <!--<?php
                foreach($questions as $question){
                    echo '<div class="question">
                       <label>1. placeholder</label>
                       <textarea></textarea>';
                };
                ?>-->
                <div class="question">
                    <label>1. placeholder</label>
                    <textarea></textarea>
                </div>
                <div class="question">
                    <label>1. placeholder</label>
                    <textarea></textarea>
                </div>
                <div class="submit">
                    <input type="submit" value="Check">
                </div>
            </form>
        </div>
    </body>
</html>
