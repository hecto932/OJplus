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
                toastr.success('Congratulations','File has been successfully uploaded')
                myDropzone.removeFile(file);
            });

            myDropzone.on("error", function(file) 
            { 
                toastr.warning('Error','Tray Again');
            });

        }
    }

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
       