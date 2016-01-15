$(document).ready(function()
{       
            $('.pic').attr('src',$('#picture').attr('src'));
            var English = $('#Lang').val() == "English";
            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1/1,
                preview: ".img-preview",
                done: function(data) 
                {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) 
            {
                $inputImage.change(function() 
                {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if ((~~(file.size/1024))>100) 
                    {
                        toastr.warning('Error',(English) ? 'Image size must be less than 100KB' : 'Imagen debe pesar menos de 100KB');
                        return;
                    }

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage((English) ? 'Please choose an image file.' : 'Selecciona una imagen.');
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() 
            {
                toastr.success((English) ? 'Uploading...' : 'Cargando...');

                $.post("../user/SetProfile", {picture: ""+$image.cropper("getDataURL")+""}, function(data)
                {
                    if(data == 'true')
                    {
                        toastr.success((English) ? 'Congratulations' : 'Felicidades',(English) ? 'Profile picture Update' : 'Imagen de perfil actualizada');
                    }
                    else
                    {
                        toastr.warning('Error',(English) ? 'Try Again' : 'Intentalo nuevamente');
                    }

                    if(data == 'logOut')
                                window.location = './logout';
                }); 


            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });


            $("#ChangePassword").validate({
             rules: {
                 password: {
                     required: true,
                     minlength: 8
                 },
                 Rpassword: {
                     required: true,
                     minlength: 8,
                     equalTo: "#password"
                 }
             }
            });


});

