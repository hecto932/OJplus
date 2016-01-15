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


    $( ".joinBtn" ).click(function() 
    {
        $("#join").val('TRUE');
        $( "#FormOpen" ).submit();
    });

    $( ".rejectBtn" ).click(function() 
    {
        $("#join").val('FALSE');
        $( "#FormOpen" ).submit();
    });

    
});