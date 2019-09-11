<?php session_start() ?><html>
<head>
    <title>
        Payroll
    </title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="validator.js"></script>

    <script type="text/javascript">
        window.onload = function() {
            var $rows = $('#table tr');
            $('#search').keyup(function() {
                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

                $rows.show().filter(function() {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                    return !~text.indexOf(val);
                }).hide();
            });
        }
    </script>
</head>
<body>
<h1 style="text-align: center;">Payroll APP</h1>
    <?php require_once "control.php"?>

    <?php
    if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <div class="container">
    <?php
        $db = new PDO('mysql:host=db;dbname=app;', 'dev', 'password');
        $stmt=$db->query("SELECT * FROM Payroll");
    ?>


    <div class="row justify-content-center">
        <input type="text" id="search" placeholder="Type to search">
        <table class="table table-striped" id="table">
            <tr>
                <td>Name</td>
                <td>Department</td>
                <td>Amount</td>
                <td>Payroll</td>
                <td>Action</td>
                <td>Action</td>
            </tr>
            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['department'];?></td>
                    <td><?php echo $row['amount'];?></td>
                    <td><?php echo $row['payroll'];?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id'];?>"
                           class="btn btn-info">Edit</a>
                    </td>
                    <td>
                        <a href="index.php?delete=<?php echo $row['id'];?>"
                           class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>


<div class="row justify-content-center">
    <form action="control.php" method="post" onsubmit="return validateForm()>
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="form-group">
            <label for="name">Worker name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Enter worker name" required>
            <div class="error" id="nameErr"></div>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <select class="form-control" name="department">
                <option>1 department (TV)</option>
                <option>2 department (PC)</option>
                <option>3 department (Mobile phones)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount of produced products</label>
            <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $amount; ?>" placeholder="Enter produced products" required>
            <div class="error" id="amountErr"></div>
        </div>
        <div class="form-group">
        <?php
            if($update == true):
        ?>
            <button name="update" type="submit" class="btn btn-info">Update</button>
        <?php else: ?>
            <button name="save" type="submit" class="btn btn-primary">Save</button>
        <?php endif; ?>
        </div>
    </form>
</div>


</div>
</body>
</html>
