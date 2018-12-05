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


   <!-- Metis Menu Plugin JavaScript -->
   <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.1/combined/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.1/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
  <div id="page-wrapper">

                    <!--                                                      Add your code here                                         -->


  <div class="panel panel-default">
    <form method="post" action="insertJournalData.php" onsubmit="return addJournalEntry()">   <!--                             php form                                    -->
  <div class="panel-heading">

        <h1 class="page-header">New Journal Entry</h1>
          <div >
          <!--   Calendar updatedcd -->
           <label>Date: </label> <input id="datepicker" width="276" name="journalDate" required>
         <script>
       var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();
    $('#datepicker').datepicker({
             minDate: new Date(currentYear, currentMonth, currentDate),
            uiLibrary: 'bootstrap4',
            dateFormat: 'yyyy-mm-dd'
        });

         </script>
        </div>


    </div>
    <div class="panel-body">
        <div class="table-responsive">





               <table class="journalize-table display table-hover" align="center" width="100%" id="journal-entry-table">
                  <thead>
                      <tr>

                          <th>Account</th>
                          <th>Debits</th>
                          <th>Credits</th>
                      </tr>
                     <tr>

                           <td>

                             <div style="margin-top: 6px !important; margin-bottom: 6px !important;">





                            <select class="form-control" id="accountSubCSelect"  name="account[]" style="width: 200px;">
                                <option disabled>--Debits--</option>
                                 <?php



                                $sql1 = "SELECT * FROM coa";
                                $result1 = mysqli_query($conn,$sql1);
                                $result2 = mysqli_query($conn,$sql1);

                                        while ($row = mysqli_fetch_array($result1)) {
                                            if($row['NormalSide'] == 'Debit')

                                            echo "<option value='" . $row['AcctName'] ."'>" . $row['AcctName']."</option>";

                                        }
                                       echo  "<option disabled>--Credits--</option>";

                                        while ($rowx = mysqli_fetch_array($result2)) {
                                            if($rowx['NormalSide'] == 'Credit')

                                            echo "<option value='" . $rowx['AcctName'] ."'>" . $rowx['AcctName']."</option>";

                                        }






                                  ?>


                           </select>
                         </div>

                       </td>


                        <td>
                            <div class="form-group input-group" style="margin-left:-50px; margin-top: 6px !important; margin-bottom: 6px !important;">
                                <span class="input-group-addon">$</span><input  style="width: 200px;  text-align:right" type="text" name="debits[]" onkeypress="return isNumberKey(event)" class="form-control debits" >
                            </div>

                        </td>
                        <td>

                            <div class="form-group input-group" style="margin-left:-40px; margin-top: 6px !important; margin-bottom: 6px !important;"><span class="input-group-addon">$</span>
                                <input  type="text" class="form-control credits"  name="credits[]"  onkeypress="return isNumberKey(event)" style="width: 200px; text-align:right" readonly="">
                            </div>

                        </td>

                        <td >
                          <div style="margin-top: 6px !important; margin-bottom: 6px !important;margin-left:-30px;">
                          <button type="button"  class="btn btn-outline btn-primary" id="addDebit" style="margin-right: 10px; "> Add Debit</button>
                          <button type="button"  class="btn btn-outline btn-danger disabled" >Delete</button>
                          </div>
                        </td>
                      </tr>





                     <!--                        row                     -->
                     <tr>

                           <td>

                             <div style="margin-right: 6px !important; margin-bottom: 6px !important; margin-left: 60px !important; ">
                            <select class="form-control" id="accountSubCSelect"  name="account[]" style="width: 200px;">
                                <option disabled="">--Debits--</option>
                               <?php
                               $sql1 = "SELECT * FROM coa";
                                $result1 = mysqli_query($conn,$sql1);
                                $result2 = mysqli_query($conn,$sql1);

                                        while ($row = mysqli_fetch_array($result1)) {
                                            if($row['NormalSide'] == 'Debit')

                                            echo "<option value='" . $row['AcctName'] ."'>" . $row['AcctName']."</option>";

                                        }
                                       echo  "<option disabled>--Credits--</option>";

                                        while ($rowx = mysqli_fetch_array($result2)) {
                                            if($rowx['NormalSide'] == 'Credit')

                                            echo "<option value='" . $rowx['AcctName'] ."'>" . $rowx['AcctName']."</option>";

                                        }


                               ?>
                           </select>
                         </div>

                       </td>


                        <td>
                            <div class="form-group input-group" style="margin-left:10px; margin-top: 6px !important; margin-bottom: 6px !important;">
                                <span class="input-group-addon">$</span><input  style="width: 200px; text-align:right; type="text" name="debits[]"  onkeypress="return isNumberKey(event)" class="form-control debits" readonly="">
                            </div>

                        </td>
                        <td>

                            <div class="form-group input-group" style="margin-left:20px; margin-top: 6px !important; margin-bottom: 6px !important;"><span class="input-group-addon">$</span>
                 <input type="text" class="form-control credits" onkeypress="return isNumberKey(event)" name="credits[]"  style="width:200px; text-align:right; " >
                            </div>

                        </td>

                        <td >
                          <div style="margin-top: 6px !important; margin-bottom: 6px !important;margin-left:20px;">
                               <button type="button"  class="btn btn-outline btn-primary" id="addCredit" style="margin-right: 8px; "> Add Credit</button>
                          <button type="button"  class="btn btn-outline btn-danger disabled">Delete</button>
                          </div>
                        </td>
                      </tr>




                   <tfoot>

                     <td width="10%"></td>
                     <td width="20%"><p style="float:right">$ <span  id= "totaldebits" class="total_debits" style="float:right" >0</span></p></td>
                     <td width="20%"><p style="float:right">$ <span id="totalcredits" class="total_credits" style="float:right">0</span></p></td>

                   </tfoot>

              </table>

              <div class="form-group">
                    <label >Notes</label>
                    <textarea class="form-control" name="description" style="width: 500px;" rows="3" required></textarea>
                    <label>Attach Files</label>
                                <input type="file" onchange="loadFile(event)">
                                <img id="output"/>
                                <script>
                                  var loadFile = function(event) {
                                    var output = document.getElementById('output');
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                  };
                                </script>

                </div>







                <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-danger" id= "cancel-journal-entry-buttn" onclick="cancelDialog()">Cancel</button>
                <button type="submit" class="btn btn-outline btn-info"  id="add-journal-entry-buttn">Submit Journal Entry</button>
                <script type="text/javascript" src="../../js/journalize.js"></script>


              </div>



        </form>
         <?php

       $variable_1 = '$sql1 = "SELECT * FROM coa";$result1 = mysqli_query($conn,$sql1); while ($row = mysqli_fetch_array($result1))';
       $variable_2 = "QScutter";

        ?>
    <span id="storage" data-variable-one="<?php echo $variable_1; ?>" data-variable-two="<?php echo $variable_2; ?>"></span>

          </div><!-- /.table-responsive -->
      </div><!-- /.panel-body -->
  </div><!-- /.panel -->


           <!--                                                     end of your code                   -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>



    <!-- DataTables JavaScript -->
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

