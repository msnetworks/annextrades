<?php session_start();?>
<?php if(@$_SESSION['std_registration_no']!=''){
	include("../admin_login/connect.php");
?>       
        <?php 
            include"header.php"; 
            $query=mysqli_query($conn, "SELECT * FROM courses WHERE id='".$_GET['b_id']."'");
                $row_adv=mysqli_fetch_array($query);
        ?>
        
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"><?php echo $row_adv['course_name']; ?></h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $row_adv['course_name']; ?></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Select Topic</h5>
                        <div class="card-body">
                        <div class="row"> 
                            <?php 
                                $query1=mysqli_query($conn, "SELECT * FROM text_chapters ORDER by  id ASC");
                                WHILE($row_adv1=mysqli_fetch_array($query1)){
                            ?> 
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <div class="rectangle">
                                    <a href="textviewer.php?c_id=<?php echo $row_adv1['id'];?>">
                                    <h6 class="card-header" height="16%"><?php echo $row_adv1['chapter'];?></h6>
                                    <img src="../admin_login/img/courses/chapter/<?php echo $row_adv1['image'];?>" width="100%" height="84%"/>
                                    </a>
                               </div>               
                            </div>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
          <?php include"footer.php"; ?>
          <?php
            } 
        else{ 
					header('location: auth/');
            } 
        ?> 