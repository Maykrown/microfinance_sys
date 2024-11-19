<?php
include('connection.php');

$error = array(); // Array to store validation errors
$showModal = false; // To control modal visibility in HTML

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate inputs
    if (empty($_POST['fname'])) {
        $error['fname'] = 'Firstname is required';
    } else {
        $fname = htmlspecialchars($_POST['fname']);
    }

    if (empty($_POST['lname'])) {
        $error['lname'] = 'Lastname is required';
    } else {
        $lname = htmlspecialchars($_POST['lname']);
    }

    if (empty($_POST['birth'])) {
        $error['birth'] = 'Birthdate is required';
    } else {
        $birth = htmlspecialchars($_POST['birth']);
    }

    if (empty($_POST['age'])) {
        $error['age'] = 'Age is required';
    } else {
        $age = htmlspecialchars($_POST['age']);
    }

    if (empty($_POST['phone'])) {
        $error['phone'] = 'Phone number is required';
    } else {
        $phone = htmlspecialchars($_POST['phone']);
    }

    if (empty($_POST['email'])) {
        $error['email'] = 'Email is required';
    } else {
        $email = htmlspecialchars($_POST['email']);
        // Apply email validation filter
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Invalid email format';
        }
    }

    if (empty($_POST['address'])) {
        $error['address'] = 'Address is required';
    } else {
        $address = htmlspecialchars($_POST['address']);
    }

    if (empty($_POST['job'])) {
        $error['job'] = 'Job title is required';
    } else {
        $job = htmlspecialchars($_POST['job']);
    }

    if (empty($_POST['department'])) {
        $error['department'] = 'Department is required';
    } else {
        $department = htmlspecialchars($_POST['department']);
    }

    if (empty($_POST['job_description'])) {
        $error['job_description'] = 'Job description is required';
    } else {
        $job_description = htmlspecialchars($_POST['job_description']);
    }

    if (empty($_POST['skills'])) {
        $error['skills'] = 'Skills are required';
    } else {
        $skills = htmlspecialchars($_POST['skills']);
    }

    if (empty($_POST['Qualification'])) {
        $error['Qualification'] = 'Qualifications are required';
    } else {
        $Qualification = htmlspecialchars($_POST['Qualification']);
    }

    // If no errors, insert data into the database
    if (empty($error)) {
        $sql = "INSERT INTO employee_list (fname, lname, birth, age, phone, email, address, job, department, job_description, skills, Qualification) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters
            $stmt->bind_param("ssssssssssss", $fname, $lname, $birth, $age, $phone, $email, $address, $job, $department, $job_description, $skills, $Qualification);

            // Execute the statement
            if ($stmt->execute()) {
                $showModal = true;
                unset($_POST); // Clear form data after submission
            } else {
                // Display error message if the insert fails
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
        <title>Dashboard - SB Admin</title>
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
                                                <input type="text" id="fname" name="fname" class="form-control" value="<?= isset($fname) ? $fname : ''; ?>" placeholder="Enter First Name">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="lname" class="form-label">Last Name</label>
                                                <input type="text" id="lname" name="lname" class="form-control" value="<?= isset($lname) ? $lname : ''; ?>" placeholder="Enter Last Name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="birth" class="form-label">Birthday</label>
                                                <input type="date" id="birth" name="birth" class="form-control" value="<?= isset($formData['birth']) ? $formData['birth'] : ''; ?>" placeholder="Enter Birthday">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="number" id="age" name="age" class="form-control" value="<?= isset($formData['age']) ? $formData['age'] : ''; ?>" placeholder="Enter Age">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="tel" id="phone" name="phone" class="form-control" value="<?= isset($formData['phone']) ? $formData['phone'] : ''; ?>" placeholder="Enter Phone Number">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" value="<?= isset($formData['email']) ? $formData['email'] : ''; ?>" placeholder="Enter Email Address">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter Address"><?= isset($formData['address']) ? $formData['address'] : ''; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="job" class="form-label">Job Title</label>
                                            <input type="text" id="job" name="job" class="form-control" value="<?= isset($formData['job']) ? $formData['job'] : ''; ?>" placeholder="Enter Job Title">
                                        </div>

                                        <div class="mb-3">
                                            <label for="department" class="form-label">Department</label>
                                            <input type="text" id="department" name="department" class="form-control" value="<?= isset($formData['department']) ? $formData['department'] : ''; ?>" placeholder="Enter Department">
                                        </div>

                                        <div class="mb-3">
                                            <label for="job_description" class="form-label">Job Description</label>
                                            <textarea id="job_description" name="job_description" class="form-control" rows="3" placeholder="Enter Job Description"><?= isset($formData['job_description']) ? $formData['job_description'] : ''; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="skills" class="form-label">Skills</label>
                                            <textarea id="skills" name="skills" class="form-control" rows="3" placeholder="Enter Skills"><?= isset($formData['skills']) ? $formData['skills'] : ''; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="qualifications" class="form-label">Qualifications</label>
                                            <textarea id="qualifications" name="qualifications" class="form-control" rows="3" placeholder="Enter Qualifications"><?= isset($formData['qualifications']) ? $formData['qualifications'] : ''; ?></textarea>
                                        </div>

                                        <button type="submit"  class="btn btn-primary w-100">Submit</button>
                                    </form>

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
        <?php if ($showModal): ?>
        <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg text-center">
                <h2 class="text-xl font-bold mb-4">Successful!</h2>
                <div class="flex justify-center space-x-4">
                    <button id="closeModal" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Close</button>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('closeModal').addEventListener('click', function () {
                    document.getElementById('successModal').style.display = 'none';
                });
            });
        </script>
       <?php endif; ?>
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