</head>



    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

<script type="text/javascript">


</script>


 <script>

$('#addRow').click(function(){

       var newRow = '<tr>';
       var td1 = '<td class="row-id"><div style="margin-top: 6px !important; margin-bottom: 6px !important; margin-right:20px;">';
       var  rowCount = $('#journal-entry-table tr').length -1;

       var td2 = ' <td><div style="margin-top: 6px !important; margin-bottom: 6px !important;"><select class="form-control" id="dynamicSelect" class="selectClass" name="account[]"style="width: 200px;"></select></td>';

       var td3 = '<td> <div class="form-group input-group" style="margin-left:20px; margin-top: 6px !important; margin-bottom: 6px !important;"><span class="input-group-addon">$</span><input  style="width: 200px; text-align:right" type="text" name="debits[]"  onkeypress="return isNumberKey(event)" class="form-control debits" ></div></td>';

       var td4 =   '<td><div class="form-group input-group" style="margin-left:20px; margin-top: 6px !important; margin-bottom: 6px !important;"><span class="input-group-addon">$</span><input  type="text" class="form-control credits"  name="credits[]"   onkeypress="return isNumberKey(event)" style="width: 200px; text-align:right"></div></td>';

       var td5 = '<td ><div style="margin-top: 6px !important; margin-bottom: 6px !important;margin-left:20px;">\<button type="button" id="deleteRow" class="btn btn-danger">Delete</button></div></td></tr>';

       var markup =  newRow  + td1 + rowCount + td2 + td3 + td4 + td5;

 jQuery('#journal-entry-table').append(markup);




     $('#accountSubCSelect').find('option').clone().appendTo('#dynamicSelect');
      $("#dynamicSelect").removeAttr("id");



  });


 </script>



