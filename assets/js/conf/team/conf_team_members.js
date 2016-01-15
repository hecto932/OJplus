$(document).ready(function()
{
    $('#project-list').slimScroll({
        height: '150px',
        wheelStep: 2
    });
});

function lookup(inputString) 
{
    if(inputString.length > 1) 
    {
        $.post("../team/autocomplete", {queryString: ""+inputString+""}, function(data)
        {
            if(data.length > 0) 
            {
                $('#project-list').show();
                $('#show_contacts').html(data);
            }

            if(data == 'logOut')
                        window.location = './logout';
        }); 
    } 
    else 
    {
        $('#project-list').hide();  
    }
}

function add_member(team,user) 
{
    if(team != null && user != null) 
    {
        $.post("../team/team_members_check", {team: ""+team+"",user: ""+user+""}, function(data)
        {
            if(data == 'logOut')
                window.location = './logout';

            $('#project-list').hide();
             $("#search").val('');

             if(data == "TRUE") 
            {
                toastr.success('Congratulations','User has been requested!')
            }
            else
            {
          	    if(data == "REQUESTED") 
                {
                    toastr.warning('Error','This user has already been requested!')
                }
                else
                {
            	   toastr.warning('Error','Try again!')
                }
            }

        });
       
    } 
    else 
    {
        $('#project-list').hide();  
    }
}