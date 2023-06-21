<?php

//check if user got the this page by the right way
if (isset($_POST["reset-request-submit"])) {
    $password = filter_input(INPUT_POST,"pwd");
    $passwordRepeat = filter_input(INPUT_POST,"pwd-repeat");
    $selector = filter_input(INPUT_POST,"selector");
    $validator = filter_input(INPUT_POST,"validator");
    $url = "http://localhost/reset.php?selector=" . $selector . "&validator=" . $validator;

    //check if the user left the pass empty or if passes are not the same
    if (empty($password) || empty($passwordRepeat)) {
        header("Location:".$url. "&newpwd=pwdempty"); //reset page with an message
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location:".$url."&newpwd=pwdnotsame"); //reset page with an message
        exit();
    }
    
    //connect to database
    try{
        $dbhandler = new PDO("mysql:host=mysql; dbname=aipim; charset=utf8", "root", "qwerty");
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $ex){
        echo "Connection failed: ".$ex->getMessage();
    }

    $stmt = $dbhandler->prepare("SELECT * FROM Pass_reset WHERE pwdResetSelector=:selector");
    if (!$stmt) {
        echo "There was an error!";
        exit();
    } else {
        $stmt->bindParam("selector",$selector,PDO::PARAM_STR);
        $stmt->execute();

        $stmt->bindColumn("pwdResetToken",$pwdResetToken);
        $stmt->bindColumn("pwdResetEmail",$tokenEmail);
        
        
        $result = $stmt->fetch();
        if (!$result) {
            echo "You need to re-submit your reset request!";
        } else {                
                $stmt = $dbhandler->prepare("SELECT * FROM Users WHERE email_address=:tokenEmail");
                if (!$stmt) {
                    echo "There was an error!";
                    exit();
                } else {
                    $stmt->bindParam('tokenEmail', $tokenEmail);
                    $stmt->execute();
                    
                    $result = $stmt->fetchall();
                    if (!$result) {
                        echo "You need to re-submit your reset request!";
                        exit();
                    } else {
                        
                        $stmt = $dbhandler->prepare("UPDATE Users SET user_password=:newPwdHash WHERE email_address=:tokenEmail");
                        if (!$stmt) {
                            echo "There was an error!";
                            exit();
                        } else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            $stmt->bindParam("newPwdHash",$newPwdHash,PDO::PARAM_STR);
                            $stmt->bindParam("tokenEmail",$tokenEmail,PDO::PARAM_STR);
                            $stmt->execute();
                            
                            //delete the token when user gets to the page
                            $stmt = $dbhandler->prepare("DELETE FROM Pass_reset WHERE pwdResetEmail=:tokenEmail");
                            if (!$stmt) {
                                echo "There was an error!";
                                exit();
                            } else {
                                $stmt->bindParam('tokenEmail', $tokenEmail,PDO::PARAM_STR);
                                $stmt->execute();
                                header("Location:signIn.php?newpwd=passwordupdated"); //reset page with an update message
                            }
                        }
                    }
                }           
            }
        }
    }  
 else {
    //header("Location: login.php");
     echo "IM HERE!!!!";
}
?>