$(document).ready(function() 
{
    $('.dataTables-example').dataTable({
        "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+$('#Lang').val()+".json"
        },
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "../assets/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
        }
    });

    $( ".openBtn" ).click(function() 
    {
        $( "#FormOpen" ).submit();
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
      var switchery = new Switchery(html, { color: '#1AB394' });

    });

    var changeCheckbox = document.querySelector('.js-check-change')
      , changeField = document.querySelector('.js-check-change-field');


    changeCheckbox.onchange = function() 
    {
        $('#all').val(changeCheckbox.checked);
    }
});