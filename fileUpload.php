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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body{
            font-family: 'Roboto', sans-serif;

        }
        #uploaderContainer{
            width: 600px;
            height: 600px;
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

        .image{
            width:400px;
            height: 400px;
        }
    </style>
</head>
    
<body>
    <div id = "uploaderContainer">
        <form enctype="multipart/form-data" action="fileUpload.php" method="POST">
            <div id = "title">Select the file you want to upload</div>
            <div class = "form-group">
                <input type = "file" id = "fileInput" name = "fileInput"/>
                <p class="help-block">Click the button and choose your artwork you wish to upload.</p>
            </div>
            <input id = "submitButton" type = "submit" value = "Upload Image" name = "submit">
            <div id = "dropBox"></div>
            <div id = "imagePreviewContainer">
                <img src = "#" class = "image">
            </div>
        </form>
    </div>
    
    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            console.log(input.files[0]);
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image').css("display","inline-block");
                $('.image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileInput").change(function(){
        readURL(this);
    });

    document.getElementById("submitButton").addEventListener("click",writeToDataBase);

    function writeToDataBase(){
        $(".image").css("display","none");
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

    </script>
</body>