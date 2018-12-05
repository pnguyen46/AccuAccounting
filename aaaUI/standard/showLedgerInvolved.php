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
                        <a href="journal.php" class="btn btn-outline btn-info" style="width: 80px;margin-bottom: 50px;">Back</a>


                        <h4></h4>
                        <div class="table-responsive">
                               <div class="panel-body">
                            <table width="100%" class="table table-striped  table-hover" id="ledgers-table">
                                <thead>


                                        <th>Date</th>
                                        <th>Debits</th>
                                        <th>Credits</th>
                                        <th>Balance Before</th>
                                        <th>Balance After</th>
                                        <th>Journal Entry</th>

                                </thead>

                                <tfoot>

                                  </tfoot>
                                <tbody id = "table-body">





                                </tbody>

                            </table>


                        </div>


                    </div>
                    </div>



           <!--                                                     end of your code                   -->
        </div>
        <!-- /#page-wrapper -->



































    </div>
    <!-- /#wrapper -->
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#ledgers-table').DataTable({
            responsive: true
        });
        var geturl = window.location.href;
        var pareurl = new URL(geturl);
        // var param = pareurl.searchParams.get("account");
       //  var urlparam = param.replace(/[^a-zA-Z ]/g, " ");
       var urlparam = pareurl.searchParams.get("account");
        var title =   urlparam + ' account ledger';
        $("h4").text(title);

       //populate table
 $.ajax({ //Seconds Request
        url: 'getFooter.php',
        data:{account:urlparam},
        type: 'post',
        success: function(returnhtml){
        var foot = $("#ledgers-table").find('tfoot');
        if (!foot.length) foot = $('<tfoot>').appendTo("#ledgers-table");
        foot.html($(returnhtml));

            }
    });


    $.ajax({
        url:'populateTable.php',
        data:{account:urlparam},
        type: 'post',
        success : function(resp){
            $("#table-body").empty();

            // var table = $('#ledgers-table').DataTable();
            // table.row.add($(resp)).draw(false);

          $("#ledgers-table tbody").append(resp);



            // Destroy existing table
         //   $('#ledgers-table').DataTable().destroy();

         // var table = $('#ledgers-table').DataTable();
         // table.row.add($(resp)).draw(false);

      //   $("#table-body").html(resp);

        },
        error : function(resp){}
    });





    });
    </script>

</body>

</html>
