(function($) {
    "use strict"; // Start of use strict

    $('#user_role_select').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        if (valueSelected) {
            if (valueSelected != 'employer') {
              $("#row_package_user").addClass("d-none");
            }
            else{
              $("#row_package_user").removeClass("d-none");
            }
        }
    });
   

})(jQuery); // End of use strict