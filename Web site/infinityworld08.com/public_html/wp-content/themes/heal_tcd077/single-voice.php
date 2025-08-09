<?php
     // redirect to top page
     $voice_archive_page = get_post_type_archive_link('voice');
     wp_safe_redirect( $voice_archive_page );
     exit;
?>