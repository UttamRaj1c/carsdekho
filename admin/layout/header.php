<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard | CarsDekho</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #212529;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: #adb5bd;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #0d6efd;
            color: #fff;
        }

        .main-content {
            margin-left: 250px;
            padding: 25px;
        }

        .card {
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(192, 168, 168, 0.15);
        }
.bg-light{
    background: #fff;
}

        .topbar {
            background: #fff;
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        @media(max-width:768px){
            .sidebar{
                width:100%;
                height:auto;
                position:relative;
            }
            .main-content{
                margin-left:0;
            }
        }
    </style>
    
    <style>
       
        .card {
            border-radius: 15px;
        }
        img.banner-preview {
            width: 150px;
            border-radius: 10px;
        }
    </style>
</head>

<body>