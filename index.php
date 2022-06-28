<html>

<head>
    <title> CRUD With All Data Table Fields</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

</html>

<body>
    <div class="container box">
        <h1 align="center">CRUD</h1>

        <div align="right">
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Select All</button>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add Data</button>
        </div>
        <br />
        <table id="user_data" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="9%">Image</th>
                    <th width="9%">FName</th>
                    <th width="9%">LName</th>
                    <th width="9%">Email</th>
                    <th width="9%">Contact</th>
                    <th width="9%">DOB</th>
                    <th width="9%">Hobby</th>
                    <th width="9%">Gender</th>
                    <th width="9%">Address</th>
                    <th width="9%">Edit</th>
                    <th width="9%">Delete</th>
                </tr>
            </thead>
        </table>

    </div>
    </div>
</body>


<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <label>Enter First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control" />
                    <br />
                    <label>Enter Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control" />
                    <br />
                    <label>Select User Image</label>
                    <input type="file" name="user_image" id="user_image" />
                    <span id="user_uploaded_image"></span>

                    <label>Enter Your Email</label>
                    <input type="text" name="email" id="email" class="form-control" />
                    <br />
                    <label>Enter Your Phone Number</label>
                    <input type="tel" name="contact" id="contact" class="form-control" />
                    <br />
                    <label>Enter Date Of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" />
                    <br />
                    <label>Choose Your Hobby</label>
                    <select name="hobby" id="hobby" form="hobby">
                        <option value="cricket">Cricket</option>
                        <option value="football">Football</option>
                        <option value="travel">Travel</option>
                    </select>
                    <br />
                    <label>Select Your Gender</label>
                    <input type="radio" name="gender" id="gender" value="male"> Male
                    <input type="radio" name="gender" id="gender" value="female"> Female
                    <br />
                    <label>Enter Your Address</label>
                    <input type="text" name="address" id="address" class="form-control" />
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('#add_button').click(function() {
            $('#user_form')[0].reset();
            $('.modal-title').text("Add User");
            $('#action').val("Add");
            $('#operation').val("Add");
            $('#user_uploaded_image').html('');
        });

        var dataTable = $('#user_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "fetch.php",
                type: "POST"
            },
            "columnDefs": [{
                "targets": [0, 3, 4],
                "orderable": false,
            }, ],

        });

        $(document).on('submit', '#user_form', function(event) {
            event.preventDefault();
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var email = $('#email').val();
            var contact = $('#contact').val();
            var dob = $('#dob').val();
            var hobby = $('#hobby').val();
            var gender = $('#gender').val();
            var address = $('#address').val();
            var extension = $('#user_image').val().split('.').pop().toLowerCase();
            if (extension != '') {
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert("Invalid Image File");
                    $('#user_image').val('');
                    return false;
                }
            }
            if (fname != '' && lname != '' && email != '' && contact != '' && dob != '' && hobby != '' && gender != '' && address != '') {
                $.ajax({
                    url: "insert.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        alert(data);
                        $('#user_form')[0].reset();
                        $('#userModal').modal('hide');
                        dataTable.ajax.reload();
                    }
                });
            } else {
                alert("ALL Fields are Required");
            }
        });

        $(document).on('click', '.update', function() {
            var user_id = $(this).attr("id");
            $.ajax({
                url: "fetch_single.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                dataType: "json",
                success: function(data) {
                    $('#userModal').modal('show');
                    $('#fname').val(data.fname);
                    $('#lname').val(data.lname);
                    $('#email').val(data.email);
                    $('#contact').val(data.contact);
                    $('#dob').val(data.dob);
                    $('#hobby').val(data.hobby);
                    $('#gender').val(data.gender);
                    $('#address').val(data.address);
                    $('.modal-title').text("Edit User");
                    $('#user_id').val(user_id);
                    $('#user_uploaded_image').html(data.user_image);
                    $('#action').val("Edit");
                    $('#operation').val("Edit");
                }
            })
        });

        $(document).on('click', '.delete', function() {
            var user_id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    success: function(data) {
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            } else {
                return false;
            }
        });


    });
</script>