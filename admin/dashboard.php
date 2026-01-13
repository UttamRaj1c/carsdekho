<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:login.php");
    exit;
}
include '../db.php';
include 'layout/header.php';
include 'layout/sidebar.php';


$bannerCount = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM banners")
)['total'];

$carCount = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM cars")
)['total'];


$enquiryCount = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM car_enquiry")
)['total'];

$enquiries = mysqli_query($conn, "SELECT * FROM car_enquiry ORDER BY id DESC");

?>



<div class="main-content">
    <div class="topbar d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Dashboard</h4>
        <span class="text-muted">Welcome, Admin</span>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card bg-light">
                <h5>Total Banners</h5>
                <h2 class="fw-bold"><?= $bannerCount ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <h5>Total Cars</h5>
                <h2 class="fw-bold"><?= $carCount ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <h5>Total Enquiries</h5>
                <h2 class="fw-bold"><?= $enquiryCount ?></h2>
            </div>
        </div>
    </div>

        <div class="row mt-5">
        <div class="col-md-12">
            <h4>Enquiries List</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Car Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($enquiries) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($enquiries)) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['phone']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['address']) ?></td>
                                    <td><?= htmlspecialchars($row['car_type']) ?></td>
                                    <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                                </tr>
                        <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7" class="text-center">No enquiries found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


</div>


<?php 
include 'layout/footer.php';
?>