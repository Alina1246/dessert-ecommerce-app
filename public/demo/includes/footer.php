<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cartCount = 0;

// Calculăm numărul total de produse din coș
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
}
?>
<?php require_once('includes/header.php'); ?>
</head>


  
    <div class="site-footer text-center py-2">
        <p>© Copyright <?php echo 'DeserturiDeVis'; ?>. Toate drepturile sunt rezervate. <?php echo date('Y'); ?></p>
    </div>

    <script>
        const footer = document.querySelector('.site-footer');

        function toggleFooter() {
            const scrollHeight = document.documentElement.scrollHeight;
            const clientHeight = document.documentElement.clientHeight;
            const scrollTop = document.documentElement.scrollTop || window.pageYOffset;

            if (scrollHeight <= clientHeight || scrollTop + clientHeight >= scrollHeight - 10) {
                footer.style.bottom = '0';
            } else {
                footer.style.bottom = '-100%';
            }
        }

        window.addEventListener('load', toggleFooter);
        window.addEventListener('scroll', toggleFooter);
    </script>

</body>
</html>


