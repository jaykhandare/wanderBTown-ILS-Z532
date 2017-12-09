$(document).ready(function(){
    $("#register_user").submit(function(event) {
        event.preventDefault();
        var $form = $( this ),
            $submit = $form.find('button[type="submit"]'),
            firstName_value = $form.find('input[name="firstName"]').val(),
            lastName_value = $form.find('input[name="lastName"]').val(),
            userName_value = $form.find('input[name="userName"]').val(),
            email_value = $form.find('input[name="email"]').val(),
            password_value = $form.find('input[name="password"]').val(),
            url = "http://c245505f.ngrok.io/wanderBTown-ILS-Z532/user/create.php"; /*$form.attr('action');*/

        $.ajax({
            type: "POST",
            url: url,
            data: {
                firstName: firstName_value,
                lastName: lastName_value,
                userName: userName_value,
                email: email_value,
                password:password_value
            },
            success: function(msg){
                $.session.set("userName", userName_value);
                window.location.replace("homePage.html")
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        });
        /*var posting = $.post(url, {
            firstName: firstName_value,
            lastName: lastName_value,
            userName: userName_value,
            email: email_value,
            password: password_value
        },fail(function () {
            console.log("error!!")
        }));

        posting.done(function (data) {
            if (test.includes("User was added")) {
                window.location.href = "homePage.html"
            }

        });*/
    });

    $("#login_check").submit(function (event) {
        event.preventDefault();
        var $form=$( this ),
            $userName = $form.find('input[name="username"]').val(),
            $password = $form.find('input[name="password"]').val();

        $.ajax({
            type: "POST",
            url: "http://c245505f.ngrok.io/user/login.php",
            data: {
                userName: $userName,
                password:$password
            },
            success: function(msg){
                $.session.set("userName", userName_value);
                window.location.replace("homePage.html")
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $.session.set("userName", $userName);
                window.location.replace("homePage.html")
            }
        });


    })
});
/*    $("#register_user").submit(function () {
        var $form = $(this),
            $submit = $form.find('button[type="submit"]'),
            firstName_value = $form.find('input[name="firstName"]').val(),
            lastName_value = $form.find('input[name="lastName"]').val(),
            userName_value = $form.find('input[name="userName"]').val(),
            email_value = $form.find('input[name="email"]').val(),
            password_value = $form.find('input[name="password"]').val(),
            url = "http://b2f07b89.ngrok.io/wanderBTown-ILS-Z532/user/create.php"; /!*$form.attr('action');*!/

        var posting = $.post(url, {
            firstName: firstName_value,
            lastName: lastName_value,
            userName: userName_value,
            email: email_value,
            password: password_value
        });

        posting.done(function (data) {
            var test = data.toString();
            alert(test);
            if (test.includes("User was added")) {
                window.location.href = "homePage.html"
            }
/!*
            $( "#contactResponse" ).html(data);

            $submit.text('Sent, Thank you');

            $submit.attr("disabled", true);
*!/
        });
    }));*/
/*
 function test() {
     /!*$("#register_user").submit(function (event) {
         /!* stop form from submitting normally *!/
         /!*event.preventDefault();*!/
         alert("here")
         /!* get some values from elements on the page: *!/
         var $form = $(this),
             $submit = $form.find('button[type="submit"]'),
             firstName_value = $form.find('input[name="firstName"]').val(),
             lastName_value = $form.find('input[name="lastName"]').val(),
             userName_value = $form.find('input[name="userName"]').val(),
             email_value = $form.find('input[name="email"]').val(),
             password_value = $form.find('input[name="password"]').val(),
             url = $form.attr('action');

         /!* Send the data using post *!/
         var posting = $.post(url, {
             firstName: firstName_value,
             lastName: lastName_value,
             userName: userName_value,
             email: email_value,
             password: password_value
         });

         posting.done(function (data) {
             var test = data.toString();
             alert(test)
             if (test.includes("User was added")) {
                 window.location.href = "homePage.html"
             }
             /!*
                     /!* Put the results in a div *!/
                     $( "#contactResponse" ).html(data);

                     /!* Change the button text. *!/
                     $submit.text('Sent, Thank you');

                     /!* Disable the button. *!/
                     $submit.attr("disabled", true);
             *!/
         });
     });*!/

     var firstname =  document.getElementById("firstNameRegister").value;
     var lastName =  document.getElementById("lastNameRegister").value;
     var userName =  document.getElementById("userNameRegister").value;
     var email = document.getElementById("emailsignup").value;
     var psswd =  document.getElementById("passwordsignup").value;
     document.getElementById("register_user").action = "http://b2f07b89.ngrok.io/wanderBTown-ILS-Z532/user/create.php";
     document.getElementById("register_user").submit()
 }
*/
