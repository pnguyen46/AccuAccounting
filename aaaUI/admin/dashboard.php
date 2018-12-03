<?php 
include '../auth/databaseConnection.php'
 ?>

<!DOCTYPE html>
<html lang="en">

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
    <style>
        #dash{
            margin-top: 10px;
        }
    
    </style>

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

      

        <div id="page-wrapper">
            
                    <!--                                                      Add your code here                                         -->
             
                 <div>
                <?php
                

                // Create connection
            
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT AcctName,AcctCategory, Balance FROM coa order by AcctNumber asc";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result)) {
                    $maketable = " ";
                   
                    $assetsum=0;
                    $liabilitysum=0;
                    $current=0;
                    $net=0;
                    $revsum=0;
                    $exspenSum=0;
                    $ownerEquity=0;
                    $invensum=0;
                    $roe=0;
                    $debt=0;
                    $quick= 0;
                    $roa=0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if(($row['AcctCategory']==="Asset")){
                            $assetsum+=$row['Balance'];
                        }
                        else if(($row['AcctCategory']==="Liability")){
                            $liabilitysum+=$row['Balance'];
                        }
                        else if(($row['AcctCategory']==="Expense")){
                            $revsum+=$row['Balance'];
                        }
                        else if(($row['AcctCategory']==="Revenue")){
                            $exspenSum+=$row['Balance'];
                        }
                        else if(($row['AcctCategory']==="Owners Equity")){
                            $ownerEquity+=$row['Balance'];
                        }
                        else if(($row['AcctCategory']==="Inventory")){
                            $invensum+=$row['Balance'];
                        }
                    
                    }
                    $current = ($assetsum/$liabilitysum);
                    $net = ($revsum - $exspenSum);
                    $roe = ($net/$ownerEquity);
                    $quick = (($assetsum - $invensum)/($liabilitysum));
                    $debt = ($liabilitysum/$assetsum);
                    $roa = ($net/$assetsum);
                }
                $conn->close();
                ?>
            </div>
            
            

            <div id = "dash">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3"></div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge"><?php echo number_format($current,2).'%'; ?></div>
                                </div>
                            </div>
                        </div>
                       <div class="panel-footer">
                        <div style="text-align:center">Current Ratio</div>
                       </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-1"></div>
                                <div class="col-xs-9 text-center">
                                    <div class="huge"><?php echo number_format($roe,2).'%'; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div style="text-align:center">Return on Equity</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3"></div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge"><?php echo number_format($quick,2).'%'; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div style="text-align:center">Quick Ratio</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3"></div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge"><?php echo number_format($debt,2).'%'; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div style="text-align:center">Debts Ratio</div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3"></div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge"><?php echo number_format($roa,2).'%'; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div style="text-align:center">Return on Asset</div>
                        </div>
                    </div>
                </div>
            </div>


    </div>

















           <!--                                                     end of your code                   -->
        </div>
        <!-- /#page-wrapper -->



































    </div>
    <!-- /#wrapper -->

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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#chart-of-accounts-table').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>

