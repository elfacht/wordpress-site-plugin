<?php

/* =Removes IP address in comments
------------------------------------------------------*/
add_filter('pre_comment_user_ip', 'no_ips');
function no_ips($comment_author_ip){
  return '';
}

?>