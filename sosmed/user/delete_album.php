<?php
include'../database/db.php';
if(isset($_GET['albumId'])){
    $delete= $_GET['albumId'];
    delete_data($db, $delete);
}
function delete_data($db, $delete){
    $query="DELETE from album WHERE albumId=$delete";
    $result = mysqli_query($db, $query);
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($db).
                             " - ".mysqli_error($db));
      } else {
          header('Location:album.php');
      }
}
