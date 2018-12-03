$(function() {
    $('#side-menu').metisMenu();
});


$(document).ready(function() {
        $('#chart-of-accounts-table').DataTable({
            responsive: true
        });



       $('#chart-of-accounts-table').on('click', '.viewAccount', function() {
          var self = $(this).closest("tr");
          var code = self.find(".accountCode").text();
          var name = self.find(".accountName").text();
          var initialBalance = self.find(".initialBalance").text();
          var status =  self.find(".accountStatus").text();
          var normally =  self.find(".normally").text();
          var group =  self.find(".accountTypeSelect").text();
          var subgroup = self.find(".accountSubCSelect").text();

           
          var acode = '<div class="chart-accounts-modal"><li><label>Account Code</label></li><li><span>' + code + '</span></li></div>';
          var aname = '<div class="chart-accounts-modal"><li><label>Account Name</label></li><li><span>' + name + '</span></li></div>';
          var ainitialBalance = '<div class="chart-accounts-modal"><li><label>Initial Balance</label></li><li><span>' + initialBalance + '</span></li></div>';
          var astatus = '<div class="chart-accounts-modal"><li><label>Account Status</label></li><li><span>' + status + '</span></li></div>';
          var anormal = '<div class="chart-accounts-modal"><li><label>Normal Side</label></li><li><span>' + normally + '</span></li></div>';
          var agroup = '<div class="chart-accounts-modal"><li><label>Group</label></li><li><span>' + group + '</span></li></div>';
          var asubgroup = '<div class="chart-accounts-modal"><li><label>SubGroup</label></li><li><span>' + subgroup + '</span></li></div>';

          //TODO QUERY DB TO GET who submitted it, and when it was created, etc
         
          data = acode + aname + ainitialBalance + astatus + anormal + agroup + asubgroup;
          return $.fn.alert(data);
    });
          });


//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});


/***                                                                 CHART OF ACCOUNTS related scripts here                                                                *****/

//make sure values are not empty
function addChartAccount(){
    var accountName = $("#accountName").val();
    var accountNumber = $("#accountNumber").val();
    var initialBalance = $("#initialBalance").val();


    if(accountName == "" || accountNumber == "" || initialBalance == "" || initialBalance < 1){
           if(initialBalance ==0 )
                 alert("Initial Balance cannot be zero.");
           else if(initialBalance<0){
                 alert("Initial Balance cannot be negative.");
            } 
           else
             alert("Cannot have empty fields.");

         return false;
    }
    else if(hasDuplicate(accountName)||hasDuplicate(accountNumber))
        alert("Please enter a unique account name and number.");
    else{
        addRow();
    }
}


function addRow(){
    var accountName = $("#accountName").val();
    var accountCode = $("#accountNumber").val();
    var accountStatus = $("#accountStatus").val();
    var initialBalance = $("#initialBalance").val();
    var normally = $("#normally").val();
    var group = $("#accountTypeSelect").val();
    var subgroup = $("#accountSubCSelect").val();
    
    var row_open = '<tr>'
    var row_close = '</tr>'
    var td_open = '<td>';
    var td_close = '</td>';



    var div = '<div class= "chart-row-data-template">';
   
    var buttonEdit = '<li><button type="button" id="editButton" class="btn btn-outline btn-success">Edit</button></li>';
    var buttonView = '<li><button type=""button" class="viewAccount btn btn-outline btn-primary">View</button></li></div>';
    var td1 = '<td class="accountCode">' + accountCode + td_close; 
    var td2 = '<td class="accountName">' + accountName + td_close ;
    var td3 = '<td class="initialBalance">' + initialBalance  + td_close;
    var td31 = '<td class="normally">' + normally  + td_close;
    var td32 = '<td class="group">' + group  + td_close;
    var td33 = '<td class="subgroup">' + subgroup  + td_close;
    var td4 = '<td class="accountStatus">' + accountStatus + td_close;
    var td5 = td_open + div + buttonEdit + buttonView + td_close;
    var markup = row_open +td1 + td2+ td3+ td31 + td32 + td4 + td5 + row_close;
    var table = $('#chart-of-accounts-table').DataTable();
    table.row.add($(markup)).draw(false);

     //TODO find a better way to reset values back
    document.getElementById("accountName").value = "";
    document.getElementById("accountNumber").value = "";
    document.getElementById("initialBalance").value = "";
    $('#myModal').modal('toggle');


}


