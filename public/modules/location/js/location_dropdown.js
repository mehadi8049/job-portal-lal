(function($) {
  "use strict";

  const fnStates = function(selected){
    let country_id = $(`[name="${NAME_COUNTRY}"]`).val();

    let url = URL_GET_STATES_AJAX + "?country_id=" + country_id;
    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
          var template = `<option value="" ${selected == '' ? 'selected' : ''}>@lang('Select') ${LABEL_STATE}</option>`;
          data.forEach((ele) => {
              template += `<option value="${ele.id}" ${selected == ele.id ? 'selected' : ''}>${ele.name}</option>`
          });
          $(`[name="${NAME_STATE}"]`).html(template);

          fnCities(VALUE_CITY);
          VALUE_CITY = '';
        }
    });
  };

  const fnCities = function(selected = ''){
    let state_id = $(`[name="${NAME_STATE}"]`).val();

    let url = URL_GET_CITIES_AJAX + "?state_id=" + state_id;
    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
          var template = `<option value="" ${selected == '' ? 'selected' : ''}>@lang('Select') ${LABEL_CITY}</option>`;
          data.forEach((ele) => {
              template += `<option value="${ele.id}" ${selected == ele.id ? 'selected' : ''}>${ele.name}</option>`
          });
          $(`[name="${NAME_CITY}"]`).html(template);
        }
    });
  };

  fnStates(VALUE_STATE);
  VALUE_STATE = '';

  $(`[name="${NAME_COUNTRY}"]`).on('change', function() {
    fnStates();
  });
  $(`[name="${NAME_STATE}"]`).on('change', function() {
    fnCities();
  });

})(jQuery); // End of use strict

