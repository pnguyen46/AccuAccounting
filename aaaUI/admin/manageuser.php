<?php
include '../auth/databaseConnection.php';


//this needs to be the first one in the page => before it displays/echo anything!
//Start session => For getting error/success messages
// if (!isset($_SESSION))
//     session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- jQuery -->
	<script src="../../vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../../vendor/metisMenu/metisMenu.min.js"></script>

	<!-- DataTables JavaScript -->
	<script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
	<script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../../dist/js/sb-admin-2.js"></script>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap Core CSS -->
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

	<!-- DataTables CSS -->
	<link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

	<!-- DataTables Responsive CSS -->
	<link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
</head>

<body>
<div id="wrapper">

        <!-- Navigation (upper right corner)-->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
			<img src="../../images/logo.png" style="width:130px;height:80px;" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">



               

              
              


                <!--                                                       user specification                         -->
                <li class="dropdown">
                   <label style="color: #2a6496;">Welcome admin</label>
                </li>
                <!-- /.dropdown -->


                <!-- User account here -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../auth/login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->



<!--                                                       LEFT SIDE MENU HERE                            -->
          
        <div class="navbar-default sidebar" role="navigation" style="margin-top: 90px">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
				    <li>
                        <a href="dashboard.php"><i class="fa fa-bar-chart-o fa-fw"></i> DashBoard</a>
                    </li>
                        
                        <li>
							<a href="manageuser.php"><i class="fa  fa-users   fa-fw"></i> Administer Users </a>
						</li>
						<li>
							<a href="chartOfAccounts.php"><i class="fa fa-table fa-fw"></i> Chart of Accounts</a>
						</li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Logs</a>
                        </li>
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>
		<!--     CHART OF ACCOUNTS TABLE HERE  -->
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Manage Users</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="chart-of-accounts">
							<!-- Trigger the modal with a button -->
							<button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Add Account</button>
							<form action='mu.php' method='post' onsubmit="return addAccount()">
								<!-- Modal -->
								<div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content chart-accounts-modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Add User</h4>
											</div>
											<div class="modal-body">
												<div class="chart-accounts-modal">
													<li><label>email</label></li>
													<li><input class="form-control " name="email" type="text" id="email" required>
												</div>
												<div class="chart-accounts-modal">
													<li><label>First Name</label></li>
													<li><input class="form-control " name="firstName" id="firstName" required>
												</div>
												<div class="chart-accounts-modal">
													<li><label>Last Name</label></li>
													<li><input class="form-control" name="lastName" id="lastName" required></li>
												</div>
												<div class="chart-accounts-modal">
													<li><label>Occupation</label></li>
													<li>
														<select id="Occupation" name="Occupation">
															 <option>Admin</option>
															 <option>Manager</option>
															 <option>Regular</option>
														</select>
													</li>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-outline btn-danger" id="delAccount-buttn" onclick="cancelDialog()">Cancel</button>
												<button type="submit" class="btn btn-outline btn-success" id="addAccount-buttn">Add User</button>
												<script type="text/javascript" src="../../js/sb-admin-2.js"></script>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-body">
							<table width="100%" class="table table-striped  table-hover" id="chart-of-accounts-table">
								<thead>
									<th>EmployeeID</th>
									<th>email</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Occupation</th>
									<th>Status</th>
									<th>Action</th>
								</thead>
								<tbody>
									<?php
			

                                   $occupation = array('Admin', 'Manager', 'Regular');
									$status = array('Active', 'Inactive');
                                     $sql = "SELECT * FROM registeruser";
                                     $result = mysqli_query($conn, $sql);

                                      if (mysqli_num_rows($result)) {
                                        // output data of each row
                                          while($row = mysqli_fetch_assoc($result)) {
                                       //Code  Name    Balance Normally    Group   Status  Action
                                             echo"<tr>";
                                            echo "<td>" . $row['EmployeeID'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['firstName'] . "</td>";
                                            echo "<td>" . $row['lastName'] . "</td>";
                                            echo "<td>" . $row['Occupation'] . "</td>";
                                            echo "<td>" . $row['Status'] . "</td>";
											
                                            echo '<td>
                                            <button type="button" data-toggle="modal" data-target="#Update' . $row['EmployeeID'] . '" id="editButton" class="btn btn-outline btn-success" style="margin-right: 5px;">Edit</button>
											
                                            </td>';
											  echo '
											<!-- Modal -->
											<div class="modal fade" id="Update' . $row['EmployeeID'] . '" role="dialog">
											
												<div class="modal-dialog">
												<form action="muedit.php" method="post">
													<!-- Modal content-->
													<div class="modal-content chart-accounts-modal-content">
														<div class="modal-header">
															<h4 class="modal-title">Update User</h4>
														</div>
														<div class="modal-body">
														
													
															<input type="hidden" value="'. $row['EmployeeID'] .'" name="EmpId" >
															<div class="modal-body">
															<div class="chart-accounts-modal">
													<li><label>First Name</label></li>
													<li><input class="form-control " value="'. $row['firstName'] .'"name="firstName" id="firstName" required>
												</div>
												<div class="chart-accounts-modal">
													<li><label>Last Name</label></li>
													<li><input class="form-control"value="'. $row['lastName'] .'" name="lastName" id="lastName" required></li>
												</div>
												<div class="chart-accounts-modal">
													<li><label>email</label></li>
													<li><input class="form-control " name="email" type="text" id="email"value="'. $row['email'] .'">
												</div>
													<div class="chart-accounts-modal">
													<li><label>Password</label></li>
													<li><input class="form-control"value="'. $row['Password'] .'" name="Password" id="Password" required></li>
												</div>
												
															<div class="chart-accounts-modal">
																<li><label>Occupation</label></li>
																<li> <select id="Occupation" name="Occupation">';
																	 for($i = 0; $i < count($occupation); $i++) {
																		 if($occupation[$i] === $row['Occupation']) {
																			 echo '<option selected>' . $occupation[$i] . '</option>';
																		 }
																		 else {
																			 echo '<option>' . $occupation[$i] . '</option>';
																		 }
																	 }
													echo '		</select> </li>
															</div>
															<div class="chart-accounts-modal">
																<li><label>Status</label></li>
																<li>  <select id="Status" name="Status">';
																	 for($i = 0; $i < count($status); $i++) {
																		 if($status[$i] === $row['Status']) {
																			 echo '<option selected>' . $status[$i] . '</option>';
																		 }
																		 else {
																			 echo '<option>' . $status[$i] . '</option>';
																		 }
																	 }
													echo '		</select> </li>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-outline btn-danger" id="cancelEdit-buttn"  data-dismiss="modal">Cancel</button>
															
															<button type="submit" class="btn btn-outline btn-success" id="updateAccount-buttn">Update User</button>
															
														</div>
													</div>
													</form>
												</div>
											</div>';
									echo"</tr>";
                                        }
                                    }
                                    ?>
                                    <div id="successModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Message</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php

                                                    //show msg
                                                    if (isset($_SESSION["feed_back"]))
                                                    {
                                                        echo "<p>{$_SESSION["feed_back"]}</p>";
                                                    }
                                                    ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /#wrapper -->
                                    <script type="text/javascript">
                                        <?php

                                        if (isset($_SESSION["feed_back"]))
                                        {
                                            //unset message
                                            unset($_SESSION["feed_back"]);

                                            //show modal
                                            echo '$(function() {
                    $( "#successModal" ).modal();
                    });';

                                        }
                                        ?>
                                    </script>

                            </table>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
					<!-- Modal -->

							</div>

						</div>
					</div>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
	</div>
	<!-- /#wrapper -->
	<script type="text/javascript">
		<?php
			if ($_GET['success'] =='true'){
				echo '$(function() {
				$( "#successModal" ).modal();
				});';
			}
		?>
	</script>
	<script type="text/javascript">
		function cancelDialog() {
			var response = confirm("Your changes will not be saved, are you sure you want to cancel? ");
			if (response == true) {
				//TODO find a better way to reset values back
				document.getElementById("firstName").value = "";
				document.getElementById("lastName").value = "";
				document.getElementById("email").value = "";
				$('#myModal').modal('toggle');
			}
		}

	</script>
	<!-- Page-Level Demo Scripts - Tables - Use for reference   see sb-admin-2.js-->
	<SCRIPT language=Javascript>
		<!--
		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode != 46 && charCode > 31 &&
				(charCode < 48 || charCode > 57))
				return false;

			return true;
		}
		//-->

	</SCRIPT>
	<script type="text/javascript">
		//check for duplicates
		function hasDuplicate(code, name) {
			if ($('#chart-of-accounts-table td:contains(' + Code + ')').length)
				return false; //we cant insert
			else if ($('#chart-of-accounts-table td:contains(' + Name + ')').length)
				return false; //we cant insert
			else return true;
		}

	</script>
</body>

</html>
