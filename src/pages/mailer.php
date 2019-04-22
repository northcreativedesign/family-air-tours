<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tripOne = trim($_POST["tripOne"]);
    $tripTwo = trim($_POST["tripTwo"]);
    $numberOfAdults = trim($_POST["numberOfAdults"]);
    $numberOfChildren = trim($_POST["numberOfChildren"]);
    $time = trim($_POST["time"]);
    $adultInfoOneName = trim($_POST["adultInfoOneName"]);
    $adultInfoOneWeight = trim($_POST["adultInfoOneWeight"]);
    $adultInfoTwoName = trim($_POST["adultInfoTwoName"]);
    $adultInfoTwoWeight = trim($_POST["adultInfoTwoWeight"]);
    $adultInfoThreeName = trim($_POST["adultInfoThreeName"]);
    $adultInfoThreeWeight = trim($_POST["adultInfoThreeWeight"]);
    $adultInfoFourName = trim($_POST["adultInfoFourName"]);
    $adultInfoFourWeight = trim($_POST["adultInfoFourWeight"]);
    $childInfoOneName = trim($_POST["childInfoOneName"]);
    $childInfoOneWeight = trim($_POST["childInfoOneWeight"]);
    $childInfoOneAge = trim($_POST["childInfoOneAge"]);
    $childInfoTwoName = trim($_POST["childInfoTwoName"]);
    $childInfoTwoWeight = trim($_POST["childInfoTwoWeight"]);
    $childInfoTwoAge = trim($_POST["childInfoTwoAge"]);
    $childInfoThreeName = trim($_POST["childInfoThreeName"]);
    $childInfoThreeWeight = trim($_POST["childInfoThreeWeight"]);
    $childInfoThreeAge = trim($_POST["childInfoThreeAge"]);
    $adultPrimaryContactName = trim($_POST["adultPrimaryContactName"]);
    $adultPrimaryEmail = filter_var(trim($_POST["adultPrimaryEmail"]), FILTER_SANITIZE_EMAIL);
    $adultPrimaryPhone = trim($_POST["adultPrimaryPhone"]);
    $adultPrimaryAddress = trim($_POST["adultPrimaryAddress"]);
    $creditCardNumber = trim($_POST["creditCardNumber"]);
    $cvv = trim($_POST["CVV"]);
    $expirationDate = trim($_POST["expirationDate"]);
    $message = trim($_POST["message"]);
    $flyDate = trim($_POST["flyDate"]);
    $cruiseShip = trim($_POST["cruiseShip"]);
    $timeStamp = date('m-d-Y');


    // WRITE DATA TO FILE BEFORE EMAILING
    $file_content = "-------------------------------------------------------\n";
    $file_content .= "$timeStamp\n\n";
    $file_content .= "Primary Contact Name: $adultPrimaryContactName\n\n";
    $file_content .= "Primary Contact Email: $adultPrimaryEmail\n\n";
    $file_content .= "Primary Contact Phone: $adultPrimaryPhone\n\n";
    $file_content .= "Primary Address: $adultPrimaryAddress\n\n";
    $file_content .= "Credit Card Number: $creditCardNumber\n\n";
    $file_content .= "CVV: $cvv\n\n";
    $file_content .= "Expiration Date: $expirationDate\n\n";
    $file_content .= "Trip Option One: $tripOne\n\n";
    $file_content .= "Trip Option Two: $tripTwo\n\n";
    $file_content .= "Number Of Adults: $numberOfAdults\n\n";
    $file_content .= "Number Of Children: $numberOfChildren\n\n";
    $file_content .= "Preferred Flight Time: $time\n\n";
    $file_content .= "Adult One Name: $adultInfoOneName\n\n";
    $file_content .= "Adult One Weight: $adultInfoOneWeight\n\n";
    $file_content .= "Adult Two Name: $adultInfoTwoName\n\n";
    $file_content .= "Adult Two Weight: $adultInfoTwoWeight\n\n";
    $file_content .= "Adult Three Name: $adultInfoThreeName\n\n";
    $file_content .= "Adult Three Weight: $adultInfoThreeWeight\n\n";
    $file_content .= "Adult Four Name: $adultInfoFourName\n\n";
    $file_content .= "Adult Four Weight: $adultInfoFourWeight\n\n";
    $file_content .= "Child One Name: $childInfoOneName\n\n";
    $file_content .= "Child One Weight: $childInfoOneWeight\n\n";
    $file_content .= "Child One Age: $childInfoOneAge\n\n";
    $file_content .= "Child Two Name: $childInfoTwoName\n\n";
    $file_content .= "Child Two Weight: $childInfoTwoWeight\n\n";
    $file_content .= "Child Two Age: $childInfoTwoAge\n\n";
    $file_content .= "Child Three Name: $childInfoThreeName\n\n";
    $file_content .= "Child Three Weight: $childInfoThreeWeight\n\n";
    $file_content .= "Child Three Age: $childInfoThreeAge\n\n";
    $file_content .= "Date Request: $flyDate\n\n";
    $file_content .= "Cruise Ship: $cruiseShip\n\n";
    $file_content .= "Message:\n$message\n";

    $fileHandle = fopen("myData", 'a+');
    fwrite($fileHandle, $file_content);
    fclose($fileHandle);
    // fwrite($fileHandle, $adultPrimaryContactName);
    // fwrite($fileHandle, $adultPrimaryEmail);
    // fwrite($filehandle, $adultPrimaryPhone);
    // fclose($fileHandle);



    // $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    // $message = trim($_POST["message"]);

    if(isset($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
    }

    //Validate the data
    if (empty($adultPrimaryContactName) OR empty($adultPrimaryPhone) OR !filter_var($adultPrimaryEmail, FILTER_VALIDATE_EMAIL) OR empty($captcha)) {
        http_response_code(400);
        echo "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> <strong>Please fill all the form inputs and check the captcha to submit.</strong>";
        exit;
    }

    //recipient email address.
    $recipient = "info@familyairtours.com";

    //email subject.
    $subject = "New message from $adultPrimaryContactName";

    //email content.
    $email_content = "Trip Option One: $tripOne\n";
    $email_content .= "Trip Option Two: $tripTwo\n\n";
    $email_content .= "Number Of Adults: $numberOfAdults\n\n";
    $email_content .= "Number Of Children: $numberOfChildren\n\n";
    $email_content .= "Preferred Flight Time: $time\n\n";
    $email_content .= "Adult One Name: $adultInfoOneName\n\n";
    $email_content .= "Adult One Weight: $adultInfoOneWeight\n\n";
    $email_content .= "Adult Two Name: $adultInfoTwoName\n\n";
    $email_content .= "Adult Two Weight: $adultInfoTwoWeight\n\n";
    $email_content .= "Adult Three Name: $adultInfoThreeName\n\n";
    $email_content .= "Adult Three Weight: $adultInfoThreeWeight\n\n";
    $email_content .= "Adult Four Name: $adultInfoFourName\n\n";
    $email_content .= "Adult Four Weight: $adultInfoFourWeight\n\n";
    $email_content .= "Child One Name: $childInfoOneName\n\n";
    $email_content .= "Child One Weight: $childInfoOneWeight\n\n";
    $email_content .= "Child One Age: $childInfoOneAge\n\n";
    $email_content .= "Child Two Name: $childInfoTwoName\n\n";
    $email_content .= "Child Two Weight: $childInfoTwoWeight\n\n";
    $email_content .= "Child Two Age: $childInfoTwoAge\n\n";
    $email_content .= "Child Three Name: $childInfoThreeName\n\n";
    $email_content .= "Child Three Weight: $childInfoThreeWeight\n\n";
    $email_content .= "Child Three Age: $childInfoThreeAge\n\n";
    $email_content .= "Primary Contact Name: $adultPrimaryContactName\n\n";
    $email_content .= "Primary Contact Email: $adultPrimaryEmail\n\n";
    $email_content .= "Primary Contact Phone: $adultPrimaryPhone\n\n";
    $email_content .= "Date Request: $flyDate\n";
    $email_content .= "Cruise Ship: $cruiseShip\n";
    $email_content .= "Message:\n$message\n";




    //email headers.
    $email_headers = "From: $adultPrimaryContactName <$adultPrimaryEmail>";

    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lc6I1UUAAAAAPU3Jf_TC6IpFfBqOwhEzRn8yKA2&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    $decoded_response = json_decode($response, true);

    if($decoded_response['success'] == true)	{
        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            http_response_code(200);
            echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> <div class='success-message'><p><strong>Thank You! Your Message Has Been Sent.</strong></p></div>";
        } else {
            http_response_code(500);
            echo "Whoa! message could not be sent.";
        }
    } else {
        http_response_code(400);
        echo 'You are a spammer!';
    }
}

?>
