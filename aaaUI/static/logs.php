<?php
include '../static/base.php';
?>
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
						<script type="text/javascript" src="../../js/sb-admin-2.js"></script>
						<div class="panel-body">
							<table width="100%" class="table table-striped  table-hover" id="chart-of-accounts-table">
								<thead>
									<th>Changed</th>
									<th>Field Changed</th>
									<th>From</th>
									<th>To</th>
									<th>Changed By</th>
									<th>Date</th>
								</thead>
								<tbody>
									<?php


                     $occupation = array('Admin', 'Manager', 'Regular');
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
