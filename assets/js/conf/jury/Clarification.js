$(document).ready(function() 
{
	$('#send').on('click', function() 
    {	
        if ($.trim($("#message").val())) 
        {
            SendJury($('#idroom').val(),$('#idmarathon').val(),$('#message').val(),$('#problem').val());  
        } 
    });
});


function Fill(team,marathon) 
{
	$("#chat").empty();
	
    $.post("../Jury/FillClarification", {team: ""+team+"",marathon: ""+marathon+""}, function(data)
    {
        if(data.length > 0) 
        {
            $("#chat").append(data);
        }

        if(data == 'logOut')
                window.location = './logout';
    });
}

function SendJury(team,marathon,text,problem) 
{
    $.post("../Jury/SendClarification", {team: ""+team+"",marathon: ""+marathon+"",text: ""+text+"",problem: ""+problem+""}, function(data)
    {
          
        Fill(team,marathon);
        $('#message').val('');

        if(data == 'logOut')
                window.location = './logout';
    });
}