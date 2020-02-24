<?php include('nav.php') ?>
<?php 
	if (isset($_COOKIE['edit'])) {
		$id = intval($_COOKIE['edit']);

	}
	if(isset($_POST['submit'])){
		if (isset($_FILES['userfile'])) {
			$file = $_FILES['userfile'];
			$name = $file['name'];
			//echo $name; die;

		$conn =mysqli_connect('localhost','root','','mu');

		$sql = "UPDATE images set img='$name' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record";
        }
		}
	}
 ?>

<?php 
    $conn =mysqli_connect('localhost','root','','mu');

    $query = 'SELECT * FROM images';
    $result = mysqli_query($conn,$query);

    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_free_result($result);
    
    // echo "<pre>"; print_r($users); die;

    $users = unserialize($users[0]['img']);

    foreach ($users as $us) {
    	if ($id == $us['id']) {
    		$img_src = $us['img'];
    		
    	}
    }
?>
<style type="text/css">
	img {
		width: 100px;
		height: 100px;
		border: 1px solid red;

		padding: 10px;
		margin: 10px;
	}
</style>

<form method="POST" id="upload_form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="exampleFormControlFile1">Example file input</label>
		<input type="file" class="form-control-file" name="userfile" id="files_input">
		<input type="submit" name="submit" value="submit">
	</div>
</form>

 <div class="img">
 	<img src="img/<?php echo $img_src; ?>" id="old_img">
 </div>


 <script>

        let uploadForm=document.getElementById('upload_form')
        let uploadInput=document.getElementById('files_input')
        let hid = document.getElementById('hid');
        let old_img = document.getElementById('old_img')
        let img_div = document.querySelector('.img')
        

        uploadInput.addEventListener('input',displayImages)

        function displayImages(e){

            let files=e.target.files
            console.log(files)
            img_div.innerHTML = ""
            let new_img = document.createElement('img')
            new_img.src = URL.createObjectURL(event.target.files[0])
            new_img.id = 'new-img'
            img_div.appendChild(new_img)
      		img_div.id = 'img_div'
        }

        
       

    </script>