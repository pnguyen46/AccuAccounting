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
                            <!-- /.nav-second-level --
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>






        <div id="page-wrapper">

            
                    <!--                                                      Add your code here                                         -->



<div class="row">
                <div class="col-lg-16">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#generaljournal" data-toggle="tab">Journal</a>
                                </li>
                                <li><a href="#profile" data-toggle="tab">Pending Entries</a>
                                </li>
                                <li><a href="#rejected" data-toggle="tab">Rejected Entries</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="generaljournal">
                                    
                                     <div class="chart-of-accounts">
                                <a href="journalize.php" class="add-row-btn btn btn-outline btn-success">Add Journal Entry</a>
                                    
                            </div>

                            <div class="panel-body">
                            
                <!---             <button id="btn-show-all-children" type="button">Expand All</button>. -->
                  <!---           <button id="btn-hide-all-children" type="button">Collapse All</button> -->
                            <table width="100%" class=" table table-striped  table-hover" id="journal-table">
                                <thead>
                                    <tr class ="chart-of-accounts-header-row">
                                         <th></th>
                                        <th>Target Date</th>
                                        <th>Accounts Involved</th>
                                        <th>Entry Reference</th>
                                        <th>Status</th>
                                        <th>Submitter</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                
                                     
                             <?php
                            

                              date_default_timezone_set("America/New_York");
                             
                             $query= "SELECT *  FROM journal where isApproved = '1'";
                             $result = mysqli_query($conn, $query);

  

                                  $accountsInEntry = "";
                               while ($row = mysqli_fetch_assoc($result)) {
                                $journalEntryData= "SELECT * FROM journalentries` WHERE journalEntryID = '".$row['journalEntryID']. "'";
                                $entryData =  mysqli_query($conn, $journalEntryData);
                                while ($toggleData = mysqli_fetch_assoc($entryData))
                                    {
                                    $account = $toggleData['account'];
                                    $list_begin = "<li>";
                                    $list_end =    "</li>";

                                    $url = 'showLedgerInvolved.php?account=' . $account;
                                    $accountReference = "<a href='" .$url ."'>" . $account . "</a>";
                                    
                                    $accountsInEntry .= $list_begin . $accountReference . $list_end;
                                    
                                          
                                    }
                                    $accountsInvolved = '<ul style="list-style-type:none">' . $accountsInEntry . '</ul>';

                                   

                                $targetDate = date_format(date_create($row['targetDate']), 'm-d-Y');   
                                 $journalEntryID = $row['journalEntryID'];             
                                   echo' <tr>';
                                   echo' <td class="details-control "></td>';
                                   echo "<td  >". $targetDate."</td>";   
                                   echo "<td  >".$accountsInvolved."</td>";
                                     $accountsInEntry = "";
                            
                                ?>
                                  <form method="post" action="managerEntryAction.php">
                                    <input type="hidden" name="journalEntryID" value= "<?php echo $journalEntryID?>">

                                 <?php
                                  echo "<td class='showRow' >". $journalEntryID."</td>";
                                  
                                   $isApproved = 'Pending Approval';
                                   if($row['isApproved']==1){
                                    $isApproved = 'Approved';
                                   }
                                   echo "<td >".$isApproved."</td>";
                                   echo "<td >".$row['submmiter']."</td>";
                                   $dateCreated = date_format(date_create($row['dateCreated']), 'm-d-Y');
                                   echo "<td >". $dateCreated."</td>";
                                   echo '   </form>';

                                   
                                $url = "<a href='journalEntryDetailsJournal.php?entry=" . $journalEntryID . "'";
                                $class = "class=' btn btn-outline btn-success ' style='width: 80px;' >";

                                echo "<td>" .$url .  $class  . "View"  . "</a></td>";

                                

                  
                                 
                                   echo "</tr>";
                                   

                               }


                                    ?>


                                </tbody>

                            </table>

                            <div class="modal fade" id="myModal">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Journal Entry Details</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p><input type="text" class="input-sm" id="txtfname"/></p>
                                    <p><input type="text" class="input-sm" id="txtlname"/></p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->




                        </div>  <!-- /.panel-body -->





                                    
                                </div>
                                <div class="tab-pane fade" id="profile">
                            
                                       <div class="panel-body">
                            
                                  <!---             <button id="btn-show-all-children" type="button">Expand All</button>. -->
                  <!---           <button id="btn-hide-all-children" type="button">Collapse All</button> -->
                            <table width="100%" class=" table table-striped  table-hover" id="pending-entries-table">
                                <thead>
                                    <tr class ="chart-of-accounts-header-row">
                                         <th></th>
                                        <th>Target Date</th>
                                        <th>Accounts Involved</th>
                                        <th>Entry Reference</th>
                                        <th>Status</th>
                                        <th>Submitter</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                
                                     
                             <?php
                           

                              date_default_timezone_set("America/New_York");
                             
                             $query= "SELECT *  FROM `journal` where isApproved = '0'";
                             $result = mysqli_query($conn, $query);


                                 $accountsInEntry = "";
                               while ($row = mysqli_fetch_assoc($result)) {
                                $journalEntryData= "SELECT * FROM `journalentries` WHERE journalEntryID = '".$row['journalEntryID']. "'";
                                $entryData =  mysqli_query($conn, $journalEntryData);
                                while ($toggleData = mysqli_fetch_assoc($entryData))
                                    {
                                    $account = $toggleData['account'];
                                    $list_begin = "<li>";
                                    $list_end =    "</li>";
                                    
                                    $accountsInEntry .= $list_begin . $account. $list_end;
                                          
                                    }
                                    $accountsInvolved = '<ul style="list-style-type:none">' . $accountsInEntry . '</ul>';

                                   

                                $targetDate = date_format(date_create($row['targetDate']), 'm-d-Y');   
                                 $journalEntryID = $row['journalEntryID'];             
                                   echo' <tr>';
                                   echo' <td class="details-control "></td>';
                                   echo "<td  >". $targetDate."</td>";   
                                   echo "<td  >".$accountsInvolved."</td>";
                                     $accountsInEntry = "";
                            
                                 ?>
                                  <form method="post" action="managerEntryAction.php">
                                    <input type="hidden" name="journalEntryID" value= "<?php echo $journalEntryID?>">

                                 <?php
                                  echo "<td class='showRow' >". $journalEntryID."</td>";
                                  
                                   $isApproved = 'Pending Approval';
                                   
                                   echo "<td >".$isApproved."</td>";
                                   echo "<td >".$row['submmiter']."</td>";
                                   $dateCreated = date_format(date_create($row['dateCreated']), 'm-d-Y');
                                   echo "<td >". $dateCreated."</td>";
                                   echo '   </form>';

                                   
                                $url = "<a href='journalEntryDetailsAction.php?entry=" . $journalEntryID . "'";
                                $class = "class=' btn btn-outline btn-success ' style='width: 100px;' >";

                                echo "<td>" .$url .  $class  . "Take Action"  . "</a></td>";

                                

                  
                                 
                                   echo "</tr>";
                                   

                               }


                                    ?>


                                </tbody>

                            </table>
                        </div>  <!-- /.panel-body -->


                                    
                                </div>

                                 <div class="tab-pane fade" id="rejected">
                            
                                       <div class="panel-body">
                            
                                  <!---             <button id="btn-show-all-children" type="button">Expand All</button>. -->
                  <!---           <button id="btn-hide-all-children" type="button">Collapse All</button> -->
                             <table width="100%" class=" table table-striped  table-hover" id="rejected-entries-table">
                                <thead>
                                    <tr class ="chart-of-accounts-header-row">
                                         <th></th>
                                        <th>Target Date</th>
                                        <th>Accounts Involved</th>
                                        <th>Entry Reference</th>
                                        <th>Status</th>
                                        <th>Submitter</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                
                                     
                             <?php
                           
                            // Check connection
                          
                              date_default_timezone_set("America/New_York");
                             
                             $query= "SELECT *  FROM `journal` where isApproved = '3'";
                             $result = mysqli_query($conn, $query);


                              $accountsInEntry = "";
                               while ($row = mysqli_fetch_assoc($result)) {
                                $journalEntryData= "SELECT * FROM `journalentries` WHERE journalEntryID = '".$row['journalEntryID']. "'";
                                $entryData =  mysqli_query($conn, $journalEntryData);
                                while ($toggleData = mysqli_fetch_assoc($entryData))
                                    {
                                    $account = $toggleData['account'];
                                    $list_begin = "<li>";
                                    $list_end =    "</li>";

                                    
                                    
                                    $accountsInEntry .= $list_begin . $account . $list_end;
                                    
                                          
                                    }
                                    $accountsInvolved = '<ul style="list-style-type:none">' . $accountsInEntry . '</ul>';

                                   

                                $targetDate = date_format(date_create($row['targetDate']), 'm-d-Y');   
                                 $journalEntryID = $row['journalEntryID'];             
                                   echo' <tr>';
                                   echo' <td class="details-control "></td>';
                                   echo "<td  >". $targetDate."</td>";   
                                   echo "<td  >".$accountsInvolved."</td>";
                                     $accountsInEntry = "";
                            
                                 ?>
                                  <form method="post" action="managerEntryActionReject.php">
                                    <input type="hidden" name="journalEntryID" value= "<?php echo $journalEntryID?>">

                                 <?php
                                  echo "<td class='showRow' >". $journalEntryID."</td>";
                                  
                                   $isApproved = 'Rejected';
                                   
                                   echo "<td >".$isApproved."</td>";
                                   echo "<td >".$row['submmiter']."</td>";
                                   $dateCreated = date_format(date_create($row['dateCreated']), 'm-d-Y');
                                   echo "<td >". $dateCreated."</td>";
                                   echo '   </form>';

                                   
                                $url = "<a href='rejectedEntries.php?entry=" . $journalEntryID . "'";
                                $class = "class=' btn btn-outline btn-success ' style='width: 80px;' >";

                                echo "<td>" .$url .  $class  . "View"  . "</a></td>";

                                

                  
                                 
                                   echo "</tr>";
                                   

                               }


                                    ?>


                                </tbody>

                            </table>
                        </div>  <!-- /.panel-body -->


                                    
                                </div>










                                <div class="tab-pane fade" id="messages">
                                   
                                </div>
                                <div class="tab-pane fade" id="settings">
                                   
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
    // $(document).ready(function() {
    //     $('#journal-table').DataTable({
    //         responsive: true
    //     });
    // });
    </script>

    <script>


$(document).ready(function (){
    
    var table = $('#journal-table').DataTable({
        'responsive': true
    });
    var tablePending = $('#pending-entries-table').DataTable({
        'responsive': true
    });
     var rejectedEntriesTable = $('#rejected-entries-table').DataTable({
        'responsive': true
    });
  
});

// $('table tbody tr  td').on('click',function(){
//     $("#myModal").modal("show");
//     $("#txtfname").val($(this).closest('tr').children()[0].textContent);
//     $("#txtlname").val($(this).closest('tr').children()[1].textContent);
// });


        
    </script>
    <script type="text/javascript">


    </script>

</body>

</html>

