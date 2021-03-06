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
                        <a href="managerJournal.php" class="btn btn-outline btn-info" style="width: 80px;margin-bottom: 50px;">Back</a>


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
                <div style="padding-left: 900px;"><button  onclick="approveEntry()" class="btn btn-outline btn-primary" style="width: 80px;margin-bottom: 50px; margin-right: 10px;" id="approve">Approve</button>

                    <!-- Button trigger modal -->
                <button type="button" id="mymodal" style="width: 80px;margin-bottom: 50px;"   class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal">
                 Reject
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                      </div>
                      <div class="modal-body" >
                         <label style="font-size:18px" >Reason for rejecting:</label>
                            <textarea  id="commentReject" class="form-control" name="description" style="width: 500px;" rows="5" placeholder="Please enter a reason." ></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="saveChanges" onclick="rejectEntry()" class="btn btn-primary">Save changes</button>
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
    <script type="text/javascript">
        function approveEntry(){

        var geturl = window.location.href;
        var pareurl = new URL(geturl);
        var urlparam = pareurl.searchParams.get("entry");

      $.ajax({ //approve entry
        url: 'managerEntryAction.php',
        data:{journalEntryID:urlparam},
        type: 'post',
        success: function(resp){
             alert("Journal Entry Approved and Posted!");
             window.location.href = "managerJournal.php";
              }


    });



    }




    </script>
    <script type="text/javascript">
         $(".btn[data-target='#editModal']").click(function() {
jQuery('#mymodal').trigger('click');


                      });


    </script>
    <script type="text/javascript">
    function rejectEntry(){
        var rejectComment =  document.getElementById("commentReject").value;
        var geturl = window.location.href;
        var pareurl = new URL(geturl);
        var urlparam = pareurl.searchParams.get("entry");


      $.ajax({ //approve entry

        url: 'managerActionReject.php',
        data:
            {
                journalEntryID:urlparam,
                comment:rejectComment

              },
        type: 'post',
        success: function(resp){
             alert("Journal Entry Rejected!");
             window.location.href = "managerJournal.php";
              }


    });




        }


    </script>

</body>

</html>
