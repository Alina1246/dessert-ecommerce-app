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

    // Obținerea produselor
    $stmt = $pdo->query("SELECT id, nume, url_imagine FROM produse"); 
    $produse = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!-- Sectiune cu produsele cofetarie--> 
<section class="products-section mt-5 mb-5">
    <div class="container">
        <div class="row">
           
                <?php foreach ($produse as $produs): ?>
                    <div class="col-md-3 col-sm-6 product-item mb-4">
                       
                        <div class="card h-100 custom-card">
                      
                            <img src="<?php echo htmlspecialchars($produs['url_imagine']); ?>" 
                                 alt="<?php echo htmlspecialchars($produs['nume']); ?>" 
                                 class="card-img-top">
                          
                            <div class="card-body">
                             
                                <h5 class="card-title"><?php echo htmlspecialchars($produs['nume']); ?></h5>
                               
                                <a href="product.php?id=<?php echo htmlspecialchars($produs['id']); ?>" 
                                   class="btn w-100">Vezi Detalii</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
           
        </div>
    </div>
</section>

<?php require_once('includes/footer.php'); ?>


