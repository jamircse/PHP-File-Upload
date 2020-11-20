
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP File upload </title>
</head>
<style>
    body{width: 960px;margin: 0 auto;padding:5px;}
    .frm_header{min-height: 20px;text-align: center;background:#ddd;
        margin:5px 0px;border: 1px solid #ddd;padding:5px;}
    .frm_main{min-height: 370px;border: 1px solid #ddd;margin:10px 0px;padding:20px;}
    .frm_main form{
        border:1px solid #ddd;
        text-align: center;
        width: 400px;
        margin: 0 auto;
        padding: 20px;
    }
    .frm_footer{min-height: 20px;border: 1px solid #ddd; text-align: center; margin:5px 0px;background:#ddd;}
    
</style>
<body>
   <div class="frm_header">
       <h2 style="text-align:center;">PHP FILE UPLOAD </h2>
   </div>
    <div class="frm_main">
         
    <?php
include "classes/db.php";
include "classes/config.php";

$db=new database();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    
        $permited=array('jpg','jpeg','png','gif');
        $file_name =$_FILES['img']['name'];
        $file_size =$_FILES['img']['size'];
        $desti="images/";

        $div=explode('.',$file_name);
        $file_end=strtolower(end($div));
        $unique_image=substr(md5(time()),0,10).'.'.$file_end;
        $tmp_name=$name=$_FILES['img']['tmp_name'];
        $destination="images/".$unique_image;

        if(empty($file_name)){
            echo "<br/>please Select File ...";
        }
        elseif($file_size >(1024000)){
            echo '<span class="error">Image must be less than 1 MB in size <span>';
        }
        elseif((in_array($file_end,$permited))==false){
            echo '<span class="error">you can upload only '.implode(',',$permited).' photo </span>';
        }elseif(!is_dir($desti)){
             mkdir($desti, 0777, true);
            }
        else{
            move_uploaded_file($tmp_name,$destination);
        }
}

?>
    <form action="#" method="post" enctype="multipart/form-data">
      
       <img src="<?php echo "images/".$unique_image ?>" alt="Please Upload image" title="<?php echo $file_name; ?>" width="200" height="200">
       <br/>
       <br/>
        <input type="file" name="img">
        <input type="submit" value="submit">
    </form>
    </div>
   <div class="frm_footer">
       <h2>Jamir.cse@gmail.com</h2>
   </div>
</body>
</html>