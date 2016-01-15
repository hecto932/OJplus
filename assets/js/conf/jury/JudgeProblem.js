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

    $( "#diff" ).click(function() 
    {
  		$(".diff-wrapper2").prettyTextDiff({
	        cleanup: true,
	        originalContent: $('#original').val(),
	        changedContent:  $('#changed').val(),
	        diffContainer: ".diff2"
	    });

	    // Run diff on textarea change
	    $(".diff-textarea").on('change keyup', function() {
	        $(".diff-wrapper2").prettyTextDiff({
	            originalContent: $('#original').val(),
	            changedContent:  $('#changed').val(),
	            diffContainer: ".diff2"
	        });

	    });

	    $('#original').autogrow();
		$('#changed').autogrow();


	});

	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
      var switchery = new Switchery(html, { color: '#1AB394' });

    });


    var changeCheckbox = document.querySelector('.js-check-change')
	  , changeField = document.querySelector('.js-check-change-field');


	changeCheckbox.onchange = function() 
	{
		var marathon = $('#marathon').val();
		var problem  = $('#problem').val();
		var received = $('#id').val();
		var verified = changeCheckbox.checked;

		$.post("../Jury/SetVerified", {marathon: ""+marathon+"",problem: ""+problem+"",received: ""+received+"",verified: ""+verified+""}, function(data)
	    {            
	        if(data == true) 
	        {	
	        	if(verified)
	        	{
	        		toastr.success('Congratulations','Problem Verified');
	        	}
	        	else
    				toastr.warning('Congratulations','Problem Unverified');
	        }
	        else
	        	toastr.warning('Error','Try Again');

	        if(data == 'logOut')
                        window.location = './logout';
	    });


	};



}); 



function GetCaseOutput(problem,casename) 
{	
    $.post("../Jury/GetCaseOutput", {problem: ""+problem+"",casename: ""+casename+""}, function(data)
    {
        if(data.length > 0) 
        {
            $('#original').val(data)
            if(data == 'logOut')
                        window.location = './logout';
        }
    });
}

function GetTeamOutput(marathon,team,problem,casename) 
{
    $.post("../Jury/GetTeamOutput", {marathon: ""+marathon+"",team: ""+team+"",problem: ""+problem+"",casename: ""+casename+""}, function(data)
    {
        if(data.length > 0) 
        {
        	$('#changed').val(data)
        	if(data == 'logOut')
                        window.location = './logout';
        }
    });
}

function GetText(marathon,team,problem,casename,teamcase) 
{
	$('#original').val('');
	$('#changed').val('');
	$('.diff2').empty()

	GetCaseOutput(problem,casename);
	GetTeamOutput(marathon,team,problem,teamcase);
}