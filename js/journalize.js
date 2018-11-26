$(function() {
    $('#side-menu').metisMenu();
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
);

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


/***                                                                 JOURNALIZE scripts here                                                              *****/





//check for duplicates




function resetTableState(){
var elmtTable = document.getElementById('journal-entry-table');
var tableRows = elmtTable.getElementsByTagName('tr');
var rowCount = tableRows.length;

for (var x=rowCount-1; x>3; x--) {
   elmtTable.removeChild(tableRows[x]);
}



}
function addJournalEntry(){
    var total_debits = document.getElementById("totaldebits").innerText;
    var total_credits = document.getElementById("totalcredits").innerText;
    if(total_debits != total_credits ){
        alert("Debits and credits must be balanced");
        return false;
         
    }
    else{
         alert("Journal Entry submitted for approval");
         return true;
         
    }
    
    
}
$(function() {
    $('#side-menu').metisMenu();
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


/***                                                                 JOURNALIZE scripts here                                                              *****/





//check for duplicates
/*

function cancelDialog(){

    var response =  confirm("Your changes will not be saved, are you sure you want to cancel? ");
    if (response == true) {
     $("#journalize-table tr:gt(3)").remove();
        
    }


}
*/



function resetTableState(){
var elmtTable = document.getElementById('journal-entry-table');
var tableRows = elmtTable.getElementsByTagName('tr');
var rowCount = tableRows.length;

for (var x=rowCount-1; x>3; x--) {
   elmtTable.removeChild(tableRows[x]);
}



}
function addJournalEntry(){
    var total_debits = document.getElementById("totaldebits").innerText;
    var total_credits = document.getElementById("totalcredits").innerText;
    if(total_debits != total_credits ){
        alert("Debits and credits must be balanced");
        return false;
         
    }
    else{
         alert("Journal Entry submitted for approval");
         return true;
         
    }
    
    
}
