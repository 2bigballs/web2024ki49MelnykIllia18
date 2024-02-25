<?php require 'unauthRedirect.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">

    function getUserData(id){
        let userId = "";
        $.ajax({
                url: "mainPage.service.php",
                method: "GET",
                data: {id: id, action: "getUserById"},
                cache: false,
                success: function(data){
                    const parsedData = JSON.parse(data)
                    $("#user-id").html(parsedData.Id)
                    $("#user-login").html(parsedData.Email)
                    $("#user-name").html(parsedData.UserName)
                    $("#user-password").html(parsedData.Password)
                    $("#user-full-name").html(parsedData.FullName)
                    $("#user-position").html(parsedData.Position)
                    $("#user-description").html(parsedData.Description)
                    
                    $("#email-input").val(parsedData.Email)
                    $("#user-name-input").val(parsedData.UserName)
                    $("#user-password-input").val(parsedData.Password)
                    $("#user-full-name-input").val(parsedData.FullName)
                    $("#user-position-input").val(parsedData.Position)
                    $("#user-description-input").val(parsedData.Description)
                },
                error: function(data){
                   
                }
            })
    }

    $(document).ready(function(){
        let id;
        getUserData();
        $("#errors").hide();
         
        $("#search-user-btn").click(function(e){
            e.preventDefault();
            id = $("#search-input-user").val() ?? id;
            getUserData(id);
        })
        
        $("#update-user-btn").click(function(e){
            e.preventDefault();
            $("#errors").empty();
            const email = $("#email-input").val();
            const user_name = $("#user-name-input").val();
            const password = $("#user-password-input").val();
            const full_name = $("#user-full-name-input").val();
            const position = $("#user-position-input").val();
            const description = $("#user-description-input").val();
            
            if(!email || !user_name || !password){
                
                 $("#errors").append(`<div class="error-box"><p>Fields for update user data cannot be empty!</p></div>`)
                 $("#errors").show()
                return;
            }
              
            $.ajax({
                url: "mainPage.service.php",
                method: "POST",
                data: {
                    id: id, 
                    email: email, 
                    user_name: user_name, 
                    password: password, 
                    position: position,
                    full_name: full_name,
                    description: description,
                    action: "updateUserById"
                },
                cache: false,
                success: function(data){
                    getUserData(id);
                },
                error: function(data){
                    console.log(data.responseText)
                }
            })
        })
        
        $("#logout-btn").click(function(e){
            e.preventDefault();
            
            $.ajax({
                url: "mainPage.service.php",
                method: "POST",
                data: {action: "logout"},
                cache: false,
                success: function(data){
                     window.location.href = "/login.html"
                }
            })
        })
    })
    
    
    
    
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-page">
        <h2>Main Page</h2>
        <button type="button" class="btn btn-primary" id="logout-btn">Log Out</button>
        <div class="main-page-block">
            <div class="main-page-info-block">
                <input id="search-input-user">
                <button type='button' class="btn btn-primary" id="search-user-btn">Search User</button>
                <div>
                    <p></p><b>ID:</b> <span id="user-id"></span></p>
                    <p></p><b>Login:</b> <span id="user-login"></span></p>
                    <p></p><b>UserName:</b> <span id="user-name"></span></p>
                    <p></p><b>Full Name:</b> <span id="user-full-name"></span></p>
                    <p></p><b>Position:</b> <span id="user-position"></span></p>
                    <p></p><b>Description:</b> <span id="user-description"></span></p>
                    <p></p><b>Password:</b> <span id="user-password"></span></p>
                </div>
            </div>
            <hr>
            <div class="main-page-input-block">
                <div class="edit-block">
                    <label>Email:</label>
                    <input type="emamil" id="email-input" placeholder="Email:">
                </div>
                <div class="edit-block">
                    <label>UserName:</label>
                    <input type="text" id="user-name-input" placeholder="UserName:">
                </div>
                <div class="edit-block">
                    <label>Full Name(optional):</label>
                    <input type="text" id="user-full-name-input" placeholder="Full Name:">
                </div>
                <div class="edit-block">
                    <label>Position(optional):</label>
                    <input type="text" id="user-position-input" placeholder="Position:">
                </div>
                <div class="edit-block">
                    <label>Description(optional):</label>
                    <textarea id="user-description-input" placeholder="Description:"></textarea>
                </div>
                <div class="edit-block">
                    <label>Password:</label>
                    <input type="text" id="user-password-input" placeholder="Password:">
                </div>
                <div id="errors">
                
                 </div>
                <div class="update-btn">
                    <button type="button" class="btn btn-primary" id="update-user-btn">Update User</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

