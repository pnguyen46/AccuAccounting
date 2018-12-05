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


    <!-- Bootstrap Core CSS #4c8faf-->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript" src="../../vendor/jspdf/jspdf.min.js"></script>


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
                    <div  id="docHeaders" style=" text-align: center">
                        <ul style="list-style-type: none">
                          <label style='font-size:18px; color: #2a6496;'  align='center'>AccuAccounting Application</label><li><label style='font-size:18px; color: #2a6496;'  align='center'>Trial Balance</label></li><button type="button"  class="btn btn-outline  btn-primary"  id="download" onclick="downloadTrialBalance()" style="margin-left: 15px !important; padding: 9px 18px; "> <i class="fa fa-download"></i></button></li>

                                <li>    <label style='font-size:18px; color: #2a6496;' id='date' align='center'></label></li></ul>
                            </div>


                    <div id='tablediv'>
                        <table id='customers'>
                            <thead>
                            <th>Account Tile</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            </thead>
                            <tbody>

            <?php

            $sql = "SELECT AcctName,NormalSide, Balance FROM coa  WHERE hasTransactions = '1' order by AcctNumber asc";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result)) {


                $maketable=" ";

                $credit=0;
                $debit=0;
                                                        // output data of each row
                $isFirstDebit = 0;
                $isFirstCredit = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    if($row['NormalSide']==="Debit" && $row['Balance']!= 0){
                        $isFirstDebit++;
                        if($isFirstDebit == 1)
                        {
                             $debit+=$row['Balance'];
                            $maketable.='<tr><td>'.$row['AcctName'].'</td><td style="text-align:right">$'.number_format( $row['Balance'], 2 ).'</td><td></td></tr>';
                            $isFirstDebit = 9;
                        }
                        else
                        {
                            $debit+=$row['Balance'];
                            $maketable.='<tr><td>'.$row['AcctName'].'</td><td style="text-align:right">'.number_format( $row['Balance'], 2 ).'</td><td></td></tr>';
                            $isFirstDebit = 9;


                        }

                    }
                    else if($row['NormalSide']==="Credit" && $row['Balance']!= 0 )
                    {
                        $isFirstCredit++;
                        if($isFirstCredit == 1)
                        {
                        $credit+=$row['Balance'];
                        $maketable.='<tr><td >'.$row['AcctName'].'</td><td></td><td style="text-align:right">$'.number_format( $row['Balance'], 2 ).'</td></tr>';
                         $isFirstCredit = 9;

                        }
                        else
                        {
                        $credit+=$row['Balance'];
                        $maketable.='<tr><td >'.$row['AcctName'].'</td><td></td><td style="text-align:right">'.number_format( $row['Balance'], 2 ).'</td></tr>';
                         $isFirstCredit = 9;


                        }




                    }
                }

                $debitFormated = number_format( $debit, 2 );
                $creditFormated = number_format( $credit, 2 );

                $maketable.='<tr><td>Total </td><td><span style="float: right;border-top-style:none;border-right-style:none;border-bottom-style:double;border-left-style:none;border-width: 2px solid black;"
>$'.$debitFormated.'</span></td><td><span style="float: right;border-top-style:none;border-right-style:none;border-bottom-style:double;border-left-style:none;border-width: 2px solid black;"
>$'.$creditFormated.'</span></td></tr>';
                print $maketable;
            }
            $conn->close();
            ?>

</tbody></table></div>



           <!--                                                     end of your code                   -->
        </div>
        <!-- /#page-wrapper -->




    </div>
    <!-- /#wrapper -->
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

          pdf.text(250,40, 'Trial Balance');
          pdf.text(250,60, 'Accu Accounting');
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
        pdf.save('Trial Balance.pdf');
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
