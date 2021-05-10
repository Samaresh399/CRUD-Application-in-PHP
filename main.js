$(document).ready(function()
{

    $("tbody").load("Database/table.php");

    $("#myInputForm").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url:"Database/data.php",
            type:"POST",
            data: formData,
            processData:false,
            contentType:false,
            success:function(res){
                if(res=="true")
                {
                    $("tbody").load("Database/table.php");

                }
                document.getElementById("profile_image").value="";
                document.getElementById("fname").value="";
                document.getElementById("lname").value="";
                document.getElementById("email").value="";
                document.getElementById("DOB").value="";
                var radio = document.querySelector('input[type=radio][name=rdo_gender]:checked');
                radio.checked=false;
            },
        });
    });
});