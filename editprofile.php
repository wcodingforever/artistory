<?php
    include('sessionCheck.php');

    $resultArr = [];
    $errorStr = "";
    $dbConn = new PDO("mysql:hostname=localhost;dbname=artistory","root","");
    $username = "";

    if(count($_REQUEST)>0 && array_key_exists("username", $_REQUEST) && $_REQUEST["username"] !== ""){
        $username = $_REQUEST['username'];
        $dbStatement = $dbConn -> prepare("SELECT `username`, `firstName`, `lastName`, `city`, `country`, `phone`, `email`, `socialMedia`, `interest` FROM `profile` WHERE `username` = :inusername");
        $dbResult = $dbStatement -> execute(array(":inusername" => $username));

        while ($row = $dbStatement -> fetch(PDO::FETCH_ASSOC)){
            // $resultStr .= "{$row['username']}|{$row['firstName']}|{$row['lastName']}|{$row['city']}|{$row['country']}|{$row['phone']}|{$row['email']}|{$row['socialMedia']}|{$row['interest']}".PHP_EOL;
            $resultArr = $row;
        }

        $tmpErrorsArr = $dbStatement->errorInfo();  // Any other errors?
        if ($tmpErrorsArr[0] !== "00000") $errorStr .= implode(" -- ", $tmpErrorsArr); // 00000 is no errors.
    }
    if ($errorStr !== "") echo ($errorStr);
    // else print_r($resultArr);
    
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/bb786203ce.js"></script>
<title>editprofile.html</title>
<style>
    * {
        font-family: roboto;
        /* border: 1px dotted red; */
    }

    /* This is my profile form*/
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
        width:80%;
        margin-top: 10px;
    }
    #interest {
        width: 80%;
    }
    #form-wrapper {
        margin: 0 auto;
        border: 3px ridge rgb(140, 50, 90);
        border-collapse: separate;
        min-width: 300px;
        max-width: 800px;
        width: 100%;
        min-height: 612px;
        max-height: 100%;
        box-shadow: 3px 3px 5px #999;
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
    #interest {
        margin-bottom: 10px;
    }

    /* This is pop-form */
    h4 {
        text-align: center;
        color:rgba(140, 50, 90, 0.8);
    }
    label {
        display: inline-block;
        text-align: right;
        padding: 7px;
        width: 95px;
        font-family: Roboto;
    }
    input[type=text] {
        min-width: 200px;
        max-width: 330px;
        height: 28px;
        padding: 3px;
        background-color:rgb(245, 245, 250);
    }
    .textarea-label {
        vertical-align: top;
        margin-top: 25px;
        
    }
    .pop-textarea {
        color: black;
        margin-top: 2px;
        min-width: 202px;
        max-width: 332px;
        height: 100%;
        min-height: 50px;
        max-height: 90px;
        background-color:rgb(245, 245, 250);
    }
    #pop-form-wrapper {
        position: relative;
        /* left: 10px; */
        bottom: 555px;
        min-width: 250px;
        max-width: 330px;
        height: 510px;
        box-shadow: 10px 10px 5px #999;
        border: 10px outset rgba(140, 50, 100, 0.8);
        background-color: rgb(255, 150, 190);
        display: none;
    }
    #edit-wrapper {
        text-align: right;
    }
    #edit {
        margin: 10px 30px 0 0;
        width: 40px;
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

    /* This is my artistory form */
    #enjoy {
        margin-left: 20px;
        display: block;
        background-color: rgb(70, 20, 255);
        border: none;
        color: white;
        padding: 10px 25px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
    }
    #enjoy:hover {
        letter-spacing: 1px;
        cursor: pointer;
        background-color: rgb(70, 20, 215);
    }
    #seemore {
        margin-left: 20px;
        display: block;
        background-color: white;
        border: 2px outset rgba(140, 50, 100, 0.8);
        color: darkgray;
        padding: 10px 25px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
    }
    #seemore:hover {
        cursor: pointer;
        color: rgba(140, 50, 110, 0.9);
    }

    /* This is for the file uploads */
    #uploaderContainer{
        width: 100%;
        padding: 30px;
        height: auto;
        border: 1px solid;
        text-align: center;
        box-sizing: border-box;
    }
    #title{
        width:300px;
        height:20px;
        padding:5px;
        margin: 5px auto;
        text-align: center;
    }

    #uploaderContainer [type=file] {
        cursor: pointer;
    }
    .form-group{
        border:1px solid #FF7575;
        padding:5px;
        margin:10px auto;
        width:70%;
        border-radius: 4px;
        text-align:left;
    }

    input[type=file]{
        margin: 0 auto;
        font-size: x-small;
        margin: 0;
        vertical-align: top;
    }

    #fileInputLabel{
        border:1px solid #FF7575;
        border-radius: 4px;
        display: inline-block;
        background-color: #FF7575;
        color: white;
        padding: 3px;
        font-weight: 100;
        cursor:pointer;
    }
    .help-block{
        display: inline-block;
        font-size: x-small;
    }
    #submitButton{
        width: 100px;
        margin-top:10px;
        border-radius: 4px;
        cursor: pointer;
        transition: 0.4s;
        border: 1px solid #FF7575;
        background-color: #FF7575;
        color: white;
    }
    #submitButton:hover{
        background-color: white;
        color: #FF7575;
    }
    #imagePreviewContainer{
        margin-top:15px;
    }
    .imageContainer{
        width: 210px;
        height: 240px;
        margin-top:10px;
        margin-right: 10px;
        border: 1px solid grey;
        display: inline-block;
        vertical-align: top;
        position: relative;
    }
    .image{
        width: 200px;
        height: 200px;
        displayLinline-block;
    }
    .filename{
        float:left;
        width:150px;
        margin-top: 10px;
    }
    .editIcon{
        float:right;
        margin-top:10px;
        cursor: pointer;
        position: absolute;
        right: 10px;
        bottom: 40px;
    }
    .btn-info{
        width: 40px;
        padding: 0px;
        border: none;
    }
    .uploadFilename {
        padding: 5px;
        background-color: rgba(0, 0, 0, 0.75);
        color: white;
        font-weight: bold;
        position: absolute;
        width: 100%;
    }

    .uploadFilename, .editIcon { opacity: 0; transition: opacity 0.5s; }
    .imageContainer:hover .uploadFilename, .imageContainer:hover .editIcon {
        opacity: 0.9;
    }

    /* This is for the like/love buttons */
    .btn-secondary {
		background-color: grey;
		color: white;
        padding: 0 10px;
        width: 100%;
	}
	.likeLoveDiv {
        display: inline-block;
        /* border-radius: 6px; */
        /* border: 2px solid black; */
        padding: 2px;
        height: 26px;
        width: 50%;
	}
    .likeNum, .loveNum {
        display: inline-block;
        line-height: 2rem;
        padding: 0 5px;
    }
    .likeLoveDiv .badge {
        color: rgba(0, 0, 0, 0.9);
        background-color: white;
    }
    .likeLoveWrap { margin-top: 5px; }
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
        <div id="fullname">&nbsp;<?php echo($resultArr['firstName']); ?>&nbsp;<?php echo($resultArr['lastName']); ?></div>
        <div id="username">&nbsp;<?php echo("@" . $resultArr['username']); ?></div>
        <div id="phone"><i id="iphone" class="fa fa-phone">&nbsp;<?php echo($resultArr['phone']); ?></i></div>
        <div id="email"><i id="iemail"class="fa fa-envelope-o">&nbsp;<?php echo($resultArr['email']); ?></i></div>
        <div id="loca"><i id="iloca"class="fa fa-map-marker">&nbsp;<?php echo($resultArr['city']); ?>,&nbsp;<?php echo($resultArr['country']); ?></i></div>
    </div>
    <div id="socialmedia" class="left">
        &nbsp;<i class="fa fa-facebook-square"></i><i class="fa fa-twitter-square"></i><i class="fa fa-instagram"></i><i class="fa fa-pinterest-square"></i>
        <div id="isocialmedia">&nbsp;<?php echo($resultArr['socialMedia']); ?></div>
    </div><br><br>
    <div id="interest" class="left">
        &nbsp;<i class="fa fa-gratipay"></i><i class="fa fa-gratipay"></i><i class="fa fa-gratipay"></i><i class="fa fa-gratipay"></i><br>
        <div id="iinterest">&nbsp;<?php echo($resultArr['interest']); ?></div>
    </div>

    <div id="uploaderContainer">
        <form enctype="multipart/form-data">
            <div id="title">Select the file you want to upload</div>
            <div class="form-group">
                <input type="file" id="fileInput" name="fileInput"/>
                <p class="help-block">Click the button and choose your artwork you wish to upload.</p>
            </div>
            <input id="submitButton" type="button" value="Upload Image" name="submit">
            <div id="dropBox"></div>
            <div id="imagePreviewContainer"></div>
        </form>
    </div>
    

