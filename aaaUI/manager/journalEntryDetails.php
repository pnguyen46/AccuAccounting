<?php
include '../static/base.php';
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
        <div id="page-wrapper">

                    <!--                                                      Add your code here                                         -->
                    <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="ledgers.php" class="btn btn-outline btn-info" style="width: 80px;margin-bottom: 50px;">Back</a>


                        <h4></h4>
                        <div class="table-responsive">
                                <table class="table" id="entry-table">
                                    <thead>
                                        <tr>
                                            <th>Account Code</th>
                                            <th>Account Name</th>
                                            <th>Debits</th>
                                            <th>Credits</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                    <h5>Description</h5>
                    <p id="description"></p>
                    <h5>Attachments</h5>
                     <p> N/A</p>


                    </div>
                    </div>



           <!--                                                     end of your code                   -->
        </div>
        <!-- /#page-wrapper -->



































    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>


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
        // $('#chart-of-accounts-table').DataTable({
        //     responsive: true
        // });
        var geturl = window.location.href;
        var pareurl = new URL(geturl);
        var urlparam = pareurl.searchParams.get("entry");
        var title =  "Journal Entry Reference: " + urlparam;
        $("h4").text(title);

       //populate table
         $.ajax({ //Seconds Request
        url: 'entryDetailsTable.php',
        data:{journalEntryID:urlparam},
        type: 'post',
        success: function(resp){
        $("#table-body").empty();
        $("#table-body").html(resp);

        }
    });
     //get description
         $.ajax({ //Seconds Request
        url: 'journalDetailsAjax.php',
        data:{journalEntryID:urlparam},
        type: 'post',
        success: function(resp){

        $("#description").html(resp);

        }
    });

    });
    </script>

</body>

</html>
