<?php require("script.php"); ?>

<?php

if(isset($_POST['submitMail'])){
    if(empty($_POST['email'])){
        $response = "No email given";
    } else {
        $subj = "Confirmation email";
        $mess = "Your mail has been verified ! Welcome to Hackers-poulette !";
        
        $response = sendMail($_POST['email'], $subj, $mess);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
</head>
<body>
    
<form>

<label for="email">Adresse email:</label>
<input type="email" name="email" id="email" required minlength="2" maxlength="255">

<input type="submit" value="SUBMIT" name="submitMail">

</form>

<?php
            
            if (@$response == "success"){
                ?>
                <p class="success">Email sent successfully</p>

                <?php
            } else {
                ?>
                <p class="error"><?php echo @$response; ?></p>
                <?php
            }

            ?>

</body>
</html>