<div id="pop-form-wrapper" style="display:none;" method="get">
    <!--This is title-->
    <h4>Edit your profile</h4>
    <div><label>Username</label><?php echo($resultArr['username']); ?></div>
    <div><label>Fullname</label><?php echo($resultArr['firstName']); ?>&nbsp;<?php echo($resultArr['lastName']); ?></div>
    
    <!--These are edit inputs-->
    <div><label>Phone</label><input id="editphone" class="editinputs" type="text" placeholder="123-456-7890" value="<?php echo($resultArr['phone']); ?>"></div>
    <div><label>Email</label><input id="editemail" class="editinputs"  type="text" placeholder="abcd@whatever.com" value="<?php echo($resultArr['email']); ?>"></div>
    <div><label>City, State</label><input id="editcity" class="editinputs"  type="text" placeholder="Los Angeles, CA" value="<?php echo($resultArr['city']); ?>"></div>
    <div><label>Country</label><input id="editcountry" class="editinputs"  type="text" placeholder="USA" value="<?php echo($resultArr['country']); ?>"></div>
    <div><label id="pop-socialmedia-label" class="textarea-label">Social Media</label><textarea id="editsocialmedia" class="pop-textarea" placeholder="facebook, instagram, twitter, pinterest address ..."><?php echo($resultArr['socialMedia']); ?></textarea></div>
    <div><label id="pop-interest-label" class="textarea-label">Interest</label><textarea id="editinterest" class="pop-textarea" placeholder="About you."><?php echo($resultArr['interest']); ?></textarea></div>
    
    <!--This is edit button-->
    <div id="edit-wrapper"><input type="button" id="edit" value="Save"></div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/2.3.1/sha_dev.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    // TODO : update profile informaion please!!
    saveElem.addEventListener("click", updateprofile);
    function updateprofile() {
        var editphone = $("#editphone").val();
        var editemail = $("#editemail").val();
        var editcity = $("#editcity").val();
        var editcountry = $("#editcountry").val();
        var editsocialMedia = $("#editsocialmedia").val();
        var editinterest = $("#editinterest").val();
        var dataToSend=
        "phone="+encodeURIComponent(editphone)+
        "&email="+encodeURIComponent(editemail)+
        "&city="+encodeURIComponent(editcity)+
        "&country="+encodeURIComponent(editcountry)+
        "&socialMedia="+encodeURIComponent(editsocialMedia)+
        "&interest="+encodeURIComponent(editinterest)+
        "&username="+encodeURIComponent("<?php echo($username); ?>");
        console.log("DATA: " + dataToSend);

        if(editphone === "") {
            alert("Fill out your profile!");
            popupElem.style.display = "block";
            window.location.href = "editprofile.php?username=<?php if (isset($_REQUEST['username'])) echo($_REQUEST['username']); ?>";
            return createprofile;
        }
        else {alert("Thank you! You updated your profile!");}
    
        var xhrWrite = new XMLHttpRequest();
        xhrWrite.onreadystatechange = function(){
            if (this.readyState === 4 && this.status === 200){
                var response = xhrWrite.responseText.trim();
                console.log(response);
                var jsonObj = JSON.parse(response);
                if (jsonObj.code === "OK") {
                    //window.location.href = "artistory.php?username=<?php if (isset($_REQUEST['username'])) echo($_REQUEST['username']); ?>#";
                    window.location.reload();
                }
            }
        };
        xhrWrite.open("GET", "update-profile-info.php?" + dataToSend);
        xhrWrite.send();
    };


    // This is for the file uploads

    $("#fileInput").change(function(){ readURL(this); });
    function readURL(input) {
        if (input.files && input.files[0]) {
            console.log(input.files[0]);
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".help-block").html("<div class='preview-label'>Preview:</div><img class=image src="+e.target.result+">");
                // $("#imagePreviewContainer").append("<img class=image src="+e.target.result+">");
                // $('.image').css("display","inline-block");
                // $('.image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    //save to folder.
    document.getElementById("submitButton").addEventListener("click",uploadFile);
    function uploadFile(){
        // var filePath = $("#fileInput").val();
        // var fileName = $('input[type=file]').val().split('\\').pop();
        // console.log("filepath:"+filePath);
        // console.log("filename:"+fileName);
        // if (filePath !== "" || fileName !== "") {
        //     var dataToSend="filePath="+encodeURIComponent(filePath)+"&fileName="+encodeURIComponent(fileName)+"&username="+"user1";
        //     var xhrWrite= new XMLHttpRequest();
        //     xhrWrite.onreadystatechange=function(){
        //         if (this.readyState === 4 && this.status === 200){
        //             var response=xhrWrite.responseText.trim();
        //             console.log(response);
        //         }
        //     };
        //     xhrWrite.open("POST", "uploadFile.php?" + dataToSend);
        //     xhrWrite.send();
        // }
        
        var fileElem = document.getElementById("fileInput");

        if(typeof fileElem !== 'undefined' && fileElem !== null){
            var fileName = fileElem.value.split('\\').pop();
            var file = fileElem.files[0];
            var formData = new FormData();
            if(fileName !== "" && file.type.match(/image.*/)){
                formData.append("fileInput", file);
                $.ajax({
                    url: "uploadFile.php?"
                        + "filePath=" + encodeURIComponent(fileElem.value)
                        + "&fileName=" + encodeURIComponent(fileName)
                        + "&username=" + "<?php if (isset($_REQUEST['username'])) echo($_REQUEST['username']); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        //alert('success');
                        $(".help-block").html("Click the button and choose your artwork you wish to upload.");
                        fileElem.value = "";
                        getUploads();
                    }
                });
            }
            else{alert('Not a valid image!');}
        }
        else{alert('Input something!');}
    }

    var nameSubmitButton = document.getElementById("nameSubmit");
    if(typeof nameSubmitButton !== 'undefined' && nameSubmitButton !== null) nameSubmitButton.addEventListner("click",changeName);

    function changeName(){
        var newName = $("#changedName").val();
        //overwrite the previous name in html
        
        var dataToSend="changedName="+encodeURIComponent(newName)+"&username="+"user1";
        var xhrWrite= new XMLHttpRequest();
        xhrWrite.onreadystatechange=function(){
            if (this.readyState === 4 && this.status === 200){
                var response=xhrWrite.responseText.trim();
                console.log(response);
            }
        };
        xhrWrite.open("POST", "editNameFile.php?" + dataToSend);
        xhrWrite.send();
    }


    function getUploads() {
        $.ajax({
            url: "getUploads.php",
            type: "GET",
            success: function(data){
                //alert('success');
                var inObj = JSON.parse(data);
                var htmlStr = "";
                for (var i = 0; i < inObj.length; i++) {
                    // htmlStr += "<img class='image' src='images/" + inObj[i].filename + "'>";
                    htmlStr += "<div class='imageContainer'>";
                    htmlStr += "<div id='filename" + inObj[i].filename + "' class='uploadFilename'>" + inObj[i].filename + "</div>";
                    htmlStr += "<div class='editIcon'><button type='button' class='btn btn-info' data-container='body' data-toggle='modal' data-target='#popUpModal'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'></i></button></div>";
                    htmlStr += "    <div class='modal fade' id='popUpModal' role='dialog'>";
                    htmlStr += "       <div class='modal-dialog'>";
                    htmlStr += "           <div class='modal-content'>";
                    htmlStr += "               <div class='modal-header'>";
                    htmlStr += "                  <button type='button' class='close' data-dismiss='modal'>&times;</button>";
                    htmlStr += "                   <h4 class='modal-title'>Edit the name of your file</h4>";
                    htmlStr += "               </div>";
                    htmlStr += "                <div class='modal-body'>";
                    htmlStr += "                <form>";
                    htmlStr += "                    new name: <input type='text' id='changedName'>";
                    htmlStr += "                    <input id = 'nameSubmit' type = 'button' value ='change'>";
                    htmlStr += "                </form>";
                    htmlStr += "                </div>";
                    htmlStr += "                <div class='modal-footer'>";
                    htmlStr += "                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
                    htmlStr += "                </div>";
                    htmlStr += "            </div>";
                    htmlStr += "        </div>";
                    htmlStr += "    </div>";
                    htmlStr += "    <img class='image' src='images/" + inObj[i].filename + "'>";
                    htmlStr += "    <div class='likeLoveWrap'>";
                    htmlStr += "<div class='likeLoveDiv likeDiv'><button type='button' id='like-" + inObj[i].id + "' class='btn btn-secondary likeButton'><span id='likesLabel-" + inObj[i].id + "' class='likeNum badge'>" + inObj[i].likes + "</span> Likes</button></div>";
		            htmlStr += "<div class='likeLoveDiv loveDiv'><button type='button' id='love-" + inObj[i].id + "' class='btn btn-secondary loveButton'><span id='lovesLabel-" + inObj[i].id + "' class='loveNum badge'>" + inObj[i].loves + "</span> Love</button></div>";
                    htmlStr += "    </div>";
                    htmlStr += "</div>"
                }
                $("#imagePreviewContainer").html(htmlStr);

                $('.likeButton').click(function(){
                    var thisElemID = this.id;
                    var thisDBID = this.id.substring(this.id.indexOf("-") + 1);
                    //console.log("ID: " + thisElemID + " DBID: " + thisDBID);
                    $.ajax({ type: "GET", url: "likes.php?id=" + thisDBID + "&action=addLike" })
                        .done(function(msg) {
                            var inObj = JSON.parse(msg);
                            $("#likesLabel-" + thisDBID).html(inObj.likes);
                    });
                });
                $('.loveButton').click(function(){
                    var thisElemID = this.id;
                    var thisDBID = this.id.substring(this.id.indexOf("-") + 1);
                    //console.log("ID: " + thisElemID + " DBID: " + thisDBID);
                    $.ajax({ type: "GET", url: "likes.php?id=" + thisDBID + "&action=addLove" })
                        .done(function(msg) {
                            var inObj = JSON.parse(msg);
                            $("#lovesLabel-" + thisDBID).html(inObj.loves);
                    });
                });
            }
        });
    }
    getUploads();

</script>
</body>
</html>