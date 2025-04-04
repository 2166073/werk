<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Ter Duin</title>
    <link rel="stylesheet" href="styles/homestyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap"rel="stylesheet"><link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Header -->
    <div class="banner">
        <div class="navbar">
            <img src="images/logo.jpg" class="logo">

        <ul>
            <li><a href="homepage.php">HOME</a></li>
            <li><a href="klantenservice.php">KLANTENSERVICE</a></li>
            <li><a href="login.php">INLOGGEN</a></li>
        </ul>
    </div>

    <!-- Hero Sectie -->
    <section id="home" class="hero">
        <div class="hero-slideshow">
            <img src="images/hotel1.jpg" class="slide active" alt="Hotel Image 1">
            <img src="images/hotel2.jpg" class="slide" alt="Hotel Image 2">
            <img src="images/hotel3.jpg" class="slide" alt="Hotel Image 3">
            <img src="images/hotel4.jpg" class="slide" alt="Hotel Image 4">
            <img src="images/hotel5.jpg" class="slide" alt="Hotel Image 5">
            <img src="images/hotel6.jpg" class="slide" alt="Hotel Image 6">
        </div>
        <div class="hero-overlay">
            <h2>Welkom bij Hotel Ter Duin</h2>
            <p>Geniet van luxe en comfort aan de kust.</p>
            <a href="boeking.php" class="btn-primary">Boek Nu</a>
        </div>
    </section>

    <!------------------------------------------------------->

   <section class="overons">
       <h1>Weetjes over de Hotel</h1>
       <p>Hotel Ter Duin biedt een unieke ervaring met luxe kamers, heerlijke gerechten en een adembenemend uitzicht op zee</p>

         <div class="row">
            <div class="overons-col">
                <h3>geschiedenis</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dicta ipsum, molestiae iusto obcaecati officia itaque eius qui consectetur, 
                    placeat atque cumque eligendi, ab vel? Est, neque! Porro, quam odit.</p>
            </div>

            <div class="overons-col">
                <h3>kamers</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dicta ipsum, molestiae iusto obcaecati officia itaque eius qui consectetur, 
                    placeat atque cumque eligendi, ab vel? Est, neque! Porro, quam odit.</p>
            </div>

            <div class="overons-col">
                <h3>restaurant en bar</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dicta ipsum, molestiae iusto obcaecati officia itaque eius qui consectetur, 
                    placeat atque cumque eligendi, ab vel? Est, neque! Porro, quam odit.</p>
            </div>
         </div>
   </section>
<!---------------------------------------------------------->

<!---------------------------------------------------------->

   <section class="fotos">


        <div class="row">
            <div class="fotos-col">
                <img src="images/hotel11.jpg">
                <div class="layer">
                    <h3>ROOM SERVICE</h3>
                </div>
            </div>
   

       <div class="fotos-col">
                <img src="images/hotel7.jpg">
                <div class="layer">
                    <h3>HOTEL KAMER</h3>
                </div>
            </div>
        

        <div class="fotos-col">
                <img src="images/hotel8.jpg">
                <div class="layer">
                    <h3>RECEPTIE</h3>
                </div>
            </div>
        </div>
   </section>


<!---------------------------------------------------------->

<!----------------------------------------------------------->

<section class="review">
        <h1>Revieuw van klanten</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis esse illum?</p>

         <div class="row">
            <div class="review-col">
                <img src="images/user1.jpg">
                <div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Eveniet et consectetur suscipit recusandae placeat iure, velit eos provident expedita odit ipsam,
                        quae nisi. Illo, dolores. Ipsum ipsam veritatis iste. Odio. </p>
                    <h3>Anna van de vlissingen</h3>
                    <i class="fa fa-star"></i>                   
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>

                </div>
            </div>

            <div class="review-col">
                <img src="images/user2.jpg">
                <div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Eveniet et consectetur suscipit recusandae placeat iure, velit eos provident expedita odit ipsam,
                        quae nisi. Illo, dolores. Ipsum ipsam veritatis iste. Odio. </p>
                    <h3>Robin hengelen </h3>
                    <i class="fa fa-star"></i>                   
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
            </div>
         </div>
</section>

<!------------------------------------------------------------>

<!------------------------------------------------------------->
<section class="cta" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/hotel12.jpg');">
    <h1>Meer lezen over onze services binnen ons Hotel</h1>
    <a href="overons.php" class="hero-btn">Lees hier verder</a>
</section>

<!------------------------------------------------------------->

<!------------------------------------------------------------->

<section class="footer">
    <h4>about us</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus asperiores quis enim tempora odio perspiciatis rerum,<br>
         ratione placeat accusamus laboriosam doloribus consequatur temporibus nobis amet ex quam veniam cumque obcaecati.</p>
     <div class="icons">                
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-instagram"></i>
                    <i class="fa fa-linkedin"></i>

     </div>

</section>
<!------------------------------------------------------------->

<!-----Javascript for hamburger menu--->
    <script>
        var navLinks = document.getElementById("navLinks");

        function showMenu(){
            navLinks.style.right = "0";
        }
        function hideMenu(){
            navLinks.style.right= "none";
            navLinks.style.right = "-200px";
        }
    </script>



</body>
</html>













    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Hotel Ter Duin - Alle rechten voorbehouden</p>
    </footer>

    <script src="javascript/script.js"></script>
</body>
</html>