<script type="text/javascript">
    function checkDuplicates(){
        var isfalse = true;
    var existing = [];
    var duplicates = $('#journal-entry-table td:nth-child(1) select').filter(function() {
        var value = $(this).val();
        if (existing.indexOf(value) >= 0) {
            isfalse = false;

        }
        existing.push(value);


    });
    return  isfalse;



    }


</script>



 <script type="text/javascript">
function addJournalEntry(){
    if(checkDuplicates() == false)
    {
          alert('Cannot use the same account more than once.');
        return false;
    }

    var total_debits = document.getElementById("totaldebits").innerText;
    var total_credits = document.getElementById("totalcredits").innerText;
    var date = $("#datepicker").datepicker("getDate");

   if(total_debits ==0 && total_credits==0){
        alert("Debits and credits cannot be zero!");
                return false;
     }
   else if(total_debits != total_credits ) {
        alert("Debits and credits must be balanced.");
        return false;
    }


    else{
         alert("Journal Entry submitted for approval");
         return true;

    }


}

 </script>


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

<script>
    $(document).ready(function() {

        $('#journal-date').datepicker();

    });
</script>

    <script>
    $('body').on('keyup', '.debits', function () {
    setDebitTotal();
    });


  </script>

  <script>
  $('body').on('keyup', '.credits', function () {
  setCreditTotal();
    });

  </script>



<script>
    function renumberRows() {
        var pos =   1;
    $('#journalize-table tr').each(function(){
        $(this).children('td').first().text(pos++);
    });
}
</script>

  <script type="text/javascript">
    //Delete row button handler
$(document).on("click", "[id^='deleteRow']", function () {


    $(this).closest("tr").find('input').val('0');

    setDebitTotal();
    setCreditTotal();


  $(this).closest("tr").remove();
    $(".row-id").each(function (i){
           $(this).text(i+1);
        });
});



</script>


  <script type="text/javascript">
    //Delete row button handler
$(document).on("click", "[id^='addDebit']", function () {
     var newRow = '<tr>';
       var td1 = '<td class="row-id"><div style="margin-top: 6px !important; margin-bottom: 6px !important; margin-right:20px;">';
       var rowCount = $('#journal-entry-table tr').length -1;

       var td2 = '</td><td><div style="margin-top: 6px !important; margin-bottom: 6px !important;"><select class="form-control" id="dynamicSelect" class="selectClass" name="account[]"style="width: 200px;"></select></td>';

       var td3 = '<td> <div class="form-group input-group" style="margin-left:-50px; margin-top: 6px !important; margin-bottom: 6px !important;"><span class="input-group-addon">$</span><input  style="width: 200px; text-align:right" type="text" name="debits[]"  onkeypress="return isNumberKey(event)" class="form-control debits" ></div></td>';

       var td4 =   '<td><div class="form-group input-group" style="margin-left:-40px; margin-top: 6px !important; margin-bottom: 6px !important;"><span class="input-group-addon">$</span><input  type="text" class="form-control credits"   name="credits[]" onkeypress="return isNumberKey(event)" style="width: 200px; text-align:right" readonly=""></div></td>';
       var td5 = '<td ><div style="margin-top: 6px !important; margin-bottom: 6px !important;margin-left:-30px;"><button type="button" id="addDebit" class="btn btn-outline btn-primary" style="margin-right: 13px;">Add Debit</button><button type="button" id="deleteRow" class="btn btn-outline btn-danger">Delete</button></div></td></tr>';

       var markup =  newRow  + td2 + td3 + td4 + td5 ;



    $(this).closest("tr").after(markup);
   // jQuery('#journal-entry-table').append(markup);

     $('#accountSubCSelect').find('option').clone().appendTo('#dynamicSelect');
      $("#dynamicSelect").removeAttr("id");
});





