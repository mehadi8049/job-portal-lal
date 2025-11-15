(function($) {
    "use strict"; // Start of use strict


    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 15,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 4
            },
            600: {
                items: 6
            },
            1000: {
                items: 10
            }
        }
    });
    $("#btn-show-advanced-search").on("click", function(e) {
        $(this).hide();
        $("#btn-hidden-advanced-search").show();
        $('#form-search-advanced').show();
    });

    $("#btn-hidden-advanced-search").on("click", function(e) {
        $(this).hide();
        $("#btn-show-advanced-search").show();
        $('#form-search-advanced').hide();
    });
    $('#form_search').on('submit', function() {
        var keyword = $('#keyword').val();
        var params = [];
        var city = $('#city').val();
        if(city != undefined && city != null && city != '') {
            params.push(`city=${city}`);
        }
        var functionalArea = $('#category').val();
        if(functionalArea != undefined && functionalArea != null && functionalArea != '') {
            params.push(`functionalarea=${functionalArea}`);
        }
        var jobType = $('#job_type').val();
        if(jobType != undefined && jobType != null && jobType != '') {
            params.push(`jobtype=${jobType}`);
        }
        var salaryFrom = $('#salary_from').val();
        if(salaryFrom != undefined && salaryFrom != null && salaryFrom != '') {
            params.push(`salaryfrom=${salaryFrom}`);
        }
        var salaryTo = $('#salary_to').val();
        if(salaryTo != undefined && salaryTo != null && salaryTo != '') {
            params.push(`salaryto=${salaryTo}`);
        }

        var url = url_search_jobs;
        url = url.replace(':q', keyword);
        if(params.length > 0) {
            url += '?' + params.join('&');
        }

        window.location.href = url;
    });
    // trigger open advance filter
    (function(){
        var jobType = $('#job_type').val();
        var salaryFrom = $('#salary_from').val();
        var salaryTo = $('#salary_to').val();
        if(
            (jobType != undefined && jobType != null && jobType != '')
            || (salaryFrom != undefined && salaryFrom != null && salaryFrom != '')
            || (salaryTo != undefined && salaryTo != null && salaryTo != '')
        ) {
            $("#btn-show-advanced-search").trigger('click');
        }
    })();
    
    $('#form_search_home_page').on('submit', function() {
        var keyword = $('#keyword').val();
        var city = $('#city').val();
        var functionalArea = $('#category').val();
        var url = url_search_home_page;
        url = url.replace(':q', keyword);
        window.location.href = url + `?city=${city}&functionalarea=${functionalArea}`;
    });

    $('#form_companies_search').on('submit', function() {
        var keyword = $('#keyword').val();
        var params = [];
        var city = $('#city').val();
        if(city != undefined && city != null && city != '') {
            params.push(`city=${city}`);
        }
        var industry = $('#industry').val();
        if(industry != undefined && industry != null && industry != '') {
            params.push(`industry=${industry}`);
        }

        url_search_companies = url_search_companies.replace(':q', keyword);
        if(params.length > 0) {
            url_search_companies += '?' + params.join('&');
        }

        window.location.href = url_search_companies;
    });

})(jQuery); // End of use strict