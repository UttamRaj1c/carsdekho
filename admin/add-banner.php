<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:login.php");
    exit;
}

include '../db.php';

if (isset($_POST['add'])) {
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];

    if (!empty($img)) {
        move_uploaded_file($tmp, "../assets/uploads/" . $img);
        mysqli_query($conn, "INSERT INTO banners(image) VALUES('$img')");
    }
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    $q = mysqli_query($conn, "SELECT image FROM banners WHERE id=$id");
    if ($row = mysqli_fetch_assoc($q)) {
        if (file_exists("../assets/uploads/" . $row['image'])) {
            unlink("../assets/uploads/" . $row['image']);
        }
    }

    mysqli_query($conn, "DELETE FROM banners WHERE id=$id");
    header("location:add-banner.php");
    exit;
}


if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];

    if (!empty($img)) {
        move_uploaded_file($tmp, "../assets/uploads/" . $img);
        mysqli_query($conn, "UPDATE banners SET image='$img' WHERE id=$id");
    }

    header("location:add-banner.php");
    exit;
}


$banners = mysqli_query($conn, "SELECT * FROM banners ORDER BY id DESC");

include 'layout/header.php';
include 'layout/sidebar.php';
?>


<div class="main-content">
      <div class="topbar d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Manage Banners</h4>
        <span class="text-muted">Welcome, Admin</span>
    </div>
    
    <div class="content">

        
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="mb-3">Add New Banner</h5>

                <form method="post" enctype="multipart/form-data" class="row g-3">
                    <div class="col-md-6">
                        <input type="file" name="img" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <button name="add" class="btn btn-primary">Upload Banner</button>
                        
                    </div>
                </form>
            </div>
        </div>

    
        <div class="card shadow">
            <div class="card-body">
                <h5 class="mb-3">Banner List</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Preview</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php if (mysqli_num_rows($banners) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($banners)) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>
                                         <img src="../assets/uploads/<?= $row['image'] ?>" class="banner-preview">
                                    </td>
                                    <td>
                                        
                                        <form method="post" enctype="multipart/form-data" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="file" name="img" required>
                                            <button name="update" class="btn btn-sm btn-primary">Update</button>
                                        </form>

                                        
                                        <a href="add-banner.php?delete=<?= $row['id'] ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Delete this banner?')">
                                           Delete
                                        </a>
                                    </td>
                                </tr>
                        <?php }
                        } else { ?>
                            <tr>
                                <td colspan="3" class="text-center">No banners found</td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'layout/footer.php'; ?>
