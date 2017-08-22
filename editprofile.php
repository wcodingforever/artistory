<?php include('sessionCheck.php'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>editprofile.html</title>
    <style>
        * {
            font-family: roboto;
            /* border: 1px dotted red; */
        }
        h1 {
            letter-spacing: 20px;
            text-align: center;
        }
        a {
            margin: 0 0 0 100px;
            text-decoration: none;
        }
        a:hover {
            color: rgb(90, 90, 255);
        }
        .right {
            vertical-align: top;
            display: inline-block;
            margin-top: 20px;
            margin-left: 10px;
        }
        .left {
            display: inline-block;
            margin-left: 10px;
        }
        #names {
            margin: 10 0 10 60px;
        }
        #socialmedia {
            margin-top: 10px;
        }
        #form-wrapper {
            border: 1px ridge rgb(140, 50, 90);
            min-width: 300px;
            max-width: 580px;
            width: 100%;
            height: 650px;
        }
        #profile-pic-wrapper {
            margin: 0 0 0px 30px;
        }
        #profile-pic {
            width: 200px;
            height: 200px;
            border-radius: 100px;
            border: 2px ridge rgba(140, 50, 90, 0.9);
        }
        #profile-camera-img {
            position: relative;
            left: -60px;
            width: 50px;
            height: 50px;
            border-radius: 160px;
            border: 5px ridge rgba(140, 50, 90, 0.9);
        }
        #profile-camera-img:hover {
            cursor: pointer;
        }
        #fullname {
            margin-top: 10px;
            font-size: 2em;
        }
        #username {
            margin: 0 0 0 100px;
            font-size: 0.8em
        }
        #phone {
            margin-top: 30px;
        }
        #email, #loca {
            margin-top: 10px;
        }


        h4 {
            text-align: center;
            color:rgba(140, 50, 90, 0.8);
        }
        label {
            display: inline-block;
            text-align: right;
            padding: 10px;
            width: 100px;
            font-family: Roboto;
        }
        input {
            /*border: 1px solid green;*/
            width: 320px;
            height: 28px;
            padding: 3px;
            background-color:rgb(245, 245, 250);
        }
        .pop-textarea {
            width: 320px;
            height: 90px;
            background-color:rgb(245, 245, 250);
        }
        .textarea-label {
            vertical-align: top;
            margin-top: 25px;
        }
        #pop-form-wrapper {
            position: relative;
            left: 150px;
            bottom: 610px;
            width: 500px;
            height: 700px;
            box-shadow: 10px 10px 5px #999;
            border: 10px outset rgb(140, 50, 90);
            background-color: rgb(255, 150, 190);
            display: none;
            /* display: block; */
        }
        #edit-wrapper {
            text-align: right;
        }
        #edit {
            margin: 0 40px 0 0;
            width: 70px;
            height: 30px;
            border-radius: 2px;
            background-color: rgba(140, 50, 90, 0.6);
            font-weight: 600;
            font-family: roboto;
            font-size: 1em;
            color: rgba(0, 0, 0, 0.6)
        }
        #edit:hover {
            cursor: pointer;
            background-color: rgba(140, 50, 90, 0.9);
        }
    </style>
</head>
<body>
    <div id="form-wrapper">
        <!--This is title-->
        <h1>PROFILE</h1>

        <!--This part is the picture of the profile-->
        <div id="profile-pic-wrapper" class="left">
            <img id="profile-pic" alt="profile-pic" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7iaqB5vF-BlE4jO0HgRIcjJdTqnJXbU13GcKIuu8XzE_KmGrkmw">
            <img id="profile-camera-img" alt="profile-camera-img" src="http://icons.iconarchive.com/icons/pelfusion/long-shadow-media/256/Camera-icon.png" >
            <div><a id="editprofile" href="#">Edit profile</a></div>
        </div>

        <!--These are the contents of the profile-->

        
        <div id="names" class="right">
            <div id="fullname">John Smith</div>
            <div id="username">@johnsmith1332</div>
            <div id="phone"><i class="fa fa-phone">123-456-7890</i></div>
            <div id="email"><i class="fa fa-envelope-o"></i>abcd@whatever.com</div>
            <div id="loca"><i class="fa fa-map-marker"></i>New York, USA</div>
        </div>
        <div id="socialmedia" class="left">
            <i class="fa fa-facebook-square">https://www.facebook.com/johnsmith</i><br>
            <i class="fa fa-twitter-square">https://twitter.com/johnsmith</i><br>
            <i class="fa fa-instagram">https://www.instagram.com/johnsmith</i><br>
            <i class="fa fa-pinterest-square">https://www.pinterest.co.kr/johnsmith</i><br>
            <div id="interest"><i class="fa fa-gratipay">I love artworks! blahblah</i></div>
        </div>
    </div>


    <div id="pop-form-wrapper" style="display:none;">
        <!--This is title-->
        <h4>Edit your profile</h4>
        <div><label>Fullname</label>John Smith</div>
        <div><label>Username</label>johnsmith1332</div>

        <!--These are edit inputs-->
        <div><label>Password</label><input type="text" placeholder="enter password"></div>
        <div><label>Phone</label><input type="text" placeholder="123-456-7890"></div>
        <div><label>Email</label><input type="text" placeholder="abcd@whatever.com"></div>
        <div><label>City</label><input type="text" placeholder="New York"></div>
        <div><label>Country</label><input type="text" placeholder="USA"></div>
        <div><label id="pop-socialmedia-label" class="textarea-label">Social Media</label><textarea id="pop-socialmedia" class="pop-textarea" placeholder="facebook, instagram, twitter, pinterest address ... "></textarea></div>
        <div><label id="pop-interest-label" class="textarea-label">Interest</label><textarea id="pop-interest" class="pop-textarea" placeholder="about you"></textarea></div>
        
        <!--This is edit button-->
        <div id="edit-wrapper"><input type="button" id="edit" value="Save"></div>
    </div>
    <script>
        var editprofileElem = document.getElementById("editprofile");
        var popupElem = document.getElementById("pop-form-wrapper");
        var saveElem = document.getElementById("edit");

        editprofileElem.addEventListener("click", function() {
            popupElem.style.display = "block";
        });

        saveElem.addEventListener("click", function() {
            popupElem.style.display = "none";
        });
    </script>
</body>
</html>