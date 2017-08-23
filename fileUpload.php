<?php include('sessionCheck.php'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/bb786203ce.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body{
            font-family: 'Roboto', sans-serif;

        }
        #uploaderContainer{
            width: 800px;
            height: auto;
            border: 1px solid;
            text-align:Center;
            
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
            margin:0;
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
            border: 1px solid red;
            display: inline-block;
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
        }
        .btn-info{
            width: 40px;
            padding: 0px;
            border: none;
        }
    </style>
</head>
    
<body>
    <div id = "uploaderContainer">
        <form enctype="multipart/form-data">
            <div id = "title">Select the file you want to upload</div>
            <div class = "form-group">
                <input type = "file" id = "fileInput" name = "fileInput"/>
                <p class="help-block">Click the button and choose your artwork you wish to upload.</p>
            </div>
            <input id = "submitButton" type = "button" value = "Upload Image" name = "submit">
            <div id = "dropBox"></div>
            <div id = "imagePreviewContainer">
                <?php
                    $dir = "/Applications/XAMPP/htdocs/artistoryProject/artistory/images/";
                    $search = glob($dir."*");
                    foreach ($search as $image) {
                        $fileName = basename($image);
                        $imageNew=str_replace("/Applications/XAMPP/htdocs/artistoryProject/artistory","",$image);
                        echo(
                        "<div class='imageContainer'>
                            <div id='filename$fileName'>filename: $fileName</div><div class='editIcon'>
                            <button type='button' class='btn btn-info' data-container='body' data-toggle='modal' data-target='#popUpModal'>
                                <i class='fa fa-pencil-square-o fa-2x' aria-hidden=true></i>
                            </button>
                        </div>
                        <div class='modal fade' id='popUpModal' role='dialog'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                        <h4 class='modal-title'>Edit the name of your file</h4>
                                    </div>
                                    <div class='modal-body'>
                                    <form>
                                        new name: <input type='text' id='changedName'>
                                        <input id = 'nameSubmit' type = 'button' value ='change'>
                                    </form>
                                    </div>
                                    <div class='modal-footer'>
                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img class='image' src='.$imageNew'></div>") ;
                    }
                ?>
  
    
    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            console.log(input.files[0]);
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#imagePreviewContainer").append("<img class=image src="+e.target.result+">");
                // $('.image').css("display","inline-block");
                // $('.image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileInput").change(function(){
        readURL(this);
    });
    //write to database. 
    document.getElementById("submitButton").addEventListener("click",writeToDataBase);
    function writeToDataBase(){
        var filePath = $("#fileInput").val();
        var fileName = $('input[type=file]').val().split('\\').pop();
        console.log("filepath:"+filePath);
        console.log("filename:"+fileName);
        var dataToSend="filePath="+encodeURIComponent(filePath)+"&fileName="+encodeURIComponent(fileName)+"&username="+"user1";
        var xhrWrite= new XMLHttpRequest();
        xhrWrite.onreadystatechange=function(){
            if (this.readyState === 4 && this.status === 200){
                var response=xhrWrite.responseText.trim();
                console.log(response);
            }
        };
        xhrWrite.open("POST", "uploadFile.php?" + dataToSend);
        xhrWrite.send();
    }

    //save to folder.
    document.getElementById("submitButton").addEventListener("click",uploadFile);
    function uploadFile(){
        var input = document.getElementById("fileInput");
        var file = input.files[0];
        if(file != undefined){
            formData= new FormData();
            if(!!file.type.match(/image.*/)){
                formData.append("fileInput", file);
                $.ajax({
                    url: "uploadFile.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        alert('success');
                    }
                });
            }
            else{alert('Not a valid image!');}
        }
        else{alert('Input something!');}
    }

    document.getElementById("nameSubmit").addEventListner("click",changeName);

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
    

    </script>
</body>