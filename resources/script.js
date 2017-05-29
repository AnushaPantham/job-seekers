function applyJob(element,job_id, user_id)
{
    if(user_id == "")
    {
        window.location = "login.php";
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "jobs_applied.php",
            data: {job_id: job_id, user_id: user_id},
            success: function(data){
                if(data=="success")
                    $(element).attr('disabled',true);
            }
        });
    }
}

function changeJobAppliedStatus(element, job_id,user_id,status)
{
    $.ajax({
        type:"POST",
        url:"applied_status.php",
        data:{job_id:job_id, user_id:user_id, status: status},
        success: function(data){
           // alert(data);
            if(data =="success")
            {
              $(element).attr('disabled',true);
              $(element).siblings('button').attr('disabled',true);
            }
        }
    })
}

$(document).ready(function(){
    $('#nav a').click(function(){
        $(this).addClass('active');
        $(this).siblings('a').removeClass('active');
    });
});