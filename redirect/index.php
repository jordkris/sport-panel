<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    $url = '';
    echo 'no url provided';
}
// if(isset($_GET)) {
//     $url = $_GET['url'];
//     header('Location :'.$url);
// }
?>
<script>
    let url = '<?= $url; ?>';
    if (url !== '') {
        location.href = url;
    }
</script>