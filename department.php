<?php
// Assuming you're using MySQLi for database connection
include 'connection.php'; // Include your MySQLi connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add department
    if (isset($_POST['department_name']) && !isset($_POST['id'])) {
        $department_name = $_POST['department_name'];

        // Sanitize input to avoid XSS and SQL injection
        $department_name = htmlspecialchars(trim($department_name));

        // Validate the input
        if (empty($department_name)) {
            echo "Error: Department name cannot be empty.";
            exit();
        }

        // Prepare the SQL statement
        $sql = "INSERT INTO department (department_name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $department_name);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Added successfully'); ";
        } else {
            echo "Error: Unable to add department.";
        }
    }

    // Update department (if department ID is set)
    if (isset($_POST['department_name']) && isset($_POST['id'])) {
        $department_id = $_POST['id'];
        $department_name = $_POST['department_name'];

        // Sanitize input to avoid XSS and SQL injection
        $department_name = htmlspecialchars(trim($department_name));

        // Prepare the SQL statement
        $sql = "UPDATE department SET department_name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $department_name, $department_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Updated successfully'); ";
        } else {
            echo "Error: Unable to update department.";
        }
    }

    // Delete department (if department ID is set)
    if (isset($_POST['id'])) {
        $department_id = $_POST['id'];

        // Prepare the SQL statement
        $sql = "DELETE FROM department WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $department_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Deleted successfully'); ";
        } else {
            echo "Error: Unable to delete department.";
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
        .action-buttons button {
            margin-right: 5px;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php require "navbar.php";?>
    <?php require "sidebar.php";?>

    <div id="layoutSidenav_content">
        <main>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">List of Departments</h5>
                </div>
                <div class="card-body">
                    <!-- Add Button -->
                    <div class="mb-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fas fa-plus"></i> Add Department
                        </button>
                    </div>
        
                    <table id="datatablesSimple" class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sql = "SELECT * FROM department"; 
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='px-4 py-2 text-center'>" . $row['id'] . "</td>";
                                    echo "<td class='px-4 py-2 text-center'>" . htmlspecialchars($row['department_name']) . "</td>";
                                    echo "<td class='px-4 py-2 text-center'>";
                                    echo "<button class='btn btn-warning btn-sm text-white' data-id='{$row['id']}' data-department='{$row['department_name']}' data-bs-toggle='modal' data-bs-target='#updateModal'>Update</button>";
                                    echo "<button class='btn btn-danger btn-sm text-white' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3' class='px-4 py-2 text-center'>No departments found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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

    <!-- Add Department Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="department.php" method="POST">
                        <div class="mb-3">
                            <label for="departmentName" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="departmentName" name="department_name" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Department</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Update Department Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="department.php" method="POST">
                        <div class="mb-3">
                            <label for="updateDepartmentName" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="updateDepartmentName" name="department_name" required>
                            <input type="hidden" id="updateDepartmentId" name="id">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Department</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Delete Department Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this department?</p>
                    <form action="department.php" method="POST">
                        <input type="hidden" id="deleteDepartmentId" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Department</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <script>
        // Update Modal Script
        const updateModal = document.getElementById('updateModal');
        updateModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const departmentId = button.getAttribute('data-id');
            const departmentName = button.getAttribute('data-department');

            const updateDepartmentName = updateModal.querySelector('#updateDepartmentName');
            const updateDepartmentId = updateModal.querySelector('#updateDepartmentId');

            updateDepartmentName.value = departmentName;
            updateDepartmentId.value = departmentId;
        });

        // Delete Modal Script
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const departmentId = button.getAttribute('data-id');

            const deleteDepartmentId = deleteModal.querySelector('#deleteDepartmentId');
            deleteDepartmentId.value = departmentId;
        });
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
