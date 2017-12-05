<?php

if(isset($_SESSION['logado'])){
    session_destroy();
}

?>
<script>
    window.location = "http://localhost:8000/index.php";
</script>