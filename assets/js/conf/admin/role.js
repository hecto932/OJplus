$(document).ready(function()
{
  $('.dataTables-example').dataTable({
      "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+$('#Lang').val()+".json"
          },
      responsive: true,
      lengthMenu: [ 3, 5, 10, 20],
      pagingType: "full"

  });

});



function set(id,role) 
{
    if(id != null && role != null) 
    {
        $.post("../admin/Role", {id: ""+id+"",role: ""+role.value+""}, function(data)
        {
          if(data) 
          {
            if($('#Lang').val() == "English")
              toastr.success('Congratulations','User '+id+' Role has been Updated!');
            else
              toastr.success('Felicidades','Usuario '+id+' - Rol Actualizado');

          }
          else
          {
            if($('#Lang').val() == "English")
              toastr.warning('Error','Try again!');  
            else
              toastr.warning('Error','Intente nuevamente');       
          }

          if(data == 'logOut')
                window.location = './logout';

        });
    } 
}

