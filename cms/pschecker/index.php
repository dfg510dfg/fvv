﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Password Strength Checker</title>
    
    <script src="../pschecker/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <link href="../pschecker/style/demo.css" rel="stylesheet" type="text/css" />

    <link href="../pschecker/style/style.css" rel="stylesheet" type="text/css" />
    <script src="../pschecker/js/pschecker.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
           
            //Demo code
            $('.password-container').pschecker({ onPasswordValidate: validatePassword, onPasswordMatch: matchPassword });

            var submitbutton = $('.submit-button');
            var errorBox = $('.error');
            errorBox.css('visibility', 'hidden');
            submitbutton.attr("disabled", "disabled");

            //this function will handle onPasswordValidate callback, which mererly checks the password against minimum length
            function validatePassword(isValid) {
                if (!isValid)
                    errorBox.css('visibility', 'visible');
                else
                    errorBox.css('visibility', 'hidden');
            }
            //this function will be called when both passwords match
            function matchPassword(isMatched) {
                if (isMatched) {
                    submitbutton.addClass('unlocked').removeClass('locked');
                    submitbutton.removeAttr("disabled", "disabled");
                }
                else {
                    submitbutton.attr("disabled", "disabled");
                    submitbutton.addClass('locked').removeClass('unlocked');
                }
            }
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="../pschecker/images/logo.jpg" alt="logo" /></div>
        <p>
            <span class="error">Password must be 8 characters long</span>
        </p>
        <div class="password-container">
            <p>
                <label>
                    Enter Password:</label>
                <input class="strong-password" type="password" />
            </p>
            <p>
                <label>
                    Confirm Password:</label>
                <input class="strong-password" type="password" />
            </p>
            <p>
                <a class="submit-button locked" href="#">Submit</a>
            </p>
            <div class="strength-indicator">
                <div class="meter">
                </div>
                Strong passwords contain 8-16 characters, do not include common words or names,
                and combine uppercase letters, lowercase letters, numbers, and symbols.
            </div>
        </div>
    </div>
	</body>
</html>
