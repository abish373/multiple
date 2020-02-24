<?php include('nav.php') ?>

<?php 

if(isset($_POST['submit'])){
    if(isset($_FILES['userfile'])){
        $userfile = $_FILES['userfile'];
        //echo "<pre>"; print_r($_FILES['userfile']); die;
    }
    // if(isset($_COOKIE['mycook'])){
    //     $cookie= $_COOKIE['mycook'];
    //     $cookielist = explode(",",$cookie);
    //     //echo "<pre>"; print_r($cookie); die;   
    // }
    if (isset($_POST['delete'])) {
        $value = $_POST['delete'];
        $cookielist = explode(",",$value[0]);
        // echo "<pre>";print_r($cookielist);die;
    }
    $namelist = $userfile['name'];
    $db = array_diff($namelist, $cookielist);

    $dbdata = serialize($db);
    

    // echo "<pre>"; print_r($db); die;

    $conn =mysqli_connect('localhost','root','','mu');

    $sql = "INSERT INTO images SET img='$dbdata'";
        if(mysqli_query($conn,$sql)){
            // echo "new record create sucessfully";
        }else {
            echo "Error: "; /*. $sql . "<br>" . mysqli_error($conn);*/
        }

    // foreach ($db as $dd) {
    //     $sql = "INSERT INTO images SET img='$dd'";
    //     if(mysqli_query($conn,$sql)){
    //         // echo "new record create sucessfully";
    //     }else {
    //         echo "Error: "; /*. $sql . "<br>" . mysqli_error($conn);*/
    //     }
    // }

      $countfiles = count($_FILES['userfile']['name']);

     for($i=0;$i<$countfiles;$i++){

       $filename = $_FILES['userfile']['name'][$i];
       
       // Upload file
       move_uploaded_file($_FILES['userfile']['tmp_name'][$i],'img/'.$filename);
        
     }
    // echo "<pre>"; print_r($dbdata); die;
}

?>



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
<?php 
    if (isset($_POST['edits'])) {
        echo "this is edits";
    }
?>
<?php 
    if (isset($_POST['deletes'])) {
        echo "<pre>";print_r($_POST['deletes']); die;
    }
?>

<body>
    <form action="" id="upload_Form" method="POST" enctype="multipart/form-data" action="test.php"> 

        <input type="file" name="userfile[]" id="files_input" multiple>

        
        <input type="submit" name="submit" value="Upload">
        <input type="hidden" id="hid" name="delete[]">
        <!-- <a href="test.php">Click here to view images</a> -->

    </form>

    

    <div class="images">

    </div>

    <script>

        let uploadForm=document.getElementById('upload_form')
        let uploadInput=document.getElementById('files_input')
        let hid = document.getElementById('hid');
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
            hid.value= cook;
            uploadedImages.splice(i,1)
            
            
            
        }  
        
        

    </script>


</body>

</html>