$(document).ready(function() 
{
    $('.dataTables-example').dataTable(
    	{
        	"language": {
            	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+$('#Lang').val()+".json"
        	},
        	responsive: true
    });
});