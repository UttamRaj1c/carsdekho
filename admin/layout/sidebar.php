<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
    <h4 class="text-center text-white mb-4">CarsDekho</h4>

    <a href="dashboard.php" class="<?= ($currentPage == 'dashboard.php') ? 'active' : '' ?>">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    <a href="add-banner.php" class="<?= ($currentPage == 'add-banner.php') ? 'active' : '' ?>">
        <i class="bi bi-image me-2"></i> Manage Banners
    </a>

    <a href="add-car.php" class="<?= ($currentPage == 'add-car.php') ? 'active' : '' ?>">
        <i class="bi bi-car-front me-2"></i> Manage Cars
    </a>

    <a href="logout.php">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>
</div>
