<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sidenav Light - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    </head>
    <body class="sb-nav-fixed">
    <?php require "navbar.php";?>
    <?php require "sidebar.php";?>
    <div id="layoutSidenav_content">
                <main>
                <div class="container mt-5">
    <div class="row">
        <!-- Left Column: Profile Card -->
        <div class="col-md-6">
            <div class="card">
                <!-- Profile Image with rounded-circle class -->
                <img src="cat - Copy.jpg" class="card-img-top rounded-circle mx-auto d-block" alt="Profile Picture" style="width: 150px; height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">John Doe</h5>
                    <p class="card-text">Email: johndoe@example.com</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Update Form -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Update Profile</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="updateName" name="name" value="John Doe" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="updateEmail" name="email" value="johndoe@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="updatePassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="updatePassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <link rel="stylesheet" href="Untitled-23.css">
    </body>
</html>
