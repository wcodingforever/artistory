<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
        .loginContainer{
            border: 1px solid;
            width: 250px;
            padding: 10px;
            font-family: 'Roboto', sans-serif;
        }
        .form-control {
            border: none;
            border-bottom: 1px solid #FF5252;
            outline: none;
            padding:10px;
        }
        .form-control:focus{
            border-bottom: 1px solid #FF5252;
        }

        #confirmPWwrapper{
            display:none;
        }
        .btn{
            width: 145px;
            margin-top:10px;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.4s;
        }

        #submitButton{
            border: 1px solid #FF7575;
            background-color: #FF7575;
            color: white;
        }

        #createAccount{
            width: 145px;
            margin-top:10px;
            font-size: xx-small;
            cursor:pointer;
        }
        #createAccount:hover{
            color: #FF7575;
        }
        #createButton{
            display:none;
            border: 1px solid #FF7575;
            background-color: white;
            color: black;
        }
        #createButton:hover{
            background-color: #FF7575;
            color: white;
        }
        .form-group{
            margin-bottom: 10px;
        }
        .usernameLabel{
            display:block;
            font-size: small;
        }
    </style>
</head>
<body>
    <div class="loginContainer">
        <h3>Log in here </h3>
        <div id="loginBox">
            <div class="form-group">
                <label class="usernameLabel" for="username">username </label>
                <input class="form-control" id="username" placeholder="Enter username" name="username">
            </div>
            <div class="form-group">
                <label class="usernameLabel" for="password">password </label>
                <input class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <div class="form-group" id="confirmPWwrapper">
                <label class="usernameLabel" for="confirmPW">confirm password </label>
                <input class="form-control" id="confirmPW" placeholder="Enter password" name="confirmPW">
            </div>
            <div id="createAccount"><u>Create an account</u></div>
            <button id="createButton" type="submit" class="btn btn-default">Create Account</button>
            <button id="submitButton" type="submit" class="btn btn-default">Login</button>
        </div>
    </div> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/2.3.1/sha_dev.js"></script>
    <script>
        //creating an account, writing the hashed pw and username to the loginSessionTable
        
        // document.getElementById("createAccount").addEventListener("click",function(){
        //     $("#confirmPWwrapper").css("display","block");
        //     $("#submitButton").replaceWith($("#createButton"));
        //     $("#createButton").css("display","block");
        //     document.getElementById("createButton").addEventListener("click",createLogin);
        // });

        <?php
            if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'create') {
        ?>

        document.getElementById("createAccount").addEventListener("click",function(){
            $("#confirmPWwrapper").css("display","block");
            $("#submitButton").replaceWith($("#createButton"));
            $("#createButton").css("display","block");
            $("#createAccount").css("display", "none");
            document.getElementById("createButton").addEventListener("click",createLogin);
        <?php
            }
        ?>
        function createLogin(){
            var username=$("#username").val();
            var passwordVal=$("#password").val();
            var passwordConfirm=$("#confirmPW").val();
            
            if (passwordVal === passwordConfirm){
                //hashing the password
                var hashObj=new jsSHA("SHA-256",'TEXT');
                hashObj.update(passwordVal);
                var password = hashObj.getHash("HEX");
                var dataToSend="username="+encodeURIComponent(username)+"&password="+encodeURIComponent(password);
                // AJAX request
                var xhrWrite= new XMLHttpRequest();
                xhrWrite.onreadystatechange=function(){
                    if (this.readyState === 4 && this.status === 200){
                        var response=xhrWrite.responseText.trim();
                        var jsonObj = JSON.parse(response);
                        // console.log("RESPONSE: " + jsonObj.code);
                        if (jsonObj.code === "OK") {
                            confirmLogin("createprofile.php");
                        }
                    }
                };
                xhrWrite.open("POST", "loginWriteToTable.php?" + dataToSend);
                xhrWrite.send();
            }
            else{
                alert("please confirm your password again");
            }
        }

        document.getElementById("submitButton").addEventListener("click", confirmLoginHandler);
        function confirmLoginHandler(e) { confirmLogin(); }
        function confirmLogin(from){
            if (typeof from === 'undefined') from = "<?php if (isset($_REQUEST['from'])) echo($_REQUEST['from']); ?>";
            var username=$("#username").val();
            var passwordVal=$("#password").val();
            var hashObj=new jsSHA("SHA-256",'TEXT');
            hashObj.update(passwordVal);
            var password = hashObj.getHash("HEX");
            var dataToSend="username="+encodeURIComponent(username)+"&password="+encodeURIComponent(password);
            var xhrWrite= new XMLHttpRequest();
            xhrWrite.onreadystatechange=function(){
                if (this.readyState === 4 && this.status === 200){
                    var response=xhrWrite.responseText.trim();
                    var jsonObj = JSON.parse(response);
                    if (jsonObj.code === "OK") {
                        goBackToCaller(from, jsonObj.session, username);
                    }
                }
            };
            xhrWrite.open("POST", "loginConfirm.php?" + dataToSend);
            xhrWrite.send();
        }

        function goBackToCaller(from, session, username) {
            window.location.href = from + "?session=" + session + "&username=" + username;
        }
    </script>
</body>