/**
	CISTicket Modification
	Changes to the client open ticket page
**/

$(document).ready(function(){
    
    var updateCourseSubject =  function() {
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
            $('.deptnamecopy').attr('value',$(".deptnamesrc option:selected").text());
            // copy the department to the duplicated hidden field
            //$('.deptnamevalue').val($(".deptnamesrc option:selected").val());
            updateCourseSubject();
        }
    });
    
    //when the number changes, we may have to update the field
    $('.courseno').change(updateCourseSubject);
    
    $('.deptnamesrc').change(); //trigger right away (in the case where the form had an entry error)

});