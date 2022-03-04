<?php

    if (!isset($_POST['submit']))
    {
        //this page shoudl not be accessed directly.  Need to submit the form.  
        echo "error; you need to submit the form!";
    }
    $email_from="shannon.silvernail@gmail.com";
    $mailheader="From: $email_from \r\n";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];
    $body = "";
    $newsLtrMsg="Thank you for your newsletter request.";
    $msg_Ltr="Thank you for your email.  A customer service representaive will respond with in 48 hours if necessary.";
    $msgCombo=$newsLtrMsg + "/n" + $msg_Ltr;

    //Validate name and email address
    if (empty($name)||empty ($email))
    {
        echo "Name and email are mandatory!";
        exit;
    }
    //validate msg body or newsletter request
    elseif (empty($msg) && !isset($_POST['news_ltr']))
    {
        echo "You must provide a message or request newsletter."
        exit;
    }
    else{
        //Met validation-build email message body
        if (empty($msg))
        {
            $body = $newsLtrMsg;
            $email_subject=$name + "Newsletter Request"
        }
        elseif(!isset($_POST['news_ltr']))
        {
            $body = $msg_Ltr;
            $email_subject=$name + "Customer Support Request."

        }
        else
        {
            $body = $msgCombo;
            $email_subject=$name + "Customer Support Request plus Newsletter."
        }
    }
    
    //Email Construct
    mail($email, $email_subject, $body,$mailheader);


?>