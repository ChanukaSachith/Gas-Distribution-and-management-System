<?php
    include_once "dbworks/connection.php";

    $user = "";
    session_start();
    $nic = $_SESSION['user_id'];

    if($nic == ""){
        header("location: /login.php");
    }
    else{
        $query = mysqli_query($con,"SELECT * FROM user_details WHERE nic = '$nic'");
        $row = mysqli_fetch_assoc($query);
        $user = $row['firstName'] . " " . $row['lastName'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="/src/images/favicon.png" type="image/x-icon">

    <title>Notifications</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="/styles/css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="/styles/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="/styles/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles/styles.css">
    <!-- responsive style -->
    <link href="/styles/css/responsive.css" rel="stylesheet" />
    <style>
        a {
            text-decoration: none;
        }
        .btns{
            position: absolute;
            right: 2%;
            top: 40%;
        }
        .btns button{
            margin-right: 10px;
        }
    </style>
</head>

<body class="sub_page">
    <div class="hero_area">
        <div class="hero_bg_box" style="height: 90px;">
            <img src="/src/images/bgimage.jpg" alt="">
        </div>
        <!-- header section strats -->
        <?php include_once "layouts/navbar.php"; ?>
        <!-- end header section -->

  <!-- about section -->

    <section class="about_section layout_padding mt-5" id="allNotification" style= "margin-bottom: 100px;">
        <div class="container">
        <?php

            $query = mysqli_query($con,"SELECT * FROM gas_issue_history ,user_details WHERE user_details.nic = gas_issue_history.byWhom AND toWhom = '$nic' ORDER BY readFlag ASC, date DESC");
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['readFlag'] == 0){
                        echo '
                        <div class="card notific mb-2" style="position: relative; border: 2px solid #112A6D">
                            <div class="card-body">
                                <span class="d-block" style="font-weight: bold;">Gas Tank Issued</span>
                                <span class="d-block">Hey, Your '.$row['size'].'kg '.$row['type'].' Gas Tank issued by '.$row['firstName'].' '.$row['lastName'].' and '.$row['address'].' Gas Station.</span>
                                <span class="d-block" style="font-size: 13px;">Issued Date: '.$row['date'].'</span>
                            </div>
                            <div class="btns">
                                <button class="btn btn-primary btn-sm" title="mark as read" value="'.$row['id'].'" onclick="markAsReadFunc(this.value)"><i class="fa fa-check" aria-hidden="true"></i></button><button class="btn btn-danger btn-sm" title="delete" value="'.$row['id'].'" onclick="deleteNotific(this.value)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>';
                    }
                    else{
                        echo '
                        <div class="card notific mb-2" style="position: relative;">
                            <div class="card-body">
                                <span class="d-block" style="font-weight: bold;">Gas Tank Issued</span>
                                <span class="d-block">Hey, Your '.$row['size'].'kg '.$row['type'].' Gas Tank issued by '.$row['firstName'].' '.$row['lastName'].' and '.$row['address'].' Gas Station.</span>
                                <span class="d-block" style="font-size: 13px;">Issued Date: '.$row['date'].'</span>
                            </div>
                            <div class="btns">
                                <button class="btn btn-primary btn-sm" disabled><i class="fa fa-check" aria-hidden="true"></i></button><button class="btn btn-danger btn-sm" title="delete" value="'.$row['id'].'" onclick="deleteNotific(this.value)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>';
                    }
                }
            }
            else{
               echo '
                <div class="card notific">
                    <div class="card-body">
                        No Notifications Available
                    </div>
                </div>';
            }
        ?>
        </div>
    </section>
    <!-- about section ends -->

    <?php include_once "layouts/footer.html"; ?>
    <!-- footer section -->

    <!-- jQery -->
    <script src="/styles/js/jquery-3.4.1.min.js"></script>
    <script src="/pannels/customer/styles/main.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="/styles/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="/styles/js/custom.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>