<?php
//this needs to be the first one in the page => before it displays/echo anything!
//Start session => For getting error/success messages
include "../auth/user.php";
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
			<img src="../../images/logo.png" style="width:130px;height:90px;" >
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
                   <label style="color: #2a6496;">Welcome <?php echo $_SESSION['Occupation'] ?></label>
                </li>
                <!-- /.dropdown -->
                <!-- User account here -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../auth/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout </a>
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
              <?php if($_SESSION['Occupation'] == 'Admin'){?>
                    <ul class="nav" id="side-menu">
                      <li>
                          <a href="../static/home.php"><i class="fa fa-home fa-fw"></i>Home</a>
                      </li>
                      <li>
                          <a href="../static/Dashboard.php"><i class="fa fa-tachometer fa-fw"></i>Dashboard</a>
                      </li>
                      <li>
                          <a href="../admin/manageuser.php"><i class="fa fa-users fa-fw"></i>Administer Users</a>
                      </li>
                        <li>
                            <a href="../admin/chartofAccounts.php"><i class="fa fa-table fa-fw"></i>Chart of Accounts</a>
                        </li>
                        <li>
                            <a href="../static/logs.php"><i class="fa fa-bookmark fa-fw"></i>Event Log</a>
                        </li>
                    </ul>
              <?php } ?>
              <?php if($_SESSION['Occupation']=='Manager'){?>
                <ul class="nav" id="side-menu">
                  <li>
                      <a href="../static/home.php"><i class="fa fa-home fa-fw"></i>Home</a>
                  </li>
                  <li>
                      <a href="../static/Dashboard.php"><i class="fa fa-tachometer fa-fw"></i>Dashboard</a>
                  </li>
                    <li>
                        <a href="../manager/chartOfAccounts.php"><i class="fa fa-table fa-fw"></i>Chart of Accounts</a>
                    </li>
                    <li>
                    <a href="../manager/journalize.php"><i class="fa fa-plus fa-fw"></i>Add New Journal</a>
                    </li>
                    <li>
                    <a href="../manager/managerJournal.php"><i class="fa fa-edit fa-fw"></i>Journal</a>
                    </li>
                    <li>
                        <a href="../manager/ledgers.php"><i class="fa fa-book  fa-fw"></i>Ledgers</a>
                    </li>
                    <li>
                        <a href="../static/logs.php"><i class="fa fa-bookmark fa-fw"></i>Event Log</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-file fa-fw"></i> Reports <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../manager/trial.php">Trial Balance</a>
                            </li>
                            <li>
                                <a href="../manager/income.php">Income Statement</a>
                            </li>
                            <li>
                                <a href="../manager/retainedEarnings.php">Statement of Retained Earnings</a>
                            </li>
                            <li>
                                <a href="../manager/balance.php">Balance Sheet</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            <?php } ?>
          <?php if($_SESSION['Occupation']=='Accountant'){?>
                <ul class="nav" id="side-menu">
                  <li>
                      <a href="../static/home.php"><i class="fa fa-home fa-fw"></i>Home</a>
                  </li>
                  <li>
                      <a href="../static/Dashboard.php"><i class="fa fa-tachometer fa-fw"></i>Dashboard</a>
                  </li>
                    <li>
                        <a href="../standard/chartOfAccounts.php"><i class="fa fa-table fa-fw"></i>Chart of Accounts</a>
                    </li>
                    <li>
                    <a href="../standard/journalize.php"><i class="fa fa-plus fa-fw"></i>Add New Journal</a>
                    </li>
                    <li>
                    <a href="../standard/journal.php"><i class="fa fa-edit fa-fw"></i>Journal</a>
                    </li>
                    <li>
                        <a href="../standard/ledgers.php"><i class="fa fa-book  fa-fw"></i>Ledgers</a>
                    </li>
                    <li>
                        <a href="../static/logs.php"><i class="fa fa-bookmark fa-fw"></i>Event Log</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-file fa-fw"></i> Reports <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../standard/trial.php">Trial Balance</a>
                            </li>
                            <li>
                                <a href="../standard/income.php">Income Statement</a>
                            </li>
                            <li>
                                <a href="../standard/retainedEarnings.php">Statement of Retained Earnings</a>
                            </li>
                            <li>
                                <a href="../standard/balance.php">Balance Sheet</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
              <?php } ?>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
</html>
