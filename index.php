   <html>

   <head>
       <title>PHP Ajax CRUD with Data Tables Modals </title>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
       <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
       <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
       <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
       <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
       <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
       <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <style>
           body {
               margin: 0;
               padding: 0;
               background-color: #f1f1f1;
           }

           .box {
               width: 1270px;
               padding: 20px;
               background-color: #fff;
               border: 1px solid #ccc;
               border-radius: 5px;
               margin-top: 25px;
           }
       </style>
   </head>

   <body>
       <div class="container box">
           <h1 align="center">PHP Ajax CRUD with Data Tables & Modals</h1>

           <div class="table-responsive">

               <div align="right">
                   <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add Data</button>
               </div><br>
               <table style="text-align: center" id="user_data" class="table table-bordered table-striped">
                   <thead>
                       <tr>
                           <th style="text-align: center" width="10%">Image</th>
                           <th style="text-align: center" width="9%">First Name</th>
                           <th style="text-align: center" width="9%">Last Name</th>
                           <th style="text-align: center" width="9%">Email</th>
                           <th style="text-align: center" width="9%">Phone</th>
                           <th style="text-align: center" width="9%">Address</th>
                           <!-- <th style="text-align: center" width="9%">DOB</th> -->
                           <!-- <th style="text-align: center" width="9%">Hobby</th>
                           <th style="text-align: center" width="9%">Gender</th> -->
                           <th style="text-align: center" width="9%">Edit</th>
                           <th style="text-align: center" width="9%">Delete</th>
                       </tr>
                   </thead>
               </table>

           </div>
       </div>
   </body>

   </html>

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
                       <label>Enter Your Email</label>
                       <input type="email" name="email" id="email" class="form-control" />
                       <br />
                       <label>Enter Your Phone Number</label>
                       <input type="tel" name="phone" id="phone" class="form-control" />
                       <br />
                       <label>Enter Your Address</label>
                       <input type="text" name="address" id="address" class="form-control" />
                       <br />
                       <label>Select User Image</label>
                       <input type="file" name="user_image" id="user_image" />
                       <span id="user_uploaded_image"></span>
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
               var firstName = $('#fname').val();
               var lastName = $('#lname').val();
               var email = $('#email').val();
               var phone = $('#phone').val();
               var address = $('#address').val();
               var extension = $('#user_image').val().split('.').pop().toLowerCase();
               if (extension != '') {
                   if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {


                       alert("Invalid Image File");
                       $('#user_image').val('');
                       return false;
                   }
               }
               if (firstName != '' && lastName != '') {
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
                   alert("Both Fields are Required");
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
                       $('#phone').val(data.phone);
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