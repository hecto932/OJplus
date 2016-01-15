$(document).ready(function()
{
    $("#input").hide();
    $("#inputname").hide();
    $("#type").hide();
    $("#typename").hide();

    $('#type').on('change', function() 
    {
        $('#typeid').val(this.value);
        if(this.value =='0')
        {
            $("#input").hide();
            $("#inputname").hide();
        }
        else
        {
            $("#input").show();
            $("#inputname").show();

            $.post("../user/FillInputCase", {'id' : $("#problem").val() }, function(data)
            {   
                if(data.length > 0) 
                {
                    $("#input").empty();
                    $("#input").append(data);
                }

                if(data == 'logOut')
                    window.location = './logout';
            });

        }
        
    });

    $('#problem').on('change', function() 
    {
        $('#problemid').val(this.value);

        if(this.value =="")
        {
            $("#input").hide();
            $("#inputname").hide();
            $("#type").hide();
            $("#typename").hide();
        }
        else
        {
            $("#type").show();
            $("#typename").show();
            $.post("../user/FillInputCase", {'id' : $("#problem").val() }, function(data)
            {   
                if(data.length > 0) 
                {
                    $("#input").empty();
                    $("#input").append(data);
                }
                if(data == 'logOut')
                    window.location = './logout';
            });
        }
        
    });

    $('#input').on('change', function() 
    {
        $('#inputid').val(this.value);
    });
        

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
                
                if($('#Lang').val() == "English")
                  toastr.success('Congratulations','File has been successfully uploaded');
                else
                  toastr.success('Felicidades','Caso cargado exitosamente');
              
                myDropzone.removeFile(file);
                $.post("../user/FillInputCase", {'id' : $("#problem").val() }, function(data)
                {   
                    if(data.length > 0) 
                    {
                        $("#input").empty();
                        $("#input").append(data);
                    }
                    if(data == 'logOut')
                        window.location = './logout';
                });
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
    
    

    var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }


});