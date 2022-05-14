<!DOCTYPE html>
<html>

<head>
    <?php $this->view('shared/header', $header)?>

    <style>
    .background-image {
        background-image: url("/w3images/photographer.jpg");
        background-color: #cccccc;
        height: 500px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
    </style>
</head>

<?php $this->view($content_wrapper, $contents)?>

</html>