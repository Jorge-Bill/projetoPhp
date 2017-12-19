<?php

if(isset($_SESSION['logado'])){
    session_destroy();
}

?>
<script>
    window.location = "index.php";
</script>