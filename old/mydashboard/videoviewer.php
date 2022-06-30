<?php session_start();?>
<?php if(@$_SESSION['std_registration_no']!=''){
	include("../admin_login/connect.php");
	$class= $_GET['class'];
	$board= $_GET['board'];
	$subject=$_GET['subject'];
?>       
        <?php 
            include"header.php"; 
            $query=mysqli_query($conn, "SELECT * FROM courses WHERE id='".$_GET['b_id']."'");
                $row_adv=mysqli_fetch_array($query);
        ?>
        <style>
            .yt-cover{
              position: absolute;
              top: 0;
              bottom:0;
              right:0;
              left:0;
              z-index:1000;
            }
        </style>
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
                            <p class="pageheader-text"></p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Video Courses</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $row_adv['course_name']; ?></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Play Class</h5>
                        <div class="card-body">
                        <div class="row"> 
                            <?php 
                                $query1=mysqli_query($conn, "SELECT * FROM text_chapters WHERE class='$class' and board='$board' and subject_name='$subject'");
                                WHILE($row_adv1=mysqli_fetch_array($query1)){
                            ?> 
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <h6 class="card-header" height="16%"><?php echo $row_adv1['chapter'];?></h6>
                                <div class="yt-cover" style="width: 100%; height: 250px; position: relative;">

                                    <iframe id="videoElementID" oncontextmenu="return false;" src="https://www.youtube.com/embed/<?php echo $row_adv1['video_id'];?>?rel=1&amp;controls=1&modestbranding=0&loop=1"   width="100%" height="250px" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        
                                    <div style="width: 100%; height: 50%; position: absolute; opacity: 0; right: 0px; top: 0px;">&nbsp;</div>
                                
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
        <script type="text/javascript">
            document.onmousedown = disableRightclick;
            var message = "Right click not allowed !!";
            function disableRightclick(evt){
                if(evt.button == 2){
                    alert(message);
                    return false;    
                }
            }
        </script>
          <?php
            } 
        else{ 
					header('location: auth/');
            } 
        ?> 