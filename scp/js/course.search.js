/**
	CISTicket Modification
	Adds quick course search to tickets page
**/

var bindCourseSearch = function(){
    
    //inner function that actually completes the search
    var searchByCourse = function(e) {
        // don't actually do the browser default
        e.preventDefault();

        //reset previous attempts (eg. if invalid department)
        $('#course_search input').css("background-color","#fff");
        $('.nocourseresults').hide(200);

        // get the user input
        var coursedata = $('#course_search input').val().trim().replace(' ','').replace('.','');

        // check if dept valid
        var coursedept = coursedata.substring(0,4);
        var found = false;
        $('#advanced-search .deptnamevalue option').each(function() {
            if($(this).text().toUpperCase()===coursedept.toUpperCase()) {
                $('#advanced-search .deptnamevalue').val($(this).val());
                found = true;
            }
        });

        // if the dept was not found, give an error
        if(!found) {
            $('#course_search input').css("background-color","#eab7b7");
            return;
        }

        // deal with number
        digit1 = coursedata.charAt(4);
        digit2 = coursedata.charAt(5);
        digit3 = coursedata.charAt(6);

        // if any of them is numeric, just inject it; otherwise, "wildcard"
        if($.isNumeric(digit1)) {
            $('.coursedigit1').val($('.coursedigit1 .number' + digit1).val());
        }
        if($.isNumeric(digit2)) {
            $('.coursedigit2').val($('.coursedigit2 .number' + digit2).val());
        }
        if($.isNumeric(digit3)) {
            $('.coursedigit3').val($('.coursedigit3 .number' + digit3).val());
        }

        // trigger the form and redirect the user
        $('.courseloading').show(200); //show loading animation
        $('#course_search input').css("background-color","#b7eacf");
        // even through the form is hidden, we can still submit the previous injected values
        $('#advanced-search form').submit();

        function courseloaded() {
            // even through the advanced form is hidden, we can still access the search results
            if($('#result-count .fail').length>0) {
                // fail case
                $('.courseloading').hide(200);
                $('.nocourseresults').show(200);
                $('#course_search input').css("background-color","#f4f476");
            } else if ($('#result-count .success').length>0) {
                // success case
                $('.courseloading').hide(200);
                // redirect the user to the link in the advanced search form result
                window.location.replace($('#result-count .success a').attr('href'));
            } else {
                // still waiting for the advanced search form to get a response\
                // call myself
                setTimeout(courseloaded,500);
            }
        }

        // wait for the form to get a response...
        setTimeout(courseloaded,500);

    }
    
    // bind the button or the "enter" key to the function above
    $('#course_search form').submit(searchByCourse);
    $('#course_search button').click(searchByCourse);

}

$(document).ready(bindCourseSearch);
