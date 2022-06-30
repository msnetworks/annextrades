<?php
@session_start();

include_once "settings.inc.php";

// Returns language key
function lang_key($key)
{
    global $arrLang;
    $output = "";
    
    if (isset($arrLang[$key])) {
        $output = $arrLang[$key];
    } else {
        $output = str_replace("_", " ", $key);
    }
    return $output;
}

include_once "languages.inc.php";

if (file_exists(CONFIG_FILE_PATH)) {
    echo '<meta http-equiv="refresh" content="0; url=../" />';
    exit;
}

function head()
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project SECURITY - <?php
    echo lang_key("installation_wizard");
?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <meta charset="utf-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>

    <div class="container">
        <div class="page-header">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10">
                    <br /><center><h3><i class="fab fa-get-pocket"></i> Project SECURITY - <?php
    echo lang_key("installation_wizard");
?></h3></center><br />
                        <div class="jumbotron">
<?php
}

function footer()
{
?>
                        </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php
}
?>