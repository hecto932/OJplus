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

    $('#send').on('click', function() 
    {   
        if ($.trim($("#message").val())) 
        {
            SendUser($('#idmarathon').val(),$('#message').val(),$('#idroom').val());  
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

function Fill(problem,marathon) 
{
    $("#chat").empty();
    
    $.post("../Jury/FillTeamClarification", {problem: ""+problem+"",marathon: ""+marathon+""}, function(data)
    {          
        if(data.length > 0) 
        {
            $("#chat").append(data);
        }

        if(data == 'logOut')
                        window.location = './logout';
    });
}

function SendUser(marathon,text,problem) 
{
    if(problem >0)
    {
        $.post("../Jury/SendUserClarification", {marathon: ""+marathon+"",text: ""+text+"",problem: ""+problem+""}, function(data)
        {           
            Fill(problem,marathon);
            $('#message').val('');
            if(data == 'logOut')
                        window.location = './logout';
        });
    }
}



