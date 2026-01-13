<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:login.php");
    exit;
}

include '../db.php';

if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = $_POST['type'];
    $img  = time() . '_' . $_FILES['img']['name'];
    $tmp  = $_FILES['img']['tmp_name'];

    if (!empty($img)) {
        move_uploaded_file($tmp, "../assets/uploads/" . $img);
        mysqli_query(
            $conn,
            "INSERT INTO cars(name,image,type) VALUES('$name','$img','$type')"
        );
    }
}


if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    $q = mysqli_query($conn, "SELECT image FROM cars WHERE id=$id");
    if ($row = mysqli_fetch_assoc($q)) {
        if (file_exists("../assets/uploads/" . $row['image'])) {
            unlink("../assets/uploads/" . $row['image']);
        }
    }

    mysqli_query($conn, "DELETE FROM cars WHERE id=$id");
    header("location:add-car.php");
    exit;
}


if (isset($_POST['update'])) {
    $id   = (int)$_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = $_POST['type'];

    if (!empty($_FILES['img']['name'])) {
        $img = time() . '_' . $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];
        move_uploaded_file($tmp, "../assets/uploads/" . $img);
        mysqli_query($conn, "UPDATE cars SET image='$img' WHERE id=$id");
    }

    mysqli_query($conn, "UPDATE cars SET name='$name', type='$type' WHERE id=$id");
    header("location:add-car.php");
    exit;
}


$cars = mysqli_query($conn, "SELECT * FROM cars ORDER BY id DESC");

include 'layout/header.php';
include 'layout/sidebar.php';
?>

<div class="main-content">
    <div class="topbar d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Manage Cars</h4>
        <span class="text-muted">Welcome, Admin</span>
    </div>

    <div class="content">

        
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="mb-3">Add New Car</h5>

                <form method="post" enctype="multipart/form-data" class="row g-3">
                    <div class="col-md-4">
                        <input name="name" class="form-control" placeholder="Car Name" required>
                    </div>

                    <div class="col-md-4">
                        <select name="type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="searched">Most Searched</option>
                            <option value="latest">Latest</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <input type="file" name="img" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <button name="add" class="btn btn-primary">Save Car</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- CAR LIST -->
        <div class="card shadow">
            <div class="card-body">
                <h5 class="mb-3">Car List</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Preview</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php if (mysqli_num_rows($cars) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($cars)) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>
                                        <img src="../assets/uploads/<?= htmlspecialchars($row['image']) ?>"
                                             style="width:120px;border-radius:8px;">
                                    </td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= ucfirst($row['type']) ?></td>
                                    <td>
                                        
                                        <form method="post" enctype="multipart/form-data" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                                            <select name="type">
                                                <option value="searched" <?= $row['type']=='searched'?'selected':'' ?>>Most Searched</option>
                                                <option value="latest" <?= $row['type']=='latest'?'selected':'' ?>>Latest</option>
                                            </select>
                                            <input type="file" name="img">
                                            <button name="update" class="btn btn-sm btn-primary">Update</button>
                                        </form>

                                    
                                        <a href="add-car.php?delete=<?= $row['id'] ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Delete this car?')">
                                           Delete
                                        </a>
                                    </td>
                                </tr>
                        <?php }
                        } else { ?>
                            <tr>
                                <td colspan="5" class="text-center">No cars found</td>
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
