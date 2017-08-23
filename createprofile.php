<?php
    if (!isset($_REQUEST['session']) || !isset($_REQUEST['username'])) {
        header("Location: artistory.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>createprofile.html</title>
    <style>
        * {
            /* border: 1px solid red; */
        }
        h4 {
            text-align: center;
            color: rgba(140, 50, 90, 0.8);
        }
        label {
            display:inline-block;
            text-align: right;
            padding: 7px;
            width: 100px;
            font-family: Roboto;
        }
        input {
            margin-left: 5px;
            min-width: 200px;
            max-width: 330px;
            height: 28px;
            padding: 3px;
            background-color: rgb(245, 245, 250);
        }
        textarea {
            margin-left: 5px;
            margin-top: 2px;
            min-width: 204px;
            max-width: 332px;
            height: 100%;
            min-height: 50px;
            max-height: 90px;
            background-color: rgb(245, 245, 250);
        }
        .textarea-label {
            vertical-align: top;
            margin-top: 15px;
        }
        #form-wrapper {
            min-width: 280px;
            max-width: 400px;
            width: 100%;
            height: 530px;
            background-color: white;
            box-shadow: 10px 10px 5px #999;
            border: 10px outset rgb(140, 50, 90);
        }
        #socialmedia {
            margin-top: 3px;
        }
        #submit-wrapper {
            text-align: right;
        }
        #submit {
            margin: 15px 70px 0 0;
            width: 50px;
            height: 30px;
            border-radius: 2px;
            background-color: rgba(140, 50, 90, 0.6);
            font-weight: 600;
            font-family: roboto;
            font-size: 1em;
            color: rgba(0, 0, 0, 0.6)
        }
        #submit:hover {
            cursor: pointer;
            background-color: rgba(140, 50, 90, 0.9);
        }
    </style>
</head>
<body>
    <div id="form-wrapper">
        <!--This is title-->
        <h4>Fill out the profile, please</h4>
        <!--these are inputs-->
        <div>
            <label>Username*</label>
            <input type="text" id="username" name="username" value="<?php echo($_REQUEST['username']); ?>">
        </div>
        <div>
            <label>Firstname*</label>
            <input type="text" id="firstName" name="firstName" value="" placeholder="John">
        </div>
        <div>
            <label>Lastname*</label>
            <input type="text" id="lastName" name="lastName" value="" placeholder="Smith">
        </div>
        <div>
            <label>Phone*</label>
            <input type="text" id="phone" name="phone" value="" placeholder="123-456-7890">
        </div>
        <div>
            <label>Email*</label>
            <input type="text" id="email" name="email" value="" placeholder="abcd@whatever.com">
        </div>
        <div>
            <label>City, State*</label>
            <input type="text" id="city" name="city" value="" placeholder="New York">
        </div>
        <div>
            <label>Country*</label>
            <input type="text" id="country" name="country" value="" placeholder="USA">
        </div>
        <div>
            <label id="socialmedia-label" class="textarea-label" name="socialMedia" value="">Social Media*</label>
            <textarea id="socialMedia" name="socialMedia" value="" class="textarea" placeholder="facebook, instagram, twitter, pinterest address ... "></textarea>
        </div>
        <div><label id="interest-label" class="textarea-label" name="interest" value="">Interest*</label>
            <textarea id="interest" class="textarea" placeholder="about you"></textarea>
        </div>
        <!--This is submit button-->
        <div id="submit-wrapper">
            <input type="submit" id="submit" name="submit" value="Submit">
        </div>
    </div>
    <!-- firstName lastName citystate country phone email socialMedia interest -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/2.3.1/sha_dev.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        document.getElementById("submit").addEventListener("click", createprofile);
        function createprofile() {
            var username = $("#username").val();
            var firstName = $("#firstName").val();
            var lastName = $("#lastName").val();
            var phone = $("#phone").val();
            var email = $("#email").val();
            var city = $("#city").val();
            var country = $("#country").val();
            var socialMedia = $("#socialMedia").val();
            var interest = $("#interest").val();

            // TODO : Send profile informaion please!!

            var dataToSend=
            "username="+encodeURIComponent(username)+
            "&firstName="+encodeURIComponent(firstName)+
            "&lastName="+encodeURIComponent(lastName)+
            "&phone="+encodeURIComponent(phone)+
            "&email="+encodeURIComponent(email)+
            "&city="+encodeURIComponent(city)+
            "&country="+encodeURIComponent(country)+
            "&socialMedia="+encodeURIComponent(socialMedia)+
            "&interest="+encodeURIComponent(interest);

            // console.log("DATA: " + dataToSend);

            var xhrWrite = new XMLHttpRequest();
            xhrWrite.onreadystatechange = function(){
                if (this.readyState === 4 && this.status === 200){
                    var response = xhrWrite.responseText.trim();
                    //console.log(response);
                    var jsonObj = JSON.parse(response);
                    if (jsonObj.code === "OK") {
                        window.location.href = "artistory.php" + location.search;
                    }
                }
            };
            xhrWrite.open("GET", "insert-into-profile-info.php?" + dataToSend);
            xhrWrite.send();

            alert("Thank you! You sent the form!");
        };
    </script>
</body>
</html>