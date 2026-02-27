<?php require_once('includes/header.php'); ?>
<?php


$host = 'localhost';
$port = '10011';
$db = 'local';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Te rog să completezi toate câmpurile!";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'] ?? 'user';

            header('Location: index.php');
            exit();
        } else {
            $error = "Email sau parolă invalidă!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Autentificare</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Roboto:100,300,400,500,700|Philosopher:400,400i,700,700i" rel="stylesheet">

  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

  <!--login section start -->

  <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Autentificare</h2>
                <p class="text-center text-white-100 mb-5">Vă rugăm introduceți email-ul și parola!</p>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="form group">
                        <label>Parolă</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                
                    <div class="d-flex justify-content-center my-3"><button type="submit" class="btn btn-outline-light btn-lg px-5">Autentifică-te</button></div>
                </form>
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger mt-3">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                
                <p class="text-center mb-0">Nu aveți cont? <a href="register.php" class="text-pink fw-bold">Înregistrează-te</a>
                </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.0.0.min.js"></script>
  <script src="js/plugin.js"></script>

  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/custom.js"></script>
  
  <script src="js/owl.carousel.js"></script>
  <script>
     if ( $(window).width() > 990) { 
     
      $('.owl-carousel').owlCarousel({
         stagePadding: 350,
         loop:true,
         margin:35,
         nav:true,
         responsive:{
             0:{
                 items:1
             },
             600:{
                 items:1
             },
             1000:{
                 items:1
             }
         }
     })
     
      }
     
     
     
      else { 
     
      $('.owl-carousel').owlCarousel({
         stagePadding: 70,
         loop:true,
         margin:10,
         nav:true,
         responsive:{
             0:{
                 items:1
             },
             600:{
                 items:1
             },
             1000:{
                 items:1
             }
         }
     })
     
       }    
   
  </script>
  <script type="text/javascript">
     $(window).scroll(function(){
     var sticky = $('#navbar'),
     scroll = $(window).scrollTop();
     
     if (scroll >= 600) sticky.addClass('fix-nav');
     else sticky.removeClass('fix-nav');
     });
  </script>
</body>

</html>

<?php require_once('includes/footer.php'); ?>


