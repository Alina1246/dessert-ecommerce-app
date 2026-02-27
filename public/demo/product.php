<?php
session_start(); 

require_once('includes/header.php');


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

    // Verificăm dacă ID-ul produsului este valid
    $productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$productId) {
        echo "<p>Produs invalid sau inexistent.</p>";
        require_once('includes/footer.php');
        exit;
    }

    // Preluarea detaliilor produsului
    $stmt = $pdo->prepare("SELECT * FROM produse WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch();

    if ($product): ?>
        <div class="container">
            <!-- Container pentru imagine și text -->
            <div class="product-container">
               
                <img src="<?php echo htmlspecialchars($product['url_imagine']); ?>" 
                     alt="<?php echo htmlspecialchars($product['nume']); ?>" 
                     class="product-image-detail">

                
                <div class="product-text">
                    <h4><?php echo htmlspecialchars($product['nume']); ?></h4>
                    <p><?php echo htmlspecialchars($product['descriere']); ?></p>
                    <p>Greutate: <?php echo htmlspecialchars($product['greutate']); ?></p>
                    <p>Ingrediente: <?php echo htmlspecialchars($product['ingrediente']); ?></p>
                    <p>Preț: <?php echo htmlspecialchars($product['pret']); ?></p>

                    <!-- Buton Adaugă în coș -->
                    <form action="adauga_in_cos.php" method="POST"class="mt-4">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['nume']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['pret']; ?>">
                        <button type="submit" class="btn btn-primary">Adaugă în coș</button>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Produsul nu a fost găsit.</p>
    <?php endif;

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

require_once('includes/footer.php');
?>






