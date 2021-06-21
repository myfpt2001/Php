 <?php

    if (isset($_POST['btn'])) {
        extract($_REQUEST);
        $file_name = $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], '../image/' . $file_name);
        require_once('send.php');
    }

    ?>



 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 </head>

 <body>
     <h2>Contact</h2>
     <form action="" method="post" enctype="multipart/form-data">
         <input type="text" name="username" placeholder="username"> 
         <p></p>
         <input type="email" name="email" id="" placeholder="email">
         <p></p>
         <input type="text" name="subject" placeholder="chủ đề">
         <p></p>
         <input type="file" name="file" id="">
         <p></p>
         <textarea name="body" id="" cols="30" rows="10"></textarea>
         <p></p>
         <button type="submit" name="btn">Gửi</button>
     </form>
 </body>

 </html>