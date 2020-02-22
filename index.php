<?php 

if(isset($_POST['submit'])){
    if(isset($_FILES['userfile'])){
        $userfile = $_FILES['userfile'];
        //echo "<pre>"; print_r($_FILES['userfile']); die;
    }
    if(isset($_COOKIE['mycook'])){
        $cookie= $_COOKIE['mycook'];
        $cookielist = explode(",",$cookie);
        // echo "<pre>"; print_r($cookielist); die;   
    }
    $namelist = $userfile['name'];
    $db = [];
    echo"<pre>"; print_r($namelist);die;
    foreach($namelist as $name){
        foreach($cookielist as $cook){
            if($name == $cook){
                // array_splice($namelist,$name,1);
            }else{
                // echo $name;
                array_push($db,$name);
            }
        }
    }
    //$dbdata = array_unique($db);

    echo "<pre>"; print_r(array_unique($db)); die;

    // $conn =mysqli_connect('localhost','root','','mu');

    // foreach ($dbdata as $dd) {
    //     $sql = "INSERT INTO images SET img='$dd'";
    //     if(mysqli_query($conn,$sql)){
    //         echo "new record create sucessfully";
    //     }else {
    //         echo "Error: "; /*. $sql . "<br>" . mysqli_error($conn);*/
    //     }
    // }



    // echo "<pre>"; print_r($dbdata); die;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
.imgspan >img {
    width:100px;
    height:100px;
    border:1px solid red;
    padding:10px;
    margin:10px;
}

span {
    vertical-align:top;
    color:red;
    font-size:30px;
    cursor:pointer;

}
.images{
    /* display:flex; */

}

</style>
</head>

<body>
    <form action="" id="upload_Form" method="POST" enctype="multipart/form-data"> 

        <input type="file" name="userfile[]" id="files_input" multiple>

        <button type="submit" name="submit" value="submit">Upload</button>

    </form>

    <div class="images">

    </div>

    <script>

        let uploadForm=document.getElementById('upload_form')
        let uploadInput=document.getElementById('files_input')
        let cook = []
        // let coo = cook;
        let mycook = JSON.stringify(cook)

        let uploadedImages=[]  //to store images

        // uploadForm.addEventListener('submit',)

        uploadInput.addEventListener('input',displayImages)

        function displayImages(e){

            let files=e.target.files
            console.log(files)
            let noOfFiles=files.length;
            let imagesDiv=document.querySelector('.images')
            imagesDiv.innerHTML=""
            uploadedImages=[]

            for (let i=0;i<noOfFiles;i++){
                document.cookie = ""
                uploadedImages.push(files[i])

                let div=document.createElement('div')
                div.id= event.target.files[i].name
                div.classList = "imgspan"
                let img=document.createElement('img')

                let deleteBtn=document.createElement('span')
                deleteBtn.innerText='X'

                img.classList.add('uploadimg')
                img.id= event.target.files[i].name
                img.src=URL.createObjectURL(event.target.files[i]);

                div.appendChild(img)
                div.appendChild(deleteBtn)

                imagesDiv.appendChild(div)

                deleteBtn.addEventListener('click',(e)=>{
                    deleteImage(e,div,imagesDiv,i)
                })

            }
        }

        function deleteImage(e,imageDiv,imagesDiv,i){
         imagesDiv.removeChild(imageDiv)
            cook.push(imageDiv.id)
            document.cookie= `mycook=${cook}; expires=Fri, 31 Dec 9999 23:59:59 GMT`
            uploadedImages.splice(i,1)
            
            
            
        }  
        
        // uploadForm.addEventListener('submit',(e)=>{
        //     e.preventDefault()

        //     fetch('url',{
        //         method:"POST",
        //         headers:{
                    
        //         },
        //         body:JSON.stringify({
        //             files:uploadedImages
        //         })
        //     })
        // })

    </script>


</body>

</html>