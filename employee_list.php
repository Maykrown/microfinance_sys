<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'update') {
            // Update logic
            $id = $_POST['id'];
            $fname = htmlspecialchars($_POST['fname']);
            $lname = htmlspecialchars($_POST['lname']);
            $birth = htmlspecialchars($_POST['birth']);
            $age = htmlspecialchars($_POST['age']);
            $phone = htmlspecialchars($_POST['phone']);
            $email = htmlspecialchars($_POST['email']);
            $address = htmlspecialchars($_POST['address']);
            $job = htmlspecialchars($_POST['job']);
            $department = htmlspecialchars($_POST['department']);
            $job_description = htmlspecialchars($_POST['job_description']);
            $skills = htmlspecialchars($_POST['skills']);
            $qualifications = htmlspecialchars($_POST['qualifications']);

            $sql = "UPDATE employee_list SET fname = ?, lname = ?, birth = ?, age = ?, phone = ?, email = ?, address = ?, job = ?, department = ?, job_description = ?, skills = ?, Qualification = ? WHERE id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssssssssssssi", $fname, $lname, $birth, $age, $phone, $email, $address, $job, $department, $job_description, $skills, $qualifications, $id);
                if ($stmt->execute()) {
                    echo "<script>alert('Record updated successfully');</script>";
                } else {
                    echo "<script>alert('Error updating record: " . $stmt->error . "');</script>";
                }
                $stmt->close();
            }
        } elseif ($_POST['action'] === 'delete') {
            // Delete logic
            $id = $_POST['id'];
            $sql = "DELETE FROM employee_list WHERE id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    echo "<script>alert('Record deleted successfully');</script>";
                } else {
                    echo "<script>alert('Error deleting record: " . $stmt->error . "');</script>";
                }
                $stmt->close();
            }
        }
    }
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
       <title>Microfinance Management System - Human Resources</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
            
        </style>
    </head>
    <body class="sb-nav-fixed">
    <?php require "navbar.php";?>
    <?php require "sidebar.php";?>
            <div id="layoutSidenav_content">
            <main>
            <div class="card mb-4">
                            <div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">List of Employees</h5>
    </div>
    <div class="card-body">
    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
    <table id="datatablesSimple" class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Birthday</th>
                <th>Age</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Job</th>
                <th>Department</th>
                <th>Skills</th>
                <th>Qualifications</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php
              // Fetch user data from the database
              $sql = "SELECT * FROM employee_list"; // Adjust 'adoption' to your actual table name
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // Loop through each row and output data
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['id'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['fname'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['lname'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['birth'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['phone'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['email'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['address'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['job'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['department'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['job_description'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['skills'] . "</td>";
                      echo "<td class='px-4 py-2 text-center'>" . $row['Qualification'] . "</td>";
                      // Add Action Buttons
                      echo "<td class='py-2 px-2 text-center flex justify-center space-x-2'>";
  
                      // Update button
                      echo "<a href='#' onclick=\"openUpdateRecordModal(
                          '{$row['id']}', 
                          '{$row['fname']}', 
                          '{$row['lname']}', 
                          '{$row['birth']}', 
                          '{$row['phone']}', 
                          '{$row['email']}', 
                          '{$row['address']}', 
                          '{$row['job']}', 
                          '{$row['department']}', 
                          '{$row['job_description']}', 
                          '{$row['skills']}', 
                          '{$row['Qualification']}'
                        )\" 
                        class='btn btn-warning btn-sm text-white'>
                          <i class='fas fa-edit'></i>
                        Update</a>";
                      
                      // Delete button
                      echo "<a href='#' onclick=\"openRecordDeleteModal('{$row['id']}')\" 
                        class='btn btn-danger btn-sm text-white'>  <i class='fas fa-trash-alt'></i> Delete</a>";
                      
                      echo "</td>";
                      
                      
                  }
              } else {
                  echo "<tr><td colspan='14' class='px-4 py-2 text-center'>No users found</td></tr>";
              }
              ?>
        </tbody>
    </table>
</div>

    </div>
</div>
          </main>
          <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST" action="">
  <div class="modal-header">
    <h5 class="modal-title" id="updateModalLabel">Update Employee</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <input type="hidden" name="id" id="updateId">

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="updateFname" class="form-label">First Name</label>
        <input type="text" class="form-control" id="updateFname" name="fname" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="updateLname" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="updateLname" name="lname" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="updateBirth" class="form-label">Birth</label>
        <input type="date" class="form-control" id="updateBirth" name="updateBirth" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="updateAge" class="form-label">Age</label>
        <input type="text" class="form-control" id="updateAge" name="updateAge" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="updatePhone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="updatePhone" name="phone" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="updateEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="updateEmail" name="email" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="updateAddress" class="form-label">Address</label>
        <input type="text" class="form-control" id="updateAddress" name="address" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="updateJob" class="form-label">Job Title</label>
        <input type="text" class="form-control" id="updateJob" name="job" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="updateDepartment" class="form-label">Department</label>
        <input type="text" class="form-control" id="updateDepartment" name="department" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="updateJobDescription" class="form-label">Job Description</label>
        <input type="text" class="form-control" id="updateJobDescription" name="job_description" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="updateSkills" class="form-label">Skills</label>
        <input type="text" class="form-control" id="updateSkills" name="skills" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="updateQualifications" class="form-label">Qualifications</label>
        <input type="text" class="form-control" id="updateQualifications" name="qualifications" required>
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-primary" name="action" value="update">Update</button>
  </div>
</form>

    </div>
  </div>
</div>

<!-- Add a delete confirmation modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this employee's record?
          <input type="hidden" name="id" id="deleteId">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" name="action" value="delete">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>



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
        <script>

// Open update modal with data
function openUpdateRecordModal(id, fname, lname, birth, phone, email, address, job, department, jobDescription, skills, qualification) {
    document.getElementById('updateId').value = id;
    document.getElementById('updateFname').value = fname;
    document.getElementById('updateLname').value = lname;
    document.getElementById('updateBirth').value = birth; // Added missing field
    document.getElementById('updatePhone').value = phone;
    document.getElementById('updateEmail').value = email;
    document.getElementById('updateAddress').value = address; // Added missing field
    document.getElementById('updateJob').value = job; // Added missing field
    document.getElementById('updateDepartment').value = department; // Added missing field
    document.getElementById('updateJobDescription').value = jobDescription; // Added missing field
    document.getElementById('updateSkills').value = skills; // Added missing field
    document.getElementById('updateQualifications').value = qualification; // Added missing field
    
    var updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
    updateModal.show();
}

function openRecordDeleteModal(id) {
    document.getElementById('deleteId').value = id; // Set the employee ID in the hidden field
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

</script>

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
