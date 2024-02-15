<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    
<?php
require_once 'autoload.php';
if(isset($POST['captcha'])){
    $recaptcha = new \ReCaptcha\ReCaptcha('6Lezy3MpAAAAAHmTlPLweZbrJHTWSgPqdUH1ni5G');
    $gRecaptchaResponse = $_POST['g-recaptcha-response'];
    $resp = $recaptcha->setExpectedHostname('localhost')
                  ->verify($gRecaptchaResponse, $remoteIp);
    if ($resp->isSuccess()) {
        echo "Success !";
    } else {
        $errors = $resp->getErrorCodes();
        var_dump($errors);
    }
}

?>

<form action="?" method="POST">
      <div class="g-recaptcha" data-sitekey="6Lezy3MpAAAAAD5tPqfalKNkK_yj_TnsLXAA00ga"></div>
      <br/>
      <input type="submit" name="captcha" value="Submit">
</form>


</body>
</html>