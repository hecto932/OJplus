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
            var myDropzone = this;

            myDropzone.on("success", function(file) 
            { 
                toastr.success('Congratulations','File has been successfully uploaded')
                //myDropzone.removeFile(file);
            });

            myDropzone.on("error", function(file) 
            { 
                toastr.warning('Error','Tray Again');
                //myDropzone.removeFile(file);
            });

        }

    }

});
            
            
            
