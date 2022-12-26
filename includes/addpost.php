<?php
require('db.php');
if(isset($_POST['addpost'])){
    $ptitle = mysqli_real_escape_string($db,$_POST['post_title']);
    $pcontent = mysqli_real_escape_string($db,$_POST['post_content']);
    
    $cid = $_POST['post_category'];
    $pcreatedby = $_POST['post_name'];
    $pcreatedate = $_POST['post_date'];
    $query =  "INSERT INTO posts (title,content,created_by,category) VALUES('$ptitle','$pcontent','$pcreatedby','$cid')";
    $run = mysqli_query($db,$query);
    $post_id=mysqli_insert_id($db);
    $image_name=$_FILES['post_image']['name'];
$img_tmp=$_FILES['post_image']['tmp_name'];
foreach($image_name as $index=>$img){
    if(move_uploaded_file($img_tmp[$index],"../img/$img")){
        $query="INSERT INTO images (post_id,image) VALUES($post_id,'$img')";
$run=mysqli_query($db,$query); 
    }
}
}
header('location:../NiceAdmin/index.php');

?>