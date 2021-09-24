// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('.dataTable').DataTable({
    "searching": false,
    "pagingType": "simple_numbers",
    // "lengthMenu" : false,
    "lengthChange" : false,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
  }
  });
});
