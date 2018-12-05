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
    <div id="page-wrapper">
        <div  id="docHeaders" style=" text-align: center">
            <ul style="list-style-type: none">
                <label style='font-size:18px; color: #2a6496;'  align='center'>AccuAccounting Application</label><li> <label style='font-size:18px; color: #2a6496;' align='center'>Balance Sheet</label></li>
                <li><button type="button"  class="btn btn-outline  btn-primary"  id="download" onclick="downloadTrialBalance()" style="margin-left: 15px !important; padding: 9px 18px; "> <i class="fa fa-download"></i></button></li>

                <li>    <label style='font-size:18px; color: #2a6496;' id='date' align='center'></label></li></ul>
        </div>


        <div id='tablediv'>
            <table id='customers'>
                <thead>

                </thead>
                <tbody>

                <!--                                                      Add your code here                                         -->
        <div>
            <?php
            $host="den1.mysql2.gear.host";
            $dbusername ="accuaccountingdb";
            $dbpassword = "letmein559!";
            $dbname ="accuaccountingdb";
            $occupation = array('Admin', 'Manager', 'Accountant');
            $status = array('Active', 'Inactive');

            // Create connection

            $sql = "SELECT AcctName,AcctCategory, Balance FROM coa order by AcctNumber asc";
            $result = mysqli_query($conn, $sql);
            $revenuesum = 0;
            $expensesum = 0;

            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if (($row['AcctCategory'] === "Expense")) {
                        $expensesum += $row['Balance'];

                    } else if (($row['AcctCategory'] === "Revenue")) {
                        $revenuesum += $row['Balance'];
                    }
                }
            }
            $net=$revenuesum-$expensesum;

            $sql = "SELECT AcctName, AcctCategory,Balance FROM coa order by AcctNumber asc";
            $result = mysqli_query($conn, $sql);
            $totalre = 0;
            if (mysqli_num_rows($result)) {
                $re=0;
                $dividends=0;
                $buildre='';
                $builddividend='';
                while ($row = mysqli_fetch_assoc($result)) {
                    if($row['AcctCategory']==="Owners Equity"){
                        if($row['AcctName']==="Retained Earning"){
                            $re+=$row['Balance'];

                        }
                        else if($row['AcctName']==="Dividends"){
                            $dividends+=$row['Balance'];
                        }
                    }
                }
                $totalre=($re+$net)-$dividends;
            }

            $sql = "SELECT AcctName,AcctCategory, Balance FROM coa order by AcctNumber asc";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result)) {

                $revenuesum = 0;
                $expensesum = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    if (($row['AcctCategory'] === "Expense")) {
                        $expensesum += $row['Balance'];

                    } else if (($row['AcctCategory'] === "Revenue")) {
                        $revenuesum += $row['Balance'];

                    }
                }
            }
            $net=$revenuesum-$expensesum;

            $re=0;
            $dividends=0;
            $buildre='';
            $builddividend='';
            while ($row = mysqli_fetch_assoc($result)) {
                if($row['AcctCategory']==="Owners Equity"){
                    if($row['AcctName']==="Retained Earning"){
                        $re+=$row['Balance'];
                        $buildre.='<tr><td>Beg '.$row['AcctName'].'</td><td style="text-align:right">$'.number_format( $row['Balance'], 2 ).'</td><td></td></tr>';

                    }
                    else if($row['AcctName']==="Dividends"){
                        $dividends+=$row['Balance'];
                        $builddividend.='<tr><td>Less: '.$row['AcctName'].'</td><td style="border-bottom:1px solid black; text-align:right">'.number_format( $row['Balance'], 2 ).'</td><td></td></tr>';
                    }

                }


            }
            $totalre=($re+$net)-$dividends;

            $sql = "SELECT AcctName, AcctCategory,Balance FROM coa order by AcctNumber asc";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result)) {
                $maketable=" ";
                $accsum = 0;
                $assetsum=0;
                $propertysum=0;
                $liabitltysum=0;
                $unearnedrevenuesum=0;
                $stockholderequity=0;
                $totalnet = 0;

                $buildacc= '';
                $buildcurrentassets='';
                $buildproperty='';
                $buildunearnedrevenue='';
                $buildliabilty='';
                $buildstockholderequity='';
                $isfirstasset=true;
                $liabityarray=array();
                while ($row = mysqli_fetch_assoc($result)) {
                    if($row['AcctCategory']==="Asset"){
                        if($row['AcctName']==="Office Equipment"){
                            $propertysum+=$row['Balance'];
                            $buildproperty.='<tr><td>'.$row['AcctName'].'</td><td style="text-align:right">'.number_format( $row['Balance'], 2 ).'</td><td></td></tr>';

                        }
                        else if($row['AcctName']==="Accumulated Depreciation"){
                            $accsum+=$row['Balance'];
                            $buildacc.='<tr><td>'.$row['AcctName'].'</td><td style="text-align:right">('.number_format( $row['Balance'], 2 ).')</td><td></td></tr>';
                        }
                        else{
                            if($isfirstasset){
                                $assetsum+=$row['Balance'];
                                $buildcurrentassets.='<tr><td>'.$row['AcctName'].'</td><td style="text-align:right">$'.number_format( $row['Balance'], 2 ).'</td><td></td></tr>';
                                $isfirstasset=false;

                            }
                            else{
                                $assetsum+=$row['Balance'];
                                $buildcurrentassets.='<tr><td>'.$row['AcctName'].'</td><td style="text-align:right">'.number_format( $row['Balance'], 2 ).'</td><td></td></tr>';

                            }


                        }
                        $totalnet = $propertysum - $accsum;
                    }
                    else if($row['AcctCategory']==="Liability" ){

                        if($row['AcctName']==="Unearned Revenue"){
                            $unearnedrevenuesum+=$row['Balance'];
                            //$buildunearnedrevenue.='<tr><td>'.$row['AcctName'].'</td><td></td><td style="text-align:right">'.number_format( $row['Balance'], 2 ).'</td></tr>';
                        }
                        else{
                            $liabitltysum+=$row['Balance'];
                            array_push($liabityarray,[$row['AcctName'],$row['Balance']]);
                            //$buildliabilty.='<tr><td>'.$row['AcctName'].'</td><td style="text-align:right">'.number_format( $row['Balance'], 2 ).'</td><td></td></tr>';

                        }

                    }

                    else if($row['AcctCategory']==="Owners Equity"){
                        if($row['AcctName'] === "Retained Earning") {
                            $stockholderequity+=$totalre;
                            $buildstockholderequity.='<tr><td>'.$row['AcctName'].'</td><td></td><td style="text-align:right">'.number_format( $totalre, 2 ).'</td></tr>';
                        }
                        else {
                            $stockholderequity+=$row['Balance'];
                            $buildstockholderequity.='<tr><td>'.$row['AcctName'].'</td><td></td><td style="text-align:right">'.number_format( $row['Balance'], 2 ).'</td></tr>';
                        }

                    }

                }

                for($i=0;$i<count($liabityarray);$i++)
                {
                    if($i===(count($liabityarray)-1)){
                        $buildliabilty.='<tr><td>'.$liabityarray[$i][0].'</td><td style="text-align:right">$'.number_format($liabityarray[$i][1], 2 ).'</td><td></td></tr>';
                    }
                    else{
                        $buildliabilty.='<tr><td>'.$liabityarray[$i][0].'</td><td style="text-align:right">'.number_format($liabityarray[$i][1], 2 ).'</td><td></td></tr>';
                    }
                }

                $maketable.='<tr><th>Assets</th><th style="text-align: center;">$</th><th style="text-align: center;">$</th></tr><tr><th>Current Assets</th><th style="text-align:center"></th><th style="text-align:center"></th></tr>'.$buildcurrentassets.'<tr><td>Total Current Asset</td><td></td><td style="text-align:right">$'. number_format( $assetsum, 2 ).'</td></tr>';

                $maketable.='<tr><th>Propety Plant and Equipment</th><th style="text-align:center">$</th><th style="text-align:center">$</th></tr>'. $buildproperty.$buildacc.'<tr><td>Property Plant and Equipment,Net</td><td></td><td style="border-bottom:1px solid black; text-align:right">'.number_format( $totalnet, 2 ).'</td></tr>';
                $totalasset=$assetsum+$totalnet;

                $maketable.='<tr><td>Total Assets</td><td></td><td style="border-bottom:4px double black;text-align:right">'.number_format( $totalasset, 2 ).'</td></tr>';

                $maketable.='<tr><th>Liabilities and StockHolders Equity </th><th style="text-align: center;">$</th><th>$</th style="text-align: center;"></tr><tr><th>Liabilities</th><th style="text-align:center"></th><th style="text-align:center"></th></tr>'. $buildliabilty.'<tr><td>Total Current Liabilities</td><td></td><td style="text-align:right">'. number_format( $liabitltysum, 2 ).'</td></tr>';
                $maketable.=$buildunearnedrevenue.'<tr><td>Unearned Revenue</td><td></td><td style="border-bottom:1px solid black; text-align:right"">'.  number_format( $unearnedrevenuesum, 2 ) .'</td></tr>';
                $totalliabilities=$liabitltysum+$unearnedrevenuesum;
                $maketable.='<tr><td>Total Liabilities</td><td></td><td style="border-bottom:1px solid black; text-align:right"">'. number_format( $totalliabilities, 2 ).'</td></tr>';

                $maketable.='<tr><th>StockHolder Equity  </th><th style="text-align:center">$</th><th style="text-align:center">$</th></tr>'.$buildstockholderequity.'<tr><td>Total Stockholder Equity</td><td></td><td style="border-bottom:1px solid black; text-align:right"">'. number_format( $stockholderequity, 2 ).'</td></tr>';
                $totalliabilitiesandequity=$totalliabilities+$stockholderequity;
                $maketable.='<tr><td>Total Liabilities and Stockholder Equity</td><td></td><td style="border-bottom:4px double black; text-align:right">$'.number_format( $totalliabilitiesandequity, 2 ).'</td></tr>';




                print $maketable;
            }
            $conn->close();
            ?>
        </div>
























        <!--                                                     end of your code                   -->
    </div>
    <!-- /#page-wrapper -->



































</div>
<!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="../../vendor/jspdf/jspdf.min.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#chart-of-accounts-table').DataTable({
            responsive: true
        });
    });
</script>
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

            pdf.text(250,40, 'Balance Sheet');
            pdf.text(250,60, 'AccuAccounting');
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
                    pdf.save('Balance Sheet.pdf');
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
