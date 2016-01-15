$(document).ready(function()
{    

    Dropzone.options.myAwesomeDropzone = 
    {

        autoProcessQueue: true,
        parallelUploads: 1,
        maxFiles: 1,
        maxFilesize: 5,
        addRemoveLinks: true,

        // Dropzone settings
        init: function() 
        {
            myDropzone = this;

            myDropzone.on("success", function(file) 
            { 
                if($('#Lang').val() == "English")
                  toastr.success('Congratulations','File has been successfully uploaded');
                else
                  toastr.success('Felicidades','Archivo cargado exitosamente');

                myDropzone.removeFile(file);
            });

            myDropzone.on("error", function(file) 
            { 
                if($('#Lang').val() == "English")
                    toastr.warning('Error','Tray Again');
                else
                    toastr.warning('Error','Intente nuevamente');
            });

        }
    }

});

function leaderboard(id) 
{
    if(id != null)
    {
        $.post("../team/LeaderboardFill", {id: ""+id+""}, function(data)
        {           
            var dataSet= jQuery.parseJSON(data)
            var oTable ='';

            if ( ! $.fn.DataTable.isDataTable( '.dataTables-leaderboard' ) ) 
            {
                $('#thead').html(dataSet['html']);
                $('#tbody').html(dataSet['tbody']);

                oTable = $('.dataTables-leaderboard').dataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+$('#Lang').val()+".json"
                    }
                }); 
            }
            else
            {

                $(".dataTables-leaderboard").dataTable().fnDestroy();

                $('#tbody').empty();
                $('#thead').empty();

                $('#thead').html(dataSet['html']);
                $('#tbody').html(dataSet['tbody']);
                oTable = $('.dataTables-leaderboard').dataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+$('#Lang').val()+".json"
                    },
                    destroy: true
                }); 
            }
            if(data == 'logOut')
                        window.location = './logout';
   
        });    
    }
}
       