</script>
  <script type="text/javascript">
    //Delete row button handler
$(document).on("click", "[id^='addCredit']", function () {


     var newRow = '<tr>';
       var td1 = '<td class="row-id"><div style="margin-top: 6px !important; margin-bottom: 6px !important; margin-right:20px;">';
       var  rowCount = $('#journal-entry-table tr').length -1;

       var td2 = '</td><td><div style="margin-top: 6px !important; margin-bottom: 6px !important; margin-left: 60px !important;"><select class="form-control" id="dynamicSelect" class="selectClass" name="account[]"style="width: 200px;"></select></td>';

       var td3 = '<td> <div class="form-group input-group" style="margin-left:10px; margin-top: 6px !important; margin-bottom: 6px !important;"><span class="input-group-addon">$</span><input  style="width: 200px; text-align:right"  type="text" name="debits[]"  onkeypress="return isNumberKey(event)" class="form-control debits" readonly=""></div></td>';

       var td4 =   '<td><div class="form-group input-group" style="margin-left:20px; margin-top: 6px !important; margin-bottom: 6px !important;"><span class="input-group-addon">$</span><input  type="text" class="form-control credits"  name="credits[]" onkeypress="return isNumberKey(event)" style="width: 200px; text-align:right"></div></td>';

       var td5 = '<td ><div style="margin-top: 6px !important; margin-bottom: 6px !important;margin-left:20px;"><button type="button" id="addCredit" class="btn btn-outline btn-primary" style="margin-right: 11px;">Add Credit</button><button type="button" id="deleteRow" class="btn btn-outline btn-danger">Delete</button></div></td></tr>';

       var markup =  newRow  +  td2 + td3 + td4  + td5;



    $(this).closest("tr").after(markup);
   // jQuery('#journal-entry-table').append(markup);

     $('#accountSubCSelect').find('option').clone().appendTo('#dynamicSelect');
      $("#dynamicSelect").removeAttr("id");
});





</script>







  <script type="text/javascript">
  function setDebitTotal(){
         var sum = 0;
    $('.debits').each(function() {
      var num = Number($(this).val());
      if(isNaN(num)){
        num = 0;
      }
        sum += num;
    });
         var totalsum = sum.toFixed(2);

        $('.total_debits').html(totalsum);


      }
  </script>
  <script type="text/javascript">

 function setCreditTotal(){
         var sum = 0;
    $('.credits').each(function() {
        var num = Number($(this).val());
        if(isNaN(num)){
          num = 0;
        }
        sum += num;
    });
         var totalsum = sum.toFixed(2);

        $('.total_credits').html(totalsum);

      }
  </script>
<script type="text/javascript">
    function cancelDialog(){

    var response =  confirm("Your changes will not be saved, are you sure you want to cancel? ");
    if (response == true)
     {
     var elmtTable = document.getElementById('journal-entry-table');
    var tableRows = elmtTable.getElementsByTagName('tr');
    var rowCount = tableRows.length;
     $('.total_debits').html(0);
     $('.total_credits').html(0);
     $('#journal-entry-table tbody td').find('input').val('');

    for (var x=rowCount-1; x>4; x--)
       {
       elmtTable.removeChild(tableRows[x]);
       }
      window.location.href = 'managerJournal.php';
     }

}

</script>










</body>


</html>
