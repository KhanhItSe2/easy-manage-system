<?php
session_start();
include("db.php");
include("php-script.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        <?php
        include 'style.css';
        ?>
    </style>
</head>

<body>
    <div class="user-detail">
        <h2>Insert User Data</h2>
        <p id="msg"></p>
        <div class="form" id="data-form" >
            <button class="glyphicon glyphicon-remove" id="remove-button"></button>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-group">
                    <label>Academic ID:</label>
                    <input type="text" class="form-control" placeholder="Enter academic ID" name="acaId" required>
                </div>
                <div class="form-group">
                    <label>Academic Level:</label>
                    <input type="text" class="form-control" placeholder="Enter academic level" name="acaLevel" required>
                </div>
                <button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-floppy-saved" > Save</span></button>
                <?php
                if (isset($error)) {
                    echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $error
                      </div>";
                }
                ?>
            </form>
        </div>
    </div>
    </div>
</body>
<!--<script>
    $(document).on('submit', '#data-form', function(e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "php-script.php",
            data: $(this).serialize(),
            success: function(data) {
                $('#msg').html(data);
                $('#data-form').find('input').val('')
            }
        });
    });
</script>-->

</html>