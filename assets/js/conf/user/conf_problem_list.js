$(document).ready(function() 
{
    $('.dataTables-example').dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+$('#Lang').val()+".json"
        },
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "../../assets/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
        }
    });

    $( ".openBtn" ).click(function() 
    {
        $( "#FormOpen" ).submit();
    });

    
});

function fill(id) 
{

    if(id != null) 
    {
        
        $.post("../user/problem_fill", {id: ""+id+""}, function(data)
        {
            if(data.length > 0) 
            {
                $('#modal-content').html(data);
            }

            if(data == 'logOut')
                window.location = './logout';
        });    
    } 
}

