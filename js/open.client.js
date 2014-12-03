/**
	CISTicket Modification
	Changes to the client open ticket page
**/

$(document).ready(function(){
    
    function updateCourseSubject() {
        // set the hidden field so we can build the subject line easier
         $('.coursesubject').val(
             '[' + $(".deptnamesrc option:selected").text() +
             (($('.courseno').length > 0 && $('.courseno').val().length==3) ? ' ' + $('.courseno').val() : '') + ']'
         );
        // if there is no number provided, goes to [DEPT] instead of [DEPT XXX]
    }
    
	// Copy the department name down by the course number
    $('.deptnamesrc').change(function() {
        if($(".deptnamesrc option:selected").text()!="— Select —") {
            // copy the department to the box beside the number entry
            $('.deptname').attr('value',$(".deptnamesrc option:selected").text());
            // copy the department to the duplicated hidden field
            $('.deptnamevalue').val($(".deptnamesrc option:selected").val());
            updateCourseSubject();
        }
    });
    
    $('.courseno').change(function() {
        var digits = $(this).val();
        if(digits.length==3) {
            // set the 3 digit dropdowns
            $('.coursedigit1').val($('.coursedigit1 .number' + digits.charAt(0)).val());
            $('.coursedigit2').val($('.coursedigit2 .number' + digits.charAt(1)).val());
            $('.coursedigit3').val($('.coursedigit3 .number' + digits.charAt(2)).val());
            
            updateCourseSubject();
        }
    });
    
    $('.deptnamesrc').change(); //trigger right away (in the case where the form had an entry error)

});
    