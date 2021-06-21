<?php

    if (isset($_POST['btn'])) {
        extract($_REQUEST);
        $file_name = $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], '../image/' . $file_name);
        $body = "
        Dear $username,
        <br>
        $body
        ";
        require_once('send.php');
    }

    ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <!--using-fontAwesome------------>
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="contact-all">
        <header>
            <?php
            require_once "../layout/header.php"
            ?>
        </header>
        <h3>Contact - Us</h3>
        <div class="icon-alls">
            <div class="freeship">
                <center><img src="../image/icon1.jpg" width="200px" alt=""></center>
                <h4>
                    Nationwide shipment</h4>
                <p>
                    Nationwide shipment. Fast ship 2-3 days</p>
            </div>
            <div class="customer">
                <center><img src="../image/icon2.jpg" width="200px" alt=""></center>
                <h4>

                    Customer support</h4>
                <p>
                    24/7 customer support. Right and always all the time</p>
            </div>
            <div class="gift">
                <center><img src="../image/icon3.1.jpg" width="200px" alt=""></center>
                <h4>

                    Free flower package</h4>
                <p>
                    Free flower package. Give love and happiness to every family</p>
            </div>
        </div>
        <section id="contact">

            <div class="social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-dribbble"></i></a>

            </div>
            <div class="contact-box">
                <div class="heading">
                    <h1>Contacts Us</h1>
                    <p>Call Or Email Us Regarding Question Or Issues</p>
                </div>
                <div class="inputs">
                    <form method="post" enctype="multipart/form-data">
                        <input type="text" name="username" placeholder="Full Name"  required>
                        <input type="email" name="email" placeholder="Example@gmail.com" required>
                        <input type="text"  name="subject" placeholder="Enter Subject" required>
                        <input type="file" name="file" id="">
                        <textarea  name="body" placeholder="Write Message"></textarea>
                        <button type="submit" name="btn">SEND</button>
                    </form>
                </div>

            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.976224811043!2d105.76336201398163!3d21.033637285995745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454c7ebc5b257%3A0xcf9979f255d8a6b5!2zUGjhu5EgTmd1eeG7hW4gQ8ahIFRo4bqhY2gsIE3hu7kgxJDDrG5oIDEsIE3hu7kgxJDDrG5oIDIsIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1606163785993!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </section>

        <footer>
            <?php
            require_once "../layout/footer.php"
            ?>
        </footer>
    </div>
</body>

</html>