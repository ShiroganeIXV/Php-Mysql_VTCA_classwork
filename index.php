<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/293048c406.js" crossorigin="anonymous"></script>
<style>
    .container{
        margin-top: 30px;
    }
    .icon-container{
        display: flex;
        justify-content: space-around;
    }
    .table-container {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    .table-header {
        background-color: #2c3e50;
        color: #fff;
        padding: 10px 20px;
    }
    .table-header h2 {
        margin: 0;
        font-size: 24px;
    }
    .table-header .btn {
        margin-left: 10px;
    }
    .table thead {
        background-color: #f8f9fa;
    }
    .table tbody tr {
        vertical-align: middle;
    }
</style>
</head>
<body>

<div class="container">
    <div class="table-container">
        <div class="table-header d-flex justify-content-between align-items-center">
            <h2>Manage <strong>Employees</strong></h2>
            <div class="d-flex align-items-center">
                <form action="crud.php" id="deleteForm" method="post" onsubmit="return confirm('Are you sure you want to delete these records?');">
                  <button class="btn btn-danger" id="deleteSelected" type="submit" name="deleteSelected">Delete</button>
                </form>
                  <!-- Add New Employee Button trigger modal -->
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                      Add New Employee
                  </button>
              </div>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col"><input type="checkbox" id="toggleAll"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'crud.php';

                $sql = "SELECT id, fullname, email, home_address, phone_number FROM Lab05";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><input type='checkbox' class='row-checkbox' name='ids[]' form='deleteForm' value='" . $row["id"] . "'></td>
                                <td>" . $row["fullname"]. "</td>
                                <td>" . $row["email"]. "</td>
                                <td>" . $row["home_address"]. "</td>
                                <td>" . $row["phone_number"]. "</td>
                                <td class='icon-container'>
                                    <i class='fa-solid fa-pen' style='color: #FFD43B;' data-bs-toggle='modal' data-bs-target='#editEmployeeModal' data-id='" . $row["id"] . "' data-fullname='" . $row["fullname"] . "' data-email='" . $row["email"] . "' data-address='" . $row["home_address"] . "' data-phone='" . $row["phone_number"] . "'></i>
                                    <form action='crud.php' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this record?');\" style='display:inline;'>
                                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                                        <input type='hidden' name='delete' value='1'>
                                        <button type='submit' style='border: none; background: none; padding: 0; cursor: pointer;'>
                                          <i class='fa-solid fa-trash' style='color: #ff000d'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No employees found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="crud.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="home_address" class="form-label">Home Address</label>
            <input type="text" class="form-control" id="home_address" name="home_address" required>
          </div>
          <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="create" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="crud.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit-id" name="id">
          <div class="mb-3">
            <label for="edit-fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="edit-fullname" name="fullname" required>
          </div>
          <div class="mb-3">
            <label for="edit-email" class="form-label">Email</label>
            <input type="email" class="form-control" id="edit-email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="edit-home_address" class="form-label">Home Address</label>
            <input type="text" class="form-control" id="edit-home_address" name="home_address" required>
          </div>
          <div class="mb-3">
            <label for="edit-phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="edit-phone_number" name="phone_number" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="update" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit button click
        document.querySelectorAll('.fa-pen').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = button.getAttribute('data-id');
                const fullname = button.getAttribute('data-fullname');
                const email = button.getAttribute('data-email');
                const address = button.getAttribute('data-address');
                const phone = button.getAttribute('data-phone');

                document.getElementById('edit-id').value = id;
                document.getElementById('edit-fullname').value = fullname;
                document.getElementById('edit-email').value = email;
                document.getElementById('edit-home_address').value = address;
                document.getElementById('edit-phone_number').value = phone;
            });
        });

    
    // JavaScript to toggle all checkboxes
    document.getElementById('toggleAll').addEventListener('change', function() {
      const isChecked = this.checked;
      document.querySelectorAll('.row-checkbox').forEach(function(checkbox) {
          checkbox.checked = isChecked;
    });
});

    });
</script>
</body>
</html>
