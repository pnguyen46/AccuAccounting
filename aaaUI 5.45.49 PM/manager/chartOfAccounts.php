<?php
//this needs to be the first one in the page => before it displays/echo anything!
//Start session => For getting error/success messages
include "../auth/databaseConnection.php";
?>

<!DOCTYPE html>
<html lang="en">
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
                   <label style="color: #2a6496;">Welcome Manager</label>
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
                            <a href="dashboard.php"><i class="fa fa-table fa-fw"></i> Dashboard </a>
                        </li>
                        <li>
                            <a href="chartOfAccounts.php"><i class="fa fa-table fa-fw"></i> Chart of Accounts</a>
                        </li>
						                        <li>
                        <a href="managerJournal.php"><i class="fa fa-edit fa-fw"></i>Journalize</a>
                        </li>
                        <li>
                            <a href="ledgers.php"><i class="fa fa-book  fa-fw"></i> Ledgers</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file fa-fw"></i> Reports <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="trial.php">Trial Balance</a>
                                </li>
                                <li>
                                    <a href="income.php">Income Statement</a>
                                </li>
                                <li>
                                    <a href="balance.php">Balance Sheet</a>
                                </li>
                            <li>
                                <a href = "retainedEarnings.php">Retained Earning</a>
                            </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>





    




                 <!--                                                      CHART OF ACCOUNTS TABLE HERE                          -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chart of Accounts</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                    <div class="chart-of-accounts">
                      <!-- Trigger the modal with a button -->
                      <button type="button" style="visibility:hidden;" class="btn btn-outline btn-info" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" >Add Account</button>
<form action='coa.php' method='post'>
                      <!-- Modal -->

                      <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content chart-accounts-modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Add an Account to your Chart of Accounts</h4>
                            </div>
                            <div class="modal-body">
                                <div class="chart-accounts-modal">
                                    <li><label>Account Code</label></li>
                                    <li><input class="form-control" name = "AcctNumber" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="accountNumber" required></>
                                    

                                </div>
                              <div class="chart-accounts-modal">
                                    <li><label>Account Name</label></li>
                                    <li><input class="form-control" name="AcctName" id="accountName" required></>
                               </div>

                                <div class="chart-accounts-modal">
                                     <li><label for="accountTypeSelect">Account Category</label></li>
                                     <li><select id="accountTypeSelect" name= "AcctCategory" class="form-control">
                         <?php

                                
                                $sql1 = "SELECT * FROM account";
                                $result1 = mysqli_query($conn,$sql1);

                                      

                                        while ($row = mysqli_fetch_array($result1)) {

                                            echo "<option value='" . $row['cat_name'] ."'>" . $row['cat_name']."</option>";
                                             
                                        }

                                            echo" </select>";
                                            echo " <li><label for='accountSubCSelect'>Account Subcategory</label></li>";
                                             echo"<li><select id='accountSubCSelect' name='AcctSubCategory'class='form-control' name='acctSubCat'></li> ";
                                    ?>







                                 
                                     </select></li>
                                     
                                </div>

                                <div class="chart-accounts-modal">
                                <li><label for="accountNormalSide">Normal Side</label></li>
                                 <li><select  name = "NormalSide" id="normally" class="form-control normally">
                                     <option>Debit</option>
                                     <option>Credit</option>
                                </select></li>
                                </div>
								<div class="chart-accounts-modal">
                                                <li><label for="accounTerm">Term</label></li>
                                                <li><select  name = "Term"  class="normally" class="form-control normally">
                                                        <option>Current</option>
                                                        <option>Long-Term</option>
                                                    </select></li>
                                            </div>
                                 <div class="chart-accounts-modal">
                                     <li><label>Initial Balance</label></li>
                                    <li><input class="form-control " name="InitialBalance" type="text" id="initialBalance" onkeypress="return isNumberKey(event)" required></li>
                                 </div>
                                <div class="chart-accounts-modal">
                                    <li><label for="accountStatus">Account Status</label></li>
                                     <li><select id="accountStatus" name="Status" class="form-control">
                                         <option>Active</option>
                                         <option>Inactive</option>
                                    </select></li>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline btn-danger" id= "delAccount-buttn" onclick="cancelDialog()">Cancel</button>
                              <button type="submit" class="btn btn-outline btn-success" id="addAccount-buttn">Add Account</button>
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
                                    
                                        <th>Code</th>
                                        <th>Name</th>  
                                        <th>Category</th>       
										<th>Term</th>										
                                        <th>Normal Side</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        
                                    
                                </thead>
                                <tbody>


                                     <?php
                                     $sql = "SELECT * FROM coa";
                                     $result = mysqli_query($conn, $sql);

                                      if (mysqli_num_rows($result)) {
                                        // output data of each row
                                          while($row = mysqli_fetch_assoc($result)) {
                                       //Code  Name    Balance Normally    Group   Status  Action
                                             echo"<tr>";
                                            echo "<td>" . $row['AcctNumber'] . "</td>";
                                            echo "<td>" . $row['AcctName'] . "</td>";
                                            echo "<td>" . $row['AcctCategory'] . "</td>";
											echo "<td>" . $row['Term'] . "</td>";
                                            echo "<td>" . $row['NormalSide'] . "</td>";
                                            echo "<td>$ " .number_format($row['Balance'],2). "</td>";
                                            echo "<td>" . $row['Status'] . "</td>";
                                            
                                            echo"</tr>";
                                           
                                        }
                                    }



                                    ?>
                                   


                                    

                                </tbody>
                                    
                              

                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->



        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- Page-Level Demo Scripts - Tables - Use for reference   see sb-admin-2.js-->
<SCRIPT language=Javascript>
       <!--
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       //-->
    </SCRIPT>
        <script type="text/javascript">
        
//check for duplicates
function hasDuplicate(){
    var accountName = $("#accountName").val();
    var accountNumber = $("#accountNumber").val();

    if ($('#chart-of-accounts-table td:contains(' + accountNumber + ')').length)
        return false; //we cant insert
    else if($('#chart-of-accounts-table td:contains(' + accountName + ')').length)
        return false; //we cant insert
    else return true;
}


    </script>



</body>
</html>
