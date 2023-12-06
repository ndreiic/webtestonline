<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">User Management</h2>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search users by name or email" aria-label="Search users by name or email" aria-describedby="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="search">Search</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Unique ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Email</th>
                        <th>Stall Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Sample PHP code for data retrieval
                    $host = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "useraccount";

                    $conn = new mysqli($host, $username, $password, $database);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM useraccount";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><button class='btn btn-primary edit-btn' data-toggle='modal' data-target='#editUserModal' data-userid='{$row['unique_id']}'>Edit</button> 
                                        <button class='btn btn-info'>Details</button>
                                    </td>";
                            echo "<td>{$row['unique_id']}</td>";
                            echo "<td>{$row['lname']}</td>";
                            echo "<td>{$row['fname']}</td>";
                            echo "<td>{$row['mname']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['stall_number']}</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No users found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing user data -->
                    <form id="editUserForm" action="update_user.php" method="post">
                        <div class="form-group">
                            <label for="editLastName">Last Name</label>
                            <input type="text" class="form-control" id="editLastName" name="editLastName" required>
                        </div>
                        <div class="form-group">
                            <label for="editFirstName">First Name</label>
                            <input type="text" class="form-control" id="editFirstName" name="editFirstName" required>
                        </div>
                        <div class="form-group">
                            <label for="editMiddleName">Middle Name</label>
                            <input type="text" class="form-control" id="editMiddleName" name="editMiddleName">
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="editEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="editStallNumber">Stall Number</label>
                            <input type="text" class="form-control" id="editStallNumber" name="editStallNumber" required>
                        </div>
                        <input type="hidden" id="editUserId" name="editUserId">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
        // Handle edit button click
        $('.edit-btn').on('click', function () {
            var userId = $(this).data('userid');

            // Fetch user data by ID
            getUserById(userId, function (user) {
                // Populate the modal with user data
                $('#editUserId').val(user.unique_id);
                $('#editLastName').val(user.lname);
                $('#editFirstName').val(user.fname);
                $('#editMiddleName').val(user.mname);
                $('#editEmail').val(user.email);
                $('#editStallNumber').val(user.stall_number);

                // Show the modal
                $('#editUserModal').modal('show');
            });
        });

        // Function to fetch user data by ID using AJAX
        function getUserById(userId, callback) {
            $.ajax({
                url: 'get_user.php', // Adjust the URL based on your server-side script
                method: 'GET',
                data: { userId: userId },
                dataType: 'json',
                success: function (data) {
                    // Invoke the callback with the fetched user data
                    callback(data);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching user data:', error);
                }
            });
        }
    });
    </script>
</body>

</html>
