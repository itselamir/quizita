<?php
session_start();
## You can change the number of slides to any arbitrary number
$number_of_slides = 14;

## USEFUL FUNCTIONS FOR PERSIAN/ARABIC WEBSITES
// function faTOen($string)
//     {
//         return strtr($string, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));
//     }
// function enTOfa($string)
//     {
//         return strtr($string, array('0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹'));
//     }


## If the output of radiobuttons was anything but 'yes' or 'no', the program will die
function validate_radio_buttons()
    {
        if ($_POST['answer'] != 'yes' && $_POST['answer'] != 'no') {
            die();
        }
    }

## Scores are saved in a session which means the scores can be manipulated by a
## malicious user (only for that specific user)
function add_score($addition)
    {
        $_SESSION['score'] = (int)$_SESSION['score'] + (int)$addition;
    }

function writeDataToFile($data, $filePath)
    {

        // Check if the directory exists, if not, create it
        if (!file_exists($filePath)) {
            mkdir($filePath, 0770, true);
        }

        $fileName = $_SESSION['name'];
        $i = 2;
        while (file_exists($filePath . $fileName . '.php')) {
            $fileName = $_SESSION['name'] . " ($i)";
            $i++;
        }
        $file = fopen($filePath . $fileName . '.php', 'w');
        // Write data to a php file so that it's not accessible from the browser
        fwrite($file, "<?php \n" . $data . "\n?>");
        fclose($file);
        chmod($filePath . $fileName . '.php', 0640);
    }

    # Each case validates and processes the last steps' things:
    switch ($_POST['step']) {
        case '1':
            if (mb_strlen($_POST['name']) < 50) {
                $_SESSION['name'] = $_POST['name'];
            } else {
                die();
            }
            if (mb_strlen($_POST['tel']) < 15) {
                $_SESSION['tel'] = $_POST['tel'];
            } else {
                die();
            }
            if ($_POST['gender'] == 'male' || $_POST['gender'] == 'female') {
                $_SESSION['gender'] = $_POST['gender'];
            } else {
                die();
            }
            $_SESSION['age'] = $_POST['age'];
            if (ctype_digit($_SESSION['age'])) {
                if ($_SESSION['age'] > 45) {
                    add_score(5);
                }
            } else {
                die();
            }
        break;
        case '2':
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            ## In this sample quiz if BMI is above 27, 5 points are added to the score
            if (
                ctype_digit($height) && ctype_digit($weight)
                && $height > 30 && $height < 250 && $weight < 300 && $weight > 1
            ) {
                if ($weight / (($height / 100) * ($height / 100)) > 27) {
                    add_score(5);
                }
            } else {
                die();
            }
        break;
        case '3':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;

        case '4':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '5':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '6':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '7':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '8':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '9':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '10':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '11':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '12':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '13':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '14':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;
        case '15':
            validate_radio_buttons();
            if ($_POST['answer'] == 'yes') {
                add_score(5);
            }
            break;

        default:
            session_unset();
            break;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
    <title>Quizita Sample Page</title>
    <style>
        /* UNCOMMENT THE LINES BELOW IF YOU WANT A CUSTOM FONT FOR THE PAGE
        @font-face {
            font-family: Vazir;
            src: url("./Vazirmatn-Regular.ttf");
        }
        */

        input[type=submit] {
            transition-duration: 0.4s;
            background-color: #fff;
            color: #ef233c;
            border: 2px solid #ef233c;
            font-size: 20px;
            padding: 5px 20px;
            border-radius: 10px;
        }

        input[type=submit]:hover {
            background-color: #ef233c;
            color: white;
            cursor: pointer;
        }

        .wrapper {
            display: inline-flex;
            background: #fff;
            align-items: center;
            justify-content: space-evenly;
            border-radius: 5px;
            padding: 20px 32px 20px 15px;
        }

        .wrapper .option {
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            border-radius: 5px;
            cursor: pointer;
            padding: 0 10px 0px;
            border: 2px solid lightgrey;
            transition: all 0.3s ease;
        }

        .wrapper .option .dot {
            height: 20px;
            width: 20px;
            background: #d9d9d9;
            border-radius: 50%;
            position: relative;
            margin-right: 4px;
        }

        .wrapper .option .dot::before {
            position: absolute;
            content: "";
            top: 4px;
            left: 4px;
            width: 12px;
            height: 12px;
            background: #ef233c;
            border-radius: 50%;
            opacity: 0;
            transform: scale(1.5);
            transition: all 0.3s ease;
        }
        #option-1, #option-2 {
            /* Setting opcaity to 0% instead of display:none makes
            the buttons invisible but the error messages visible! :D */
           opacity: 0%;
        }
        #option-1:checked:checked~.option-1,
        #option-2:checked:checked~.option-2 {
            border-color: #ef233c;
            background: #ef233c;
        }

        #option-1:checked:checked~.option-1 .dot,
        #option-2:checked:checked~.option-2 .dot {
            background: #fff;
        }

        #option-1:checked:checked~.option-1 .dot::before,
        #option-2:checked:checked~.option-2 .dot::before {
            opacity: 1;
            transform: scale(1);
        }

        .wrapper .option span {
            font-size: 20px;
            color: #808080;
        }

        #option-1:checked:checked~.option-1 span,
        #option-2:checked:checked~.option-2 span {
            color: #fff;
        }

        html {
            background:
                linear-gradient(180deg, rgba(248, 184, 139, 0) 20%, rgba(248, 184, 139, .1) 20%, rgba(248, 184, 139, .1) 40%, rgba(248, 184, 139, .2) 40%, rgba(248, 184, 139, .2) 60%, rgba(248, 184, 139, .4) 60%, rgba(248, 184, 139, .4) 80%, rgba(248, 184, 139, .5) 80%),
                linear-gradient(45deg, rgba(250, 248, 132, .3) 20%, rgba(250, 248, 132, .4) 20%, rgba(250, 248, 132, .4) 40%, rgba(250, 248, 132, .5) 40%, rgba(250, 248, 132, .5) 60%, rgba(250, 248, 132, .6) 60%, rgba(250, 248, 132, .6) 80%, rgba(250, 248, 132, .7) 80%),
                linear-gradient(-45deg, rgba(186, 237, 145, 0) 20%, rgba(186, 237, 145, .1) 20%, rgba(186, 237, 145, .1) 40%, rgba(186, 237, 145, .2) 40%, rgba(186, 237, 145, .2) 60%, rgba(186, 237, 145, .4) 60%, rgba(186, 237, 145, .4) 80%, rgba(186, 237, 145, .6) 80%),
                linear-gradient(90deg, rgba(178, 206, 254, 0) 20%, rgba(178, 206, 254, .3) 20%, rgba(178, 206, 254, .3) 40%, rgba(178, 206, 254, .5) 40%, rgba(178, 206, 254, .5) 60%, rgba(178, 206, 254, .7) 60%, rgba(178, 206, 254, .7) 80%, rgba(178, 206, 254, .8) 80%),
                linear-gradient(-90deg, rgba(242, 162, 232, 0) 20%, rgba(242, 162, 232, .4) 20%, rgba(242, 162, 232, .4) 40%, rgba(242, 162, 232, .5) 40%, rgba(242, 162, 232, .5) 60%, rgba(242, 162, 232, .6) 60%, rgba(242, 162, 232, .6) 80%, rgba(242, 162, 232, .8) 80%),
                linear-gradient(180deg, rgba(254, 163, 170, 0) 20%, rgba(254, 163, 170, .4) 20%, rgba(254, 163, 170, .4) 40%, rgba(254, 163, 170, .6) 40%, rgba(254, 163, 170, .6) 60%, rgba(254, 163, 170, .8) 60%, rgba(254, 163, 170, .8) 80%, rgba(254, 163, 170, .9) 80%);
            background-color: #ef233c;
            background-size: 100% 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        header {
            padding: 20px;
            text-align: center;
        }

        header h1 {
            color: #ef233c;
            margin: 0;
            font-size: 40px;
        }

        main {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        main h2 {
            color: #ef233c;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .box {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 13px;
        }
    </style>

</head>

<body>
    <header>
        <h1>Quiz Title</h1>
    </header>
    <main>
        <h2 id="title" style="text-align: center;">
            <?php
            if ($_POST['step'] != null) {
                if ((int)$_POST['step'] > $number_of_slides) {
                    echo "Results";
                } else {
                    echo "Question " . $_POST['step'] . " of " . $number_of_slides;
                }
            } ?></h2>

        <form action="./index.php" method="post">
            <?php switch ($_POST['step']) {
                case '1': ?>
                    <p>Enter your height: </p>
                    <br><input type="number" class="box" name="height" min="30" max="250" step="1" title="Enter your height (in centimeters)" oninvalid="this.setCustomValidity('Enter your height (in centimeters)')" onchange="this.setCustomValidity('')" required><br>
                    <p>Enter your weight: </p>
                    <br><input type="number" class="box" name="weight" min="1" max="300" step="1" title="Enter your weight (in kilograms)" oninvalid="this.setCustomValidity('Enter your weight (in kilograms)')" onchange="this.setCustomValidity('')" required><br>
                    <input type="hidden" name="step" value="2">
                <?php break;
                case '2': ?>
                    <p>Question 2...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="3">
                    </div><br>
                <?php break;
                case '3': ?>
                    <p>Question 3...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="4">
                    </div><br>
                <?php break;
                case '4': ?>
                    <p>Question 4...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="5">
                    </div><br>
                <?php break;
                case '5': ?>
                    <p>Question 5...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="6">
                    </div><br>
                <?php break;
                case '6': ?>
                    <p>Question 6...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="7">
                    </div><br>
                <?php break;
                case '7': ?>
                    <p>Question 7...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="8">
                    </div><br>
                <?php break;
                case '8': ?>
                    <p>Question 8...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="9">
                    </div><br>
                <?php break;
                case '9': ?>
                    <p>Question 9...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="10">
                    </div><br>
                <?php break;
                case '10': ?>
                    <p>Question 10...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="11">
                    </div><br>
                <?php break;
                case '11': ?>
                    <p>Question 11...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="12">
                    </div><br>
                <?php break;
                case '12': ?>
                    <p>Question 12...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="13">
                    </div><br>
                <?php break;
                case '13': ?>
                    <p>Question 13...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="14">
                    </div><br>
                <?php break;
                case '14': ?>
                    <p>Question 14...</p>
                    <div class="wrapper">
                        <input type='radio' name='answer' id="option-1" value='no' required oninvalid="this.setCustomValidity('Please select an option')" onfocus="this.setCustomValidity('')">
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>No</span>
                        </label>
                        <input type='radio' name='answer' id="option-2" value='yes'>
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Yes</span>
                        </label>
                        <input type="hidden" name="step" value="15">
                    </div><br>
                <?php break;
                case '15': ?>
                    <?php
                    $data = "Name: " . $_SESSION['name'] .
                        "\nAge: " . $_SESSION['age'] .
                        "\nGender: " . $_SESSION['gender'] .
                        "\nScore: " . $_SESSION['score'] .
                        "\nPhone: " . $_SESSION['tel'];
                    writeDataToFile($data, './list/');
                    if ((int)$_SESSION['score'] <= 10) {
                        echo "<p>You scored <strong>less than 10</strong></p>";
                    } elseif ((int)$_SESSION['score'] <= 30) {
                        echo "<p>You scored <span style=\"color:orange\">above 10</span></p>";
                    } elseif ((int)$_SESSION['score'] <= 50) {
                        echo "<p>You scored <span style=\"color:red\">above 30</span></p>";
                    } elseif ((int)$_SESSION['score'] > 50) {
                        echo "<p>You scored <span style=\"color:red\">above 50</span></p>";
                    }
                    break;
                    ?>
                <?php
                default:
                ?>
                    <!-- THE FOLLOWING IS THE FIRST PAGE SHOWN TO THE USER -->
                    <p>Please enter your ID:</p>
                    <label for="name">Name: </label><br><input class="box" type="text" name="name" title="Please enter your name..." required oninvalid="this.setCustomValidity('Please enter your name...')" onchange="this.setCustomValidity('')"><br>

                    <fieldset class="wrapper" required oninvalid="this.setCustomValidity('Please select one option');" onfocus="this.setCustomValidity('')">
                        <legend>Gender:</legend>
                        <input type="radio" id="option-1" name="gender" value="female" required>
                        <label class="option option-1" for="option-1">
                            <div class="dot"></div>
                            <span>Female</span>
                        </label>
                        <input type="radio" id="option-2" name="gender" value="male">
                        <label class="option option-2" for="option-2">
                            <div class="dot"></div>
                            <span>Male</span>
                        </label>
                    </fieldset><br>

                    <label for="age">Age: </label><br><input class="box" type="number" name="age" min="1" max="100" step="1" title="Please enter your age (in numbers)" oninvalid="this.setCustomValidity('Please enter your age (in numbers)')" onchange="this.setCustomValidity('')" required><br>
                    <input type="hidden" name="step" value="1">

                    <label for="tel">Tel: </label><br><input class="box" id="tel"
                    placeholder="09123456789" type="text" name="tel" min="1" max="100" step="1"
                    oninvalid="this.setCustomValidity('Please enter your phone number')"
                    onchange="this.setCustomValidity('')"
                    title="Please enter your phone number correctly" required><br>
            <?php
                    break;
            }
            if ((int)$_POST['step'] <= $number_of_slides) {
                echo "<input type=\"submit\" value=\"Next\">";
            } ?>
        </form>
    </main>
</body>
</html>
