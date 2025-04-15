<?php

function displayMessage($type, $message): void {
    if($type == "success"){
      echo '<div class="alert alert-success">';
      echo $message;
      echo '</div>';
    }else {
      echo '<div class="alert alert-danger">';
      echo $message;
      echo '</div>';
    }
}