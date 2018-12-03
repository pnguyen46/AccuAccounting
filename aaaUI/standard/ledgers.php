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
                   <label style="color: #2a6496;">Welcome User</label>
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
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="chartOfAccounts.php"><i class="fa fa-table fa-fw"></i> Chart of Accounts</a>
                        </li>
						<li>
                            <a href="journal.php"><i class="fa fa-edit fa-fw"></i>Journalize</a>

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
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                        <a href=logs.php><i class="fa fa-files-o fa-fw"></i>Logs</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>



      
      
           
         
            <div class="panel-body">
   

            
                    <!--                                                      Add your code here                                         -->
                <div id="page-wrapper">



                    
<div class="panel panel-default">

                    
                       <div class="panel-body">
                            <table width="100%" data-page-length='60' class="table table-striped  table-hover" id="ledgers-table">
                                <thead>
                                    
                                        <th>Code</th>
                                        <th>Name</th>  
                                        <th>Category</th>
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
                                            $account = $row['AcctName'];
                                            $url = 'showLedger.php?account=' . $account;
                                           $accountReference = "<a href='" .$url ."'>" . $account . "</a>";
                                             echo"<tr>";
                                            echo "<td>" . $row['AcctNumber'] . "</td>";
                                            echo "<td>" . $accountReference . "</td>";
                                            echo "<td>" . $row['AcctCategory'] . "</td>";
                                            echo "<td>" . $row['NormalSide'] . "</td>";
                                            echo "<td>$" .number_format($row['Balance'],2) . "</td>";
                                            echo "<td>" . $row['Status'] . "</td>";
                                            
                                            echo"</tr>";
                                           
                                        }
                                    }



                                    ?>
                                   


                                    

                                </tbody>
                                    
                              

                            </table>
                        </div>


           <!--                                                     end of your code                   -->
        </div>
        <!-- /#page-wrapper -->
</div>




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
        $('#ledgers-table').DataTable({
            responsive: true
        });
    });
    </script>

    <script type="text/javascript">
    function sendSubaccount(){
    var subcategory_value=$("#subcategory").val();
    $.ajax({
        url:'getAccountsajax.php',
        data:{subcategory:subcategory_value},
        type: 'post',
        success : function(resp){


            $("#account").html(resp);             
        },
        error : function(resp){}
    });




    }


    </script>


     <script type="text/javascript">
   
    function populateTable(){
         var account_value=$("#account").val();
    
       $.ajax({ //Seconds Request
        url: 'getFooter.php',   
        data:{account:account_value},  
        type: 'post',   
        success: function(returnhtml){ 
        var foot = $("#ledgers-table").find('tfoot');
        if (!foot.length) foot = $('<tfoot>').appendTo("#ledgers-table"); 
        foot.html($(returnhtml));                         
                    
            }           
    });


    $.ajax({
        url:'populateTable.php',
        data:{account:account_value},
        type: 'post',
        success : function(resp){
            $("#table-body").empty();

            // var table = $('#ledgers-table tbody').DataTable();
            // table.row.add($(resp)).draw(false);

         //  $("#ledgers-table tbody").append(resp);   

       
            // Destroy existing table
         //   $('#ledgers-table').DataTable().destroy();
           
         // var table = $('#ledgers-table').DataTable();
         // table.row.add($(resp)).draw(false);

         $("#table-body").html(resp);

        },
        error : function(resp){}
    });





    }


    </script>

</body>

</html>

