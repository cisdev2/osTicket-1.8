/**
	CISTicket Modification
	Changes to the client open ticket page
**/

$(document).ready(function(){

    var setupForm = function(){
        // Copy the department name down by the course number
        $('.deptnamesrc').change(function() {
            if($(".deptnamesrc option:selected").text()!=="— Select —") {
                // copy the department to the box beside the number entry
                $('.deptnamecopy').attr('value',$(".deptnamesrc option:selected").text());
                // update the hidden field
                $('.coursesubject').attr('value',$(".deptnamesrc option:selected").text());
            }
        });

        //when the number changes, we may have to update the field
        $('.courseno').change(function() {
            var digits = $(this).val();
            if(digits.length==3 || digits.length==4) {
                $('.coursenumber').attr('value',digits);
            }
        });

        $('.deptnamesrc').change(); //trigger right away (in the case where the form had an entry error)
        $('.courseno').change();
    };
    
    var dynamicFormSetup = function() {
        if($('.courseno').length>0) {
            setupForm();
        } else {
            setTimeout(dynamicFormSetup,500);
        }
    };

    setupForm();
    $('#topicId').change(dynamicFormSetup);
    
});
