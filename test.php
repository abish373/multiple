<?php include('nav.php') ?>
<?php 
    $conn =mysqli_connect('localhost','root','','mu');

    $query = 'SELECT * FROM images';
    $result = mysqli_query($conn,$query);

    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);

    // $users = unserialize($user);

    mysqli_free_result($result);
    
    // echo "<pre>"; print_r($users); die;
    $users = unserialize($users[0]['img']);
    // $users = unserialize($users[0]['id']);


    // echo "<pre>"; print_r($users); die;
?>

<?php 
    if (isset($_COOKIE['del'])) {
        $cookie = intval($_COOKIE['del']);
        
        $conn =mysqli_connect('localhost','root','','mu');


         $sql = "DELETE FROM images WHERE id='$cookie'";

        if(mysqli_query($conn,$sql)){
            //echo "record deleted sucessfully";
        }else{
            echo "error happend";
        }
    }
?>
<div class="oldimages" style="margin:10px;">
        
        <?php foreach ($users as $us) { ?>
            <form style="display: flex;  margin:20px;" id="<?php echo $us; ?>" method="POST" action="test.php"><?php if(isset($us)): ?>
                <img src="img/<?php echo $us; ?>" style="width:100px; height: 100px;">
                <div style="display: flex;flex-direction: column;">
                    <input type="submit" value="delete" onclick="deleteimage(this.id)" id="<?php echo $us['id']; ?>" name="deletes" style="margin: 10px;background-color: red; color: white; border:none; padding: 10px;"></input>
                    <a href="some.php" type="submit" id="<?php echo $us['id']; ?>" value="edits" name="edits" onclick="editimage(this.id)" style="margin: 10px; background-color: blue; color: white; border:none; padding: 10px;">Edit</a>
                </div>
                <?php endif?>
            </form>

            
        <?php } ?>
    </div>

    <script>
                function deleteimage(id){ 
                    console.log(id)
                    
                    let del = id;
                    
                    document.cookie= `del=${del}; expires=Fri, 31 Dec 9999 23:59:59 GMT`

                    // let element = document.getElementById(del).parentNode;

                    // console.log(element)


                }

                function editimage(id){ 
                    console.log(id)
                    
                    let del = id;
                    
                    document.cookie= `edit=${del}; expires=Fri, 31 Dec 9999 23:59:59 GMT`


                }
                

            </script>
            <script >
                // setTimeout(function(){
                //   reload()}, 300);

                // function reload() {
                //     reload()
                // }

                window.onload = function() {
                    //considering there aren't any hashes in the urls already
                    if(!window.location.hash) {
                        //setting window location
                        window.location = window.location + '#loaded';
                        //using reload() method to reload web page
                        window.location.reload();
                    }
                }
                
            </script>