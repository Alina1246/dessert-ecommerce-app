<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cartCount = 0; // Inițializare numărul de produse din coș

// Calculăm numărul total de produse din coș
if (isset($_SESSION['cart'])) { // Verificăm dacă sesiunea `cart` există
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity']; // Adunăm cantitatea fiecărui produs
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeserturiDeVis</title>
 
    <link rel="icon" type="image/png" href="images/images1.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
 
</head>
<body>
    <nav class="navbar">
        <div class="container">
           
            <a href="index.php" class="logo">
                <img src="images/images1.png" alt="DeserturiDeVis Logo" style="height: 65px;">
            </a>
            <ul class="nav-links">
                <li><a href="index.php">Acasă</a></li>
                <li><a href="products.php">Produse</a></li>
                <li><a href="about.php">Despre Noi</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Autentificare</a></li>

                <li>
                    <a href="cos.php" class="cart-link">
                        <i class="fas fa-shopping-cart"></i> 
                        <span class="cart-count"><?php echo $cartCount; ?></span> <!-- Numărul real de produse -->
                    </a>
                </li>
            </ul>
            <div class="mobile-menu" id="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <script>
        
        let lastScrollPosition = 0;
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', () => {
            const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScrollPosition > lastScrollPosition && currentScrollPosition > 100) {
             
                navbar.style.transform = 'translateY(-100%)';
            } else {

                navbar.style.transform = 'translateY(0)';
            }
            

            // Actualizează poziția anterioară de scroll
             lastScrollPosition = currentScrollPosition;
        });

    </script>

    
</body>
</html>





