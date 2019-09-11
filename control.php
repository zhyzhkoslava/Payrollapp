<?php
session_start();

    $db = new PDO('mysql:host=db;dbname=app;', 'dev', 'password');


    $id = 0;
    $net_price = 0;
    $update = false;
    $name = '';
    $department = '';
    $amount = '';

if (isset($_POST['save'])){

    $coeff = 0.15;
    $name = htmlspecialchars($_POST['name']);
    $department = htmlspecialchars($_POST['department']);
    $amount = htmlspecialchars($_POST['amount']);

    switch ($department) {
        case '1 department (TV)':
            $net_price = 1000;
            break;
        case '2 department (PC)':
            $net_price = 1500;
            break;
        case '3 department (Mobile phones)':
            $net_price = 500;
            break;
    }

    $payroll = $net_price * $coeff * $amount;

    $payroll = 1500 > $payroll ? $payroll : 1500;

    $stmt = $db->prepare("INSERT INTO Payroll (name, department, amount, payroll) VALUES (:name, :department, :amount, :payroll)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':payroll', $payroll);
    $stmt->execute();

    $_SESSION['message'] = "Record have been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $stmt=$db->prepare("DELETE FROM Payroll WHERE id=:id");
    $stmt->bindParam(":id",$id);
    $stmt->execute();

    $_SESSION['message'] = "Record have been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location:index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $stmt=$db->prepare("SELECT * FROM Payroll WHERE id=:id");
    $stmt->bindParam(":id",$id);
    $res = $stmt->execute();
    if ($res){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];
        $department = $row['department'];
        $amount = $row['amount'];
    }
}

if (isset($_POST['update'])) {
    $coeff = 0.15;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $amount = $_POST['amount'];

    switch ($department) {
        case '1 department (TV)':
            $net_price = 1000;
            break;
        case '2 department (PC)':
            $net_price = 1500;
            break;
        case '3 department (Mobile phones)':
            $net_price = 500;
            break;
    }

    $payroll = $net_price * $coeff * $amount;

    $payroll = 1500 > $payroll ? $payroll : 1500;

    $stmt = $db->prepare("UPDATE Payroll set name=:name, department=:department, amount=:amount, payroll=:payroll where id=:id");
    $stmt->bindParam(":id",$id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':payroll', $payroll);
    $stmt->execute();

    $_SESSION['message'] = "Record have been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location:index.php");
}