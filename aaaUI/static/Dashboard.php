<?php
include 'base.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <style>
        #dash{
            margin-top: 10px;
        }

    </style>

</head>

<body>
<div id="wrapper">
<div id="page-wrapper">
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
            <div id="page-wrapper">
                <div class="col-lg-12">
                  <h1 class="page-header">Dashboard</h1>
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
    <script>
    $(document).ready(function() {
        $('#chart-of-accounts-table').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
