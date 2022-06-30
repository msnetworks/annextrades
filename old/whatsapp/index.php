<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text],input[type=number], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<style>
.alert {
  padding: 20px;
  background-color: #04AA6D;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
</head>
<body>

    <div class="container">
    <h3 style="text-align: center;">Whatsapp Message</h3>
    <?php if ($_REQUEST['msg'] == 'success') { ?>
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Success!</strong> Your Message Sent Successfully.
    </div>
    <?php }?>
  <form action="whatsapp.php" method="POST">
   <!--  <label for="phone">Phone Number</label>
    <input type="number" id="phone" name="phone" placeholder="Receiver Whatsapp Number..(without +, use country code e.g. (IND) 91, US (1)">
 -->
    <label for="message">Message</label>
    <input name="message" type="text">
    <!-- <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea> -->

    <input type="submit" value="SEND">
  </form>
</div>

</body>
</html>
