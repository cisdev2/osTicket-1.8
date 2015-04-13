$(document).ready(function () {
    $(window).resize(function () {
        $("#loading").css({
            top  : ($(window).height() / 3),
            left : ($(window).width() / 2 - 160)
        });
    });

    var setupForm = function(){
        // Copy the department name down by the course number
        $('.deptnamesrc').change(function() {
            var deptname = $(".deptnamesrc option:selected").text();
            if(deptname !=="— Select —") {
                // copy the department to the box beside the number entry
                $('.deptnamecopy').attr('value',deptname);
                // update the hidden field
                $('.coursesubject').attr('value',deptname);
            }
        });

        //when the number changes, we may have to update the field
        $('.courseno').change(function() {
            var digits = $(this).val();
            if(digits.length==3 || digits.length==4) {
                $('.coursenumber').attr('value',digits);
            }
        });

        $('.deptnamesrc').change(); //trigger right away (in case of form error or help topic change)
        $('.courseno').change();
    };

    // for the normal (generic) form, if the help topic changes
    // we need to re-bind the form events
    var maxCalls = 6; // 6 * 500ms = 3 seconds (if a .courseno field doesn't appear by then, assume it doesn't have one)
    var dynamicFormSetup = function() {
        if($('.courseno').length>0) {
            setupForm();
        } else if(maxCalls > 0) {
            maxCalls -= 1;
            setTimeout(dynamicFormSetup,500);
        }
    };

    // bind dynamicFormSetup() to when the request topic dropdown changes
    $('#topicId').change(function() {
        maxCalls = 6; // reset the value
        setTimeout(dynamicFormSetup,500); // give the form some time to change
    });

    // call setupForm (for both specific and generic forms)
    setupForm();
});
