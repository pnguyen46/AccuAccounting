<?php
include '../static/base.php';
?>

<!DOCTYPE html>
<html lang="en">
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

    <script type="text/javascript"> function setID(id) {
        document.getElementById("AcctID").value = id;
        document.getElementById("AcctNumber").value = document.getElementById(id+"_AcctNumber").innerHTML;
        document.getElementById("AcctName").value = document.getElementById(id+"_AcctName").innerHTML;
        document.getElementById("initialBalance").value = document.getElementById(id+"_InitialBalance").innerHTML;
        document.getElementById("accountStatus").value = document.getElementById(id+"_Status").innerHTML;
        document.getElementById("accountSubCSelect").value = document.getElementById(id+"_AcctSubCategory").innerHTML;
        document.getElementById("accountTypeSelect").value = document.getElementById(id+"_AcctCategory").innerHTML;
        document.getElementById("normally").value = document.getElementById(id+"_NormalSide").innerHTML;

    }</script>

</head>

<body>

<div id="wrapper">
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
                        <button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" >Add Account</button>
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
                                                <li><input class="form-control" name = "AcctNumber" class= "accountNumber" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  required></>


                                            </div>
                                            <div class="chart-accounts-modal">
                                                <li><label>Account Name</label></li>
                                                <li><input class="form-control" name="AcctName" class="accountName"  required></>
                                            </div>

                                            <div class="chart-accounts-modal">
                                                <li><label for="accountTypeSelect">Account Category</label></li>
                                                <li><select  class = "accountCategory" name= "AcctCategory" class="form-control">
                                                        <?php



                                                        $sql1 = "SELECT * FROM account";
                                                        $result1 = mysqli_query($conn,$sql1);



                                                        while ($row = mysqli_fetch_array($result1)) {

                                                            echo "<option value='" . $row['cat_name'] ."'>" . $row['cat_name']."</option>";

                                                        }
                                                        ?>


                                                    </select></li>

                                            </div>

                                            <div class="chart-accounts-modal">
                                                <li><label for="accountNormalSide">Normal Side</label></li>
                                                <li><select  name = "NormalSide"  class="normally" class="form-control normally">
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
                                                <li><input class="form-control " name="InitialBalance" type="text" class="initialBalance"  onkeypress="return isNumberKey(event)"></li>
                                            </div>
                                            <div class="chart-accounts-modal">
                                                <li><label for="accountStatus">Account Status</label></li>
                                                <li><select  name="Status" class="accountStatus" class="form-control">
                                                        <option>Active</option>
                                                        <option>Inactive</option>
                                                    </select></li>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline btn-danger" id="cancelEdit-buttn"  data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-outline btn-success" id="addAccount-buttn">Add Account</button>
                                            <script type="text/javascript" src="../../js/sb-admin-2.js"></script>

                                        </div>
                                    </div>
                                </div>
                            </div>






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
                            <th>Action</th>

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
                                    echo "<td id='{$row['AcctID']}_AcctNumber' class='accountNumber'>" . $row['AcctNumber'] . "</td>";
                                    echo "<td id='{$row['AcctID']}_AcctName'>" . $row['AcctName'] . "</td>";
                                    echo "<td id='{$row['AcctID']}_AcctCategory'>" . $row['AcctCategory'] . "</td>";
									echo "<td id='{$row['AcctID']}_Term'>" . $row['Term'] . "</td>";
                                    echo "<td id='{$row['AcctID']}_NormalSide'>" . $row['NormalSide'] . "</td>";
                                    echo "<td id='{$row['AcctID']}_InitialBalance'>$".number_format($row['Balance'],2). "</td>";
                                    echo "<td id='{$row['AcctID']}_Status'>" . $row['Status'] . "</td>";
                                    echo '<td>
                                            <button type="submit" id="editButton" onclick="setID(this.getAttribute(\'data-id\'))" data-id="'.$row['AcctID'].'"  data-toggle="modal" data-target="#editModal" contenteditable="false" class="btn btn-outline btn-success" style="margin-right: 5px;">Edit</button>
                                            </td>';
                                    echo"</tr>";

                                }
                            }



                            ?>



                            </form>

                            </tbody>

                            <!-- MODAL for editing the accounts -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content"></div>
                                </div>
                                <div class="modal-dialog">
                                    <div class="modal-content"></div>
                                </div>
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <form action='editCOA.php' method='post'>
                                                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>

                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Edit Account</h4>

                                        </div>
                                        <input id="AcctID" type="hidden" name="AcctID">
                                        <div class="modal-body">
                                            <div class="chart-accounts-modal">
                                                <li><label>Account Code</label></li>
                                                <li><input class="form-control" id="AcctNumber" name = "AcctNumber" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="accountNumber" disabled=""></>


                                            </div>
                                            <div class="chart-accounts-modal">
                                                <li><label>Account Name</label></li>
                                                <li><input class="form-control" id="AcctName" name="AcctName" class="accountName" disabled=""></>
                                            </div>

                                            <div class="chart-accounts-modal">
                                                <li><label for="accountTypeSelect">Account Category</label></li>
                                                <li><select id="accountTypeSelect" name= "AcctCategory" class="accountCategory">
                                                        <?php


                                                        // Create connection
                                                        $conn = new mysqli('den1.mysql2.gear.host', 'accuaccountingdb', 'letmein559!', 'accuaccountingdb');
                                                        // Check connection
                                                        if ($conn->connect_error) {
                                                            die("Connection failed: " . $conn->connect_error);
                                                        }

                                                        $sql1 = "SELECT * FROM account";
                                                        $result1 = mysqli_query($conn,$sql1);



                                                        while ($row = mysqli_fetch_array($result1)) {

                                                            echo "<option value='" . $row['cat_name'] ."'>" . $row['cat_name']."</option>";

                                                        }
                                                        ?>


                                                    </select></li>

                                            </div>

                                            <div class="chart-accounts-modal">
                                                <li><label for="accountNormalSide">Normal Side</label></li>
                                                <li><select  name = "NormalSide" id="normally" class="normally">
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
                                                <li><select id="accountStatus" name="Status" class=" accountStatus">
                                                        <option>Active</option>
                                                        <option>Inactive</option>
                                                    </select></li>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline btn-danger" id="cancelEdit-buttn"  data-dismiss="modal">Cancel</button>

                                            <button type="submit" class="btn btn-outline btn-success" id="updateAccount-buttn">Update Account</button>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



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
<div id="successModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <?php

                //show msg
                if (isset($_SESSION["Notification"]))
                {
                   echo " <h4 class='modal-title' style='font-size:23px;'>{$_SESSION["Notification"]}</p>";

                }
                ?>



            </div>
            <div class="modal-body">
                <?php

                //show msg
                if (isset($_SESSION["feed_back"]))
                {
                    echo "<p style='font-size:20px;'>{$_SESSION["feed_back"]}</p>";
                }
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
            <!-- /#wrapper -->
            <script type="text/javascript">
                <?php

                if (isset($_SESSION["feed_back"]))
                {
                    //unset message
                    unset($_SESSION["feed_back"]);

                    //show modal
                    echo '$(function() {
                    $( "#successModal" ).modal();
                    });';

                }
                ?>
            </script>

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

<script type="text/javascript">

     $(".btn[data-target='#editModal']").click(function() {

    $('#editModal').on('show.bs.modal', function (e) {
        var _button = $(e.relatedTarget); // Button that triggered the modal

        console.log(_button, _button.parents("tr"));
        var _row = _button.parents("tr");
        var _accountCode = _row.find(".accountNumber").text();
        var _accountName = _row.find(".accountName").text();
        var _accountCategory = _row.find(".accountCategory").text();
        var _accountNormally = _row.find(".normally").text();
        var _accountInitialBalance = _row.find("._accountInitialBalance").text();
        var _accountStatus = _row.find(".accountStatus").text();
        // console.log(_invoiceAmt, _chequeAmt);

        $(this).find(".accountNumber").val(_accountCode);
        $(this).find(".accountName").val(_accountName);


    });




</script>



</body>
</html>
