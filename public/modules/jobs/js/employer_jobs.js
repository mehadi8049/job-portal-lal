(function($) {
  "use strict";

  $('#expiry_date').datetimepicker({
    format: 'YYYY-MM-DD'
  });
  tinymce.init({
    plugins: 'link',
    selector: '#description'
  });
  tinymce.init({
    plugins: 'link',
    plugins: 'lists',
    toolbar: 'numlist bullist',
    lists_indent_on_tab: true,
    selector: '#responbilities'
  });
  tinymce.init({
    plugins: 'link',
    plugins: 'lists',
    toolbar: 'numlist bullist',
    lists_indent_on_tab: true,
    selector: '#requirements'
  });

})(jQuery); // End of use strict

