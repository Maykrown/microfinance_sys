<?php
include('connection.php');

$error = array(); // Array to store validation errors
$showModal = false; // To control modal visibility in HTML

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate inputs
    $fname = !empty($_POST['fname']) ? htmlspecialchars($_POST['fname']) : $error['fname'] = 'Firstname is required';
    $lname = !empty($_POST['lname']) ? htmlspecialchars($_POST['lname']) : $error['lname'] = 'Lastname is required';
    $birth = !empty($_POST['birth']) ? htmlspecialchars($_POST['birth']) : $error['birth'] = 'Birthdate is required';
    $age = !empty($_POST['age']) ? htmlspecialchars($_POST['age']) : $error['age'] = 'Age is required';
    $phone = !empty($_POST['phone']) ? htmlspecialchars($_POST['phone']) : $error['phone'] = 'Phone number is required';

    if (!empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Invalid email format';
        }
    } else {
        $error['email'] = 'Email is required';
    }

    $address = !empty($_POST['address']) ? htmlspecialchars($_POST['address']) : $error['address'] = 'Address is required';
    $job = !empty($_POST['job']) ? htmlspecialchars($_POST['job']) : $error['job'] = 'Job title is required';
    $department = !empty($_POST['department']) ? htmlspecialchars($_POST['department']) : $error['department'] = 'Department is required';
    $job_description = !empty($_POST['job_description']) ? htmlspecialchars($_POST['job_description']) : $error['job_description'] = 'Job description is required';
    $skills = !empty($_POST['skills']) ? htmlspecialchars($_POST['skills']) : $error['skills'] = 'Skills are required';
    $qualifications = !empty($_POST['qualifications']) ? htmlspecialchars($_POST['qualifications']) : $error['qualifications'] = 'Qualifications are required';

    // If no errors, insert data into the database
    if (empty($error)) {
        $sql = "INSERT INTO employee_list (fname, lname, birth, age, phone, email, address, job, department, job_description, skills, Qualification) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters
            $stmt->bind_param("ssssssssssss", $fname, $lname, $birth, $age, $phone, $email, $address, $job, $department, $job_description, $skills, $qualifications);

            // Execute the statement
            if ($stmt->execute()) {
               echo"<script>alert('successfully submitted')</script>";
               unset($_POST);
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing query: " . $conn->error . "');</script>";
        }
    }

    // Close the connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Microfinance</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php require "navbar.php";?>
        <?php require "sidebar.php";?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-lg">
                                <div class="card-header bg-primary text-white text-center">
                                    <h4 class="mb-0">Employee Personal Information</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="fname" class="form-label">First Name</label>
                                                <input type="text" id="fname" name="fname" class="form-control" value="<?= isset($fname) ? $fname : ''; ?>" placeholder="">
<span class="text-danger"><?= isset($error['fname']) ? $error['fname'] : ''; ?></span>

                                                    
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="lname" class="form-label">Last Name</label>
                                                <input type="text" id="lname" name="lname" class="form-control" value="<?= isset($lname) ? $lname : ''; ?>" placeholder="">
<span class="text-danger"><?= isset($error['lname']) ? $error['lname'] : ''; ?></span>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="birth" class="form-label">Birthday</label>
                                                <input type="date" id="birth" name="birth" class="form-control" value="<?= isset($birth) ? $birth : ''; ?>" placeholder="">
                                                <span class="text-danger"><?= isset($error['birth']) ? $error['birth'] : ''; ?></span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="text" id="age" name="age" class="form-control" value="<?= isset($age) ? $age : ''; ?>" placeholder="">
                                                <span class="text-danger"><?= isset($error['birth']) ? $error['age'] : ''; ?></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" id="phone" name="phone" class="form-control" value="<?= isset($phone) ? $phone : ''; ?>" placeholder="">
                                                <span class="text-danger"><?= isset($error['phone']) ? $error['phone'] : ''; ?></span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" id="email" name="email" class="form-control" value="<?= isset($email) ? $email : ''; ?>" placeholder="">
                                                <span class="text-danger"><?= isset($error['email']) ? $error['email'] : ''; ?></span>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" id="address" name="address" class="form-control" value="<?= isset($address) ? $address : ''; ?>" placeholder="">
                                            <span class="text-danger"><?= isset($error['address']) ? $error['address'] : ''; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="job" class="form-label">Job Title</label>
                                            <input type="text" id="job" name="job" class="form-control" value="<?= isset($job) ? $job : ''; ?>" placeholder="">
                                            <span class="text-danger"><?= isset($error['job']) ? $error['job'] : ''; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="department" class="form-label">Department</label>
                                            <input type="text" id="department" name="department" class="form-control" value="<?= isset($department) ? $department : ''; ?>" placeholder="">
                                            <span class="text-danger"><?= isset($error['department']) ? $error['department'] : ''; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="job_description" class="form-label">Job Description</label>
                                            <input type="text" id="job_description" name="job_description" class="form-control" value="<?= isset($job_description) ? $job_description : ''; ?>" placeholder="">
                                            <span class="text-danger"><?= isset($error['job_description']) ? $error['job_description'] : ''; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="skills" class="form-label">Skills</label>
                                            <input type="text" id="skills" name="skills" class="form-control" value="<?= isset($skills) ? $skills : ''; ?>" placeholder=" ">
                                            <span class="text-danger"><?= isset($error['skills']) ? $error['skills'] : ''; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="qualifications" class="form-label">Qualifications</label>
                                            <input type="text" id="qualifications" name="qualifications" class="form-control" value="<?= isset($qualifications) ? $qualifications : ''; ?>" placeholder="">
                                            <span class="text-danger"><?= isset($error['qualifications']) ? $error['qualifications'] : ''; ?></span>
                                        </div>

                                        <button type="submit"  class="btn btn-primary w-100">Submit</button>
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
                            <a href="#">Privacy Policy</a> &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="chart-area-demo.js"></script>
        <script src="chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="datatables-simple-demo.js"></script>
        <link rel="stylesheet" href="Untitled-23.css">
    </body>
</html>
