<?php session_start();
if(@$_SESSION['super_adm']!=''){
    
?>
    <?php include"header.php"; ?>
        <?php
            $vv = mysqli_query($conn, "SELECT * FROM registration WHERE view = '1'");
            WHILE($roq = mysqli_fetch_array($vv)){
            $conn->query("UPDATE registration SET view = '0' WHERE view='1'");
            }
            //---Queries------------
            $quy=mysqli_query($conn, "SELECT usertype FROM registration WHERE usertype = 'Seller'");
            $cntSeller = mysqli_num_rows($qry);
            $quy1=mysqli_query($conn, "SELECT usertype FROM registration WHERE usertype = 'Buyer'");
            $cntBuyer = mysqli_num_rows($qry1);
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
                            <h2 class="pageheader-title">Landing Post</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List of Post</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>Landing Post</h5></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                                        <h4><a class="btn btn-success" href="post_buyer.php"><i class="fa fa-plus"></i> Add New</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if ($_SESSION['msg'] == 'success') { ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Edit Success!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>
                                <?php if ($_SESSION['msg'] == 'failed') { ?>
                                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Failed to edit.</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php } ?>
                                <?php if ($_SESSION['msg'] == 'delete') { ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Delete Success!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="myTbl"  border="1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Company Name</th>
                                                <th>User Type</th>
                                                <th>Description</th>
                                                <th>Video</th>
                                                <th>Status</th>
                                                <th>Edit/Delete</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            $query1=mysqli_query($conn, "SELECT * FROM landing_post order by id desc");
                                            WHILE($row_adv1=mysqli_fetch_array($query1)){
                                            ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $row_adv1['name'];?></td>
                                                <td><?php echo $row_adv1['companyname'];?></td>
                                                <td><?php echo $row_adv1['user_type'];?></td>
                                                <td><?php echo $row_adv1['description'];?></td>
                                                <td><iframe style="width: 150px;" src="https://www.youtube.com/embed/<?php echo $row_adv1['video'];?>" frameborder="0"></iframe></td>
                                                <td><?php if($row_adv1['status'] == "0"){ 
                                                    ?>
                                                    <font color="#28a745" >Active</font><?php }else {
                                                    ?>
                                                        <font color="#dc3545" >Not Active</font>
                                                    <?php } ?>
                                                </td>
                                                <td><a href="edit_buyerpost.php?id=<?php echo $row_adv1['id'];?>"><i class="fa fa-edit"></i></a> &nbsp; &nbsp; <a href="controller/delete_landing_post.php?id=<?php echo $row_adv1['id'];?>"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                </div>
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