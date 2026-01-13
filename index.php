<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CarsDekho</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            padding: 15px 30px;
        }

        .hero img {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 10px;
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
        }

        .section-title::after {
            width: 60px;
            height: 4px;
            background: #dc3545;
            display: block;
            margin-top: 8px;
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }

        .enquiry-box {
            background: #f8f9fa;
            padding: 40px;
            border-radius: 20px;
        }

        .form-control {
            border-radius: 10px;
        }

        footer {
            margin-top: 60px;
        }

        @media(max-width: 768px) {
            .card img {
                height: 160px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold fs-4">CarsDekho</a>
    </div>
</nav>

   <?php
    $b = mysqli_query($conn, "SELECT * FROM banners");
    while ($row = mysqli_fetch_assoc($b)) {
    ?>
        <img src="assets/uploads/<?= $row['image'] ?>" class="img-fluid mb-4">
    <?php } ?>


<div class="container mt-5">
    <h3 class="section-title">Most Searched Cars</h3>
    <div class="row g-4">
        <?php
        $c = mysqli_query($conn, "SELECT * FROM cars WHERE type='searched'");
        while ($row = mysqli_fetch_assoc($c)) {
        ?>
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="assets/uploads/<?= $row['image'] ?>">
                    <div class="card-body text-center">
                        <h5 class="fw-bold"><?= $row['name'] ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="container mt-5">
    <h3 class="section-title">Latest Cars</h3>
    <div class="row g-4">
        <?php
        $l = mysqli_query($conn, "SELECT * FROM cars WHERE type='latest'");
        while ($row = mysqli_fetch_assoc($l)) {
        ?>
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="assets/uploads/<?= $row['image'] ?>">
                    <div class="card-body text-center">
                        <h5 class="fw-bold"><?= $row['name'] ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="container mt-5">
    

    <div class="row enquiry-box mt-4">
        <div class="col-md-6">
            <h3 class="section-title">Car Enquiry</h3>
            <p class="text-muted">
                CarsDekho is India’s most trusted car research platform helping users
                make confident car-buying decisions. Explore hatchbacks, sedans, SUVs,
                and luxury cars with ease.
            </p>
            <p class="text-muted">
                Submit your enquiry and our experts will assist you with the best deals
                and offers.
            </p>
        </div>

        <div class="col-md-6">
            <form method="post" action="submit.php" id="enquiryForm">
                <input class="form-control mb-3" name="name" placeholder="Full Name">
                <input class="form-control mb-3" name="phone" placeholder="Mobile Number">
                <input class="form-control mb-3" name="email" placeholder="Email Address">
                <textarea class="form-control mb-3" name="address" placeholder="Address"></textarea>

                <div class="mb-3">
                    <label class="me-3"><input type="checkbox" name="car[]" value="Hatchback"> Hatchback</label>
                    <label class="me-3"><input type="checkbox" name="car[]" value="Sedan"> Sedan</label>
                    <label><input type="checkbox" name="car[]" value="SUV"> SUV</label>
                </div>

                <button class="btn btn-info text-light w-100">Submit Enquiry</button>
            </form>
        </div>
    </div>
</div>


<footer class="bg-dark text-white text-center p-4 mt-5">
    © 2026 CarsDekho.com | All Rights Reserved
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    $('#enquiryForm').on('submit', function (e) {

        let isValid = true;

        $('.error').remove();

        if ($('input[name="name"]').val().trim() === '') {
            $('input[name="name"]').after('<small class="error text-danger">Name is required</small>');
            isValid = false;
        }

        if ($('input[name="phone"]').val().trim() === '') {
            $('input[name="phone"]').after('<small class="error text-danger">Mobile number is required</small>');
            isValid = false;
        }

        let email = $('input[name="email"]').val().trim();
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email === '') {
            $('input[name="email"]').after('<small class="error text-danger">Email is required</small>');
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $('input[name="email"]').after('<small class="error text-danger">Invalid email format</small>');
            isValid = false;
        }

        if ($('textarea[name="address"]').val().trim() === '') {
            $('textarea[name="address"]').after('<small class="error text-danger">Address is required</small>');
            isValid = false;
        }

        if ($('input[name="car[]"]:checked').length === 0) {
            $('.mb-3:last').append('<small class="error text-danger d-block">Please select at least one car type</small>');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

});
</script>



</body>
</html>
