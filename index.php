<html>
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
            .myLink {display: none}
        </style>


        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>

	<body>


    <!-- Navigation Bar -->
    <div class="w3-bar w3-white w3-border-bottom w3-xlarge">
        <a href="#" class="w3-bar-item w3-button w3-text-red w3-hover-red"><b>Slug Generator</b></a>
    </div>

    <!-- Header -->
    <!-- Header -->
    <header class="w3-display-container w3-content w3-hide-small" style="max-width:1500px">
        <img class="w3-image" src="london.jpg" alt="London" width="1500" height="700">
        <div class="w3-display-middle" style="width:65%;">


            <form id="slug-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-group">
                    <input id="input-slug" type="text" name="input-text" class="form-control" aria-describedby="emailHelp" placeholder="Enter a text"  <?php if(isset($_POST['input-text']) === true){echo 'value="'.$_POST['input-text'].'"';} ?>">
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="check-underscore" name="underscore">
                    <label class="form-check-label" for="exampleCheck1" style="font-size: 15px; color: white">Seperate with underscore</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="check-dash" name="dash">
                    <label class="form-check-label" for="exampleCheck1" style="font-size: 15px; color: white">Seperate with Dash</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="check-number" name="number">
                    <label class="form-check-label" for="exampleCheck1" style="font-size:15px; color: white">Remove Numbers</label>
                </div>

                <button type="submit" class="btn btn-primary">Generate Slug</button>

                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $text = null;
                    $number = null;
                    $divider = '-';
                    if (isset($_POST['input-text'])) {
                        $text = $_POST['input-text'];
                    }

                    if (isset($_POST['underscore']))
                        $divider = '_';
                    }

                    if (isset($_POST['dash'])) {
                        $divider = '-';
                    }

                    if (isset($_POST['number'])) {
                        $number = $_POST['number'];
                    }
                }

                if (isset($text)) {
                    if ($number != null) {
                        $text = strtolower(trim(preg_replace('/[^A-Za-z-]+/', $divider, $text)));
                    } else {
                        $text = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', $divider, $text)));
                    }

                    if ($text[strlen($text) - 1] == $divider) {
                        $text = mb_substr($text, 0, -1);
                    }

                    if (empty($text)) {
                        return 'n-a';
                    }

                }

                ?>

            </form>


            <input id="output-field" type="text" name="input-text" class="form-control" style="margin-bottom: 10px;" aria-describedby="emailHelp" placeholder="Output: Clean Slug URL"  <?php if(isset($text) === true){echo 'value="'.$text.'"';} ?>" >


            <div>
                <button type="button" onclick="resetField()" class="btn btn-danger">Reset</button>
                <button type="button" onclick="clearField()" class="btn btn-warning">Clear</button>
                <button type="button" onclick="copySlug()" class="btn-copy btn btn-secondary">Copy</button>
            </div>

        </div>
    </header>


    </body>

    <script>

        const checkboxUnderscore = document.getElementById('check-underscore')
        const checkboxDash = document.getElementById('check-dash')
        const copyTextarea = document.getElementById("output-field")
        const numberCheck = document.getElementById('check-number')

        checkboxDash.checked = true;

        checkboxUnderscore.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                checkboxDash.checked = false;
            }
        })


        checkboxDash.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                checkboxUnderscore.checked = false;
            }
        })


        function resetField() {
            document.getElementById("slug-form").reset();
            document.querySelector("#output-field").value = "";
            document.querySelector("#input-slug").value = "";
            checkboxDash.checked = true;
        }

        function clearField() {
            console.log("clear");
            document.querySelector("#input-slug").value = "";
        }


        function copySlug() {
            copyTextarea.select();
            navigator.clipboard.writeText(copyTextarea.value);
        }

    </script>
</html>
