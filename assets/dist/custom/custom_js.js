/*
 (function ($){
 "use strict";
 var editor;
 $('#data_table_example').DataTable({
 dom       : 'Bfrtip',
 buttons   : [
 'copy', 'csv', 'excel', 'pdf', 'print'
 ],
 responsive: true
 });
 
 })(jQuery);
 */

$(document).ready(function (){
    "use strict";
    var editor;
    $('#data_table_example').DataTable({
        dom       : 'Bfrtip',
        buttons   : [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true
    });
    
    $('#calendar-month_enddate').datepicker({
        showOtherMonths  : true,
        selectOtherMonths: true,
        beforeShowDay    : function (date){
            
            // add leading zero to single digit date
            var day = date.getDate();
            console.log(day);
            return [true, (day < 10 ? 'zero' : '')];
        },
        dateFormat       : 'yy-mm-dd'
    });
    
    $('#calendar-select-month-year').datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
    
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });
    
    $('#calendar-month_moth_view').datepicker({
        showOtherMonths  : true,
        selectOtherMonths: true,
        beforeShowDay    : function (date){
        
            // add leading zero to single digit date
            var day = date.getDate();
            console.log(day);
            return [true, (day < 10 ? 'zero' : '')];
        },
        dateFormat       : 'mm-yy'
    });
    
    $('.clockpicker').clockpicker()
                     .find('input').change(function (){
        console.log(this.value);
    });
});