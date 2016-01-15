$(document).ready(function(){

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
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;
                    
                    

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if ((~~(file.size/1024))>50) 
                    {
                        toastr.warning('Error','Image size must be less than 100KB');
                        return;
                    }

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() 
            {

                $.post("../team/SetLogo", {logo: ""+$image.cropper("getDataURL")+""}, function(data)
                {
                    if(data == 'true')
                    {
                        toastr.success('Congratulations','Team logo Update');
                    }
                    else
                    {
                        toastr.warning('Error','Try Again');
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

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });
});
