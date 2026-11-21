 <?php
//$token = getSession('token_login');
?> 
<?php
    // Header
        $this->renderView('parts/header');
    ?>

    <?php
    // Sidebar
        $this->renderView('parts/sidebar');
    ?>

    <?php 
    echo isset($content) ? $content : '';
    ?>

    <?php
    // Footer
        $this->renderView('parts/footer');
    ?>