(function ($)
{
    $.utils = {
        // http://stackoverflow.com/a/8809472
        createUUID: function ()
        {
            var d = new Date().getTime();
            if (window.performance && typeof window.performance.now === "function")
            {
                d += performance.now(); //use high-precision timer if available
            }
            var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c)
            {
                var r = (d + Math.random() * 16) % 16 | 0;
                d = Math.floor(d / 16);
                return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });
            return uuid;
        }
    }

    $.fn.dialogue = function (options)
    {
        var defaults = {
            title: "", content: $("<p />"),
            closeIcon: false, id: $.utils.createUUID(), open: function () { }, buttons: []
        };
        var settings = $.extend(true, {}, defaults, options);

        // create the DOM structure
        var $modal = $("<div />").attr("id", settings.id).attr("role", "dialog").addClass("modal fade")
                        .append($("<div />").addClass("modal-dialog")
                            .append($("<div />").addClass("modal-content")
                                .append($("<div />").addClass("modal-header")
                                    .append($("<h4 />").addClass("modal-title").text(settings.title)))
                                .append($("<div />").addClass("modal-body")
                                    .append(settings.content))
                                .append($("<div />").addClass("modal-footer")
                                )
                            )
                        );
        $modal.shown = false;
        $modal.dismiss = function ()
        {
            // loop until its shown
            // this is only because you can do $.fn.alert("utils.js makes this so easy!").dismiss(); in which case it will try to remove it before its finished rendering
            if (!$modal.shown)
            {
                window.setTimeout(function ()
                {
                    $modal.dismiss();
                }, 50);
                return;
            }

            // hide the dialogue
            $modal.modal("hide");
            // remove the blanking
            $modal.prev().remove();
            // remove the dialogue
            $modal.empty().remove();

            $("body").removeClass("modal-open");
        }

        if (settings.closeIcon)
            $modal.find(".modal-header").prepend($("<button />").attr("type", "button").addClass("close").html("&times;").click(function () { $modal.dismiss() }));

        // add the buttons
        var $footer = $modal.find(".modal-footer");
        for(var i=0; i < settings.buttons.length; i++)
        {
            (function (btn)
            {
                $footer.prepend($("<button />").addClass("btn btn-default")
                    .attr("id", btn.id)
                    .attr("type", "button")
                    .text(btn.text)
                    .click(function ()
                    {
                        btn.click($modal)
                    }))
            })(settings.buttons[i]);
        }

        settings.open($modal);

        $modal.on('shown.bs.modal', function (e) {
            $modal.shown = true;
        });
        // show the dialogue
        $modal.modal("show");

        return $modal;
    };
})(jQuery);

(function ($)
{
     $.fn.alert = function (message)
    {
        
          return $.fn.dialogue({
            title: "View Account Details", 
            content: message,
            closeIcon: true,
            buttons: [
                { text: "Close", id: $.utils.createUUID(), click: function ($modal) { $modal.dismiss(); } }
            ]
        });
    };

})(jQuery);



//check for duplicates
function hasDuplicate(value){

    if ($('#chart-of-accounts-table td:contains(' + value + ')').length)
        return true
    return false
}

function cancelDialog(){

    var response =  confirm("Your changes will not be saved, are you sure you want to cancel? ");
    if (response == true) {
          //TODO find a better way to reset values back
           
            $('#myModal').modal('toggle');
    }


}
