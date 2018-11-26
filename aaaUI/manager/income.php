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
    <title>Income</title>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color:#2a6496;
            color: white;
        }
    </style>
 

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
                            <a href="dashboard.php"><i class="fa fa-bar-chart-o fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="chartOfAccounts.php"><i class="fa fa-table fa-fw"></i> Chart of Accounts</a>
                        </li>
                        <li>
                            <a href="managerJournal.php"><i class="fa fa-edit fa-fw"></i>Journal</a>

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
                        

                        <li>
                            <a href="logs.php"><i class="fa fa-files-o fa-fw"></i> Logs</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>



      

        <div id="page-wrapper">
            
                    <!--                                                      Add your code here                                         -->
                    <div  id="docHeaders" style=" text-align: center">
                        <ul style="list-style-type: none">
                          
                            <label style='font-size:18px; color: #2a6496;'  align='center'>Accu Accounting Application</label><li><label style='font-size:18px; color: #2a6496;'  align='center'>Income Statement</label></li><button type="button"  class="btn btn-outline  btn-primary"  id="download" onclick="downloadTrialBalance()" style="margin-left: 15px !important; padding: 9px 18px; "> <i class="fa fa-download"></i></button></li>
                                 
                                <li> <label style='font-size:18px; color: #2a6496;' id='date' align='center'></label></li></ul>
                            </div>


                    <div id='tablediv'>
                        <table id='customers' style="width: 1000px">
                            <thead>
                            
                            
                            </thead>
                            <tbody> 

            <div>
                <?php
                
                $sql = "SELECT AcctName,AcctCategory, Balance FROM coa order by AcctNumber asc";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result)) {
                    $maketable = " ";
                   
                    $revenuesum=0;
                    $expensesum=0;
                    $buildexpense='';
                    $buildrevenue='';// output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        if(($row['AcctCategory']==="Expense")){
                            $expensesum+=$row['Balance'];
                            $buildexpense.='<tr><td>'.$row['AcctName'].'</td><td style="text-align:right">'.$row['Balance'].'</td></tr>';
                        }
                        else if(($row['AcctCategory']==="Revenue")){
                            $revenuesum+=$row['Balance'];
                            $buildrevenue.='<tr><td>'.$row['AcctName'].'</td><td style="text-align:right">'.$row['Balance'].'</td></tr>';
                        }
                    }
                    $maketable.='<tr><th style=" width: 40%;">Revenues</th><th style=" width: 10%;text-align:center;">$</th></tr>'.$buildrevenue.'<tr ><td>Total Revenue</td><td><span style="float: right;border-top-style:none;border-right-style:none;border-bottom-style:double;border-left-style:none;border-width: 2px solid black;"
>$'.$revenuesum.'</span></td></tr>';
                    $maketable.='<tr><th>Expenses</th><th style="text-align:center;">$</th></tr>'.$buildexpense.'<tr><td>Total Expenses</td><td><span style="float: right;border-top-style:none;border-right-style:none;border-bottom-style:double;border-left-style:none;border-width: 2px solid black;"
>$'.$expensesum.'</span></td></tr>';
                    $net=$revenuesum-$expensesum;
                    if($net>0){


                        $maketable.='<tr><td>Net Income(Gain)</td><td><span style="float: right;border-top-style:none;border-right-style:none;border-bottom-style:double;border-left-style:none;border-width: 2px solid black;"
>$'.$net.'</span></td></tr>';
                    }
                    else if($net<0){
                        $maketable.='<tr><td>Net Income(Loss)</td><<td><span style="float: right;border-top-style:none;border-right-style:none;border-bottom-style:double;border-left-style:none;border-width: 2px solid black;"
>$'.$net.'</span></td></tr>';

                    }
                    else{
                        $maketable.='<tr><td>Net Income(Even)</td ><td><span style="float: right;border-top-style:none;border-right-style:none;border-bottom-style:double;border-left-style:none;border-width: 2px solid black;"
>$'.$net.'</span></td></tr>';

                    }


                    print $maketable;
                }
                $conn->close();
                ?>
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

    

      <script type="text/javascript" src="../../vendor/jspdf/jspdf.min.js"></script>

  

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

<script type="text/javascript">
    function downloadTrialBalance(){
     
          var pdf = new jsPDF('p', 'pt', 'letter');
          pdf.setFont("helvetica");
        pdf.setFontSize(15);
               n =  new Date();
                y = n.getFullYear();
                m = n.getMonth() + 1;
                d = n.getDate();
                trialDate =  "As of " + m + "/" + d + "/" + y;

          pdf.text(250,40, 'Income Statement');
          pdf.text(250,60, 'Accu Acounting ');
          pdf.text(250,80, trialDate);
          pdf.text(250,90, "");
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    docHeadersPDF = $('#docHeaders')[0];
    source = $('#tablediv')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Income Statement.pdf');
    }, margins);
}

</script>
    <script>
    $(document).ready(function() {
        $('#chart-of-accounts-table').DataTable({
            responsive: true
        });
    });
    </script>

    <script>
        n =  new Date();
                y = n.getFullYear();
                m = n.getMonth() + 1;
                d = n.getDate();
                document.getElementById("date").innerHTML = "As of " + m + "/" + d + "/" + y;


        </script>

</body>

</html>

