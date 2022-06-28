<html>

<head>
    <title> CRUD With All Data Table Fields</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

</html>
</head>

<body>
    <div class="container box">
        <h1 align="center">CRUD</h1>
        <div align="right">
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
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="../script.js"></script>

</html>