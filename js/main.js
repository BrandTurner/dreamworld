$(document).ready(function() {
	// Sign Up
    $("#signup").submit(function(event) {
        var $form = $(this),
            $inputs = $form.find("input")
            serializeData = $form.serialize();

        $('#check_submit').val(1);
        $inputs.attr("disabled", "disabled");
        $.ajax({
            url: '../signup.php',
            type: 'post', 
            data: serializeData,
            dataType: 'json',
            success: function(response) {
                
                // fill in fields
                $('#userID').val(response.id);
                $('#firstname').val(response.firstname);
                $('#lastname').val(response.lastname);
                $('#username').val(response.username);
                $('#password').val(response.password);
                $('#email').val(response.email);
                $('#address').val(response.address);
                $('#city').val(response.city);
                $('#state').val(response.state);
                $('#zip').val(response.zip);

                $('.home').fadeOut("slow");
                $('#profile').fadeIn("slow");
                // populate data fields

                return;
            },

            error: function(xhr, ajaxOptions, thrownError) {
                alert("Error");
                return;
            },

            complete: function(){
                // enable the inputs
                $inputs.removeAttr("disabled");
            }

        });
        return false;
    });

    // Login
    $('#login_btn').click(function(event) {
        $("input[id=login_submit]").val(1);
        var $form = $('#login_form'),
            $inputs = $form.find("input")
            serializeData = $form.serialize();

            $inputs.attr("disabled", "disabled");

            $.ajax({
            url: '../signup.php',
            type: 'post', 
            data: serializeData,
            dataType: 'json',
            success: function(response) {
                if (response.sql) {
                    alert("Wrong username/Password");
                } else {
                    $('.home').fadeOut("slow");
                    $('#profile').fadeIn("slow");

                    $('#userID').val(response.id);
                    $('#firstname').val(response.firstname);
                    $('#lastname').val(response.lastname);
                    $('#username').val(response.username);
                    $('#password').val(response.password);
                    $('#email').val(response.email);
                    $('#address').val(response.address);
                    $('#city').val(response.city);
                    $('#state').val(response.state);
                    $('#zip').val(response.zip);
                }
            }, 

            error: function(xhr, ajaxOptions, thrownError) {
                alert("Error");
                return;
            },

            complete: function(){
                // enable the inputs
                $inputs.removeAttr("disabled");
            }
        });
    });
    // Edit
    $('#updateProfile').click(function(event) {
        // Initialize Data Fields
        $("input[id=updateType]").val(0);
        $("input[id=check_submit]").val(0);
        var $form = $('#update'),
            $inputs = $form.find("input")
            serializeData = $form.serialize();

        $inputs.attr("disabled", "disabled");

        $.ajax({
            url: '../signup.php',
            type: 'post', 
            data: serializeData,
            dataType: 'json',
            success: function(response) {
                alert('Profile Updated');
                $('#profile').fadeOut("slow");
                $('#profile').fadeIn("slow");
            }, 

            error: function(xhr, ajaxOptions, thrownError) {
                alert("Error");
                return;
            },

            complete: function(){
                // enable the inputs
                $inputs.removeAttr("disabled");
            }
        });
    });         

    // Delete

    $('#deleteProfile').click(function(event) {
        $("input[id=updateType]").val(1);
        $("input[id=check_submit]").val(0);
        var $form = $('#update'),
            $inputs = $form.find("input")
            serializeData = $form.serialize();

        $inputs.attr("disabled", "disabled");

        $.ajax({
            url: '../signup.php',
            type: 'post', 
            data: serializeData,
            dataType: 'json',
            success: function(response) {
                $('#profile').fadeOut("slow");
                $('.home').fadeIn("slow");
                alert('Record Deleted!');
            }, 

            error: function(xhr, ajaxOptions, thrownError) {
                alert("Error");
                return;
            },

            complete: function(){
                // enable the inputs
                $inputs.removeAttr("disabled");
            }
        });
    });         
});