(function($) {
  "use strict";

  const fnFetch = function(){
      let country_id = $('[name="country_id"]').val();
      if(country_id == undefined || country_id == null || country_id == '') {
          return;
      }

      let url = URL_GET_STATES_AJAX + "?country_id=" + country_id;
      $.ajax({
          url: url,
          type: 'GET',
          success: function (data) {
              var template = '';
              data.forEach((ele) => {
                  template += `<option value="${ele.id}" ${DEFAULT_STATE == ele.id ? 'selected' : ''}>${ele.name}</option>`
              });
              $('[name="state_id"]').html(template);
          }
      });
  }
  fnFetch();
  $('[name="country_id"]').on('change', function(){
      fnFetch();
  });

})(jQuery); // End of use strict

