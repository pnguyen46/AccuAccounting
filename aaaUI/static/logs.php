<?php
include 'base.php';
?>

<head>



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
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>
		<!--     CHART OF ACCOUNTS TABLE HERE  -->
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Change Log</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<table width="100%" class="table table-striped  table-hover" id="chart-of-accounts-table">
								<thead>
									<th>Changed</th>
									<th>Field Changed</th>
									<th>From</th>
									<th>To</th>
									<th>Date</th>
								</thead>
								<tbody>
									<?php


                     $occupation = array('Admin', 'Manager', 'Accountant');
										 $status = array('Active', 'Inactive');
                       $sql = 'SELECT `jecl`.user, `je`.journalEntryID, `je`.account, `je`.debits as newDebits, `je`.credits as newCredits, `je`.accountBalanceBefore as newAccountBalanceBefore, '.
											  			'`je`.accountBalanceAfter as newAccountBalanceAfter, `jecl`.debits as oldDebits, `jecl`.credits as oldCredits, `jecl`.accountBalanceBefore as oldAccountBalanceBefore, '.
															'`jecl`.accountBalanceAfter as oldAccountBalanceAfter, `jecl`.datestamp FROM `journalentries` as `je` inner join `journalizecl` as `jecl` on `jecl`.`journalEntryID` = `je`.`journalEntryID` and `jecl`.`account` = `je`.`account` '.
															'order by `jecl`.transID desc';

                       $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result)) {
                          // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                         //Code  Name    Balance Normally    Group   Status  Action
                            echo"<tr>";
                              echo "<td>Journal #" . $row['journalEntryID']. "</td>";
                              echo "<td>Debits<br>Credits<br>AccountBalanceBefore<br>AccountBalanceAfter</td>";
                              echo "<td>" . $row['oldDebits'] . "<br>" . $row['oldCredits'] . "<br>" . $row['oldAccountBalanceBefore'] . "<br>" . $row['oldAccountBalanceAfter'] . "</td>";
                              echo "<td>" . $row['newDebits'] . "<br>" . $row['newCredits'] . "<br>" . $row['newAccountBalanceBefore'] . "<br>" . $row['newAccountBalanceAfter'] . "</td>";
                              echo "<td>" . $row['user'] . "</td>";
															echo "<td>" . $row['datestamp'] . "</td>";
														echo"</tr>";
                          }
                      }

											$sql = "SELECT `na`.AcctName, `na`.AcctNumber, `na`.Term as NewTerm, `na`.NormalSide as NewNormalSide, `na`.InitialBalance as NewBalance, `oa`.Term as OldTerm, `oa`.NormalSide as OldNormalSide, `oa`.Balance as OldBalance, `na`.User, `oa`.datestamp FROM `accountcl` as `na` inner join `oldacctinfo` as `oa` on `na`.AcctNumber = `oa`.AcctNumber where `oa`.status='active' and `na`.status='active' order by `na`.datestamp desc";
											$result = mysqli_query($conn, $sql);
											if (mysqli_num_rows($result)) {
												// output data of each row
													while($row = mysqli_fetch_assoc($result)) {
											 //Code  Name    Balance Normally    Group   Status  Action
													echo"<tr>";
														echo "<td>Account #" . $row['AcctNumber'] . ": " . $row['AcctName']. "</td>";
														echo "<td>Term<br>NormalSide<br>Balance</td>";
														echo "<td>" . $row['OldTerm'] . "<br>" . $row['OldNormalSide'] . "<br>" . $row['OldBalance'] . "</td>";
														echo "<td>" . $row['NewTerm'] . "<br>" . $row['NewNormalSide'] . "<br>" . $row['NewBalance'] . "</td>";
														echo "<td>" . $row['User'] . "</td>";
														echo "<td>" . $row['datestamp'] . "</td>";
													echo"</tr>";
												}
										}

										$sql = "SELECT `ru`.email, `ru`.employeeID, `ru`.firstName as newFirstName, `ru`.lastName as newLastName, `ru`.occupation as newOccupation, `ru`.email as newEmail, `cl`.firstName as oldFirstName, `cl`.lastName as oldLastName, `cl`.occupation as oldOccupation, `cl`.email as oldEmail, `cl`.datestamp FROM `registeruser` as `ru` inner join `olduserdatacl` as `cl` on `ru`.EmployeeID = `cl`.EmployeeID order by `cl`.datestamp desc";
										$result = mysqli_query($conn, $sql);
										if (mysqli_num_rows($result)) {
											// output data of each row
												while($row = mysqli_fetch_assoc($result)) {
										 //Code  Name    Balance Normally    Group   Status  Action
												echo"<tr>";
													echo "<td>Employee #" . $row['employeeID'] . ": " . $row['email']. "</td>";
													echo "<td>Email<br>FirstName<br>LastName<br>Occupation</td>";
													echo "<td>" . $row['oldEmail'] . "<br>" . $row['oldFirstName'] . "<br>" . $row['oldLastName'] . "<br>" . $row['oldOccupation'] . "</td>";
													echo "<td>" . $row['newEmail'] . "<br>" . $row['newFirstName'] . "<br>" . $row['newLastName'] . "<br>" . $row['newOccupation'] . "</td>";
													echo "<td></td>";
													echo "<td>" . $row['datestamp'] . "</td>";
												echo"</tr>";
											}
									}
                    ?>
                                    <!-- /#wrapper -->
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

</body>

</html>
