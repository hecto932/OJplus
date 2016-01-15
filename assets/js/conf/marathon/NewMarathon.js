$(document).ready(function()
{
            var English = $('#Lang').val() == "English";
	        $("#wizard").steps(); 
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!

                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }
                    
                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {

                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    var repositoryTable = $('.dataTables-repository').dataTable();
                    $('#form').append($("input:checked", repositoryTable.fnGetNodes()));

                    var teamsTable = $('.dataTables-teams').dataTable();
                    $('#form').append($("input:checked", teamsTable.fnGetNodes()));

                    var juryTable = $('.dataTables-jury').dataTable();
                    $('#form').append($("input:checked", juryTable.fnGetNodes()));

                    // Submit form input
                    form.submit();

                }, 
                labels: 
                {
                    cancel: (English) ? "Cancel" : "Cancelar",
                    current:(English) ? "current step:" : "Paso Actual:",
                    pagination: (English) ? "Pagination" : "Paginacion",
                    finish: (English) ? "Finish" : "Finalizar",
                    next: (English) ? "Next" : "Siguiente",
                    previous: (English) ? "Previous" : "Anterior",
                    loading: (English) ? "Loading..." : "Cargando..."
                }          
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            //element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });


		    $('#scroll').slimScroll({
		        height: '350px',
		        wheelStep: 2
		    });
            $('#scroll2').slimScroll({
                height: '350px',
                wheelStep: 2
            });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            elems.forEach(function(html) {
              var switchery = new Switchery(html, { color: '#1AB394' });
            });


            $('#startTime').datetimepicker({ format: 'YYYY-M-D HH:mm'});


            $('.dataTables-repository').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+$('#Lang').val()+".json"
                },
                responsive: true,
                lengthMenu: [ 3, 5, 10, 20],
                pagingType: "full"

            });

            $('.dataTables-teams').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+$('#Lang').val()+".json"
                },
                responsive: true,
                lengthMenu: [ 3, 5, 10, 20],
                pagingType: "full"

            });

            $('.dataTables-jury').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+$('#Lang').val()+".json"
                },
                responsive: true,
                lengthMenu: [ 3, 5, 10, 20],
                pagingType: "full"

            });


});