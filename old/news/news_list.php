<?php 
    include'config.php';
    //include'controller/connect.php';
    //include'controller/select_query.php';
?>
<?php include'header.php';?>
<div class="" style="background: #F7F7F7;">
    <div class="projects-clean" style="background: rgba(255,255,255,0) !important;">
        <div class="projects-horizontal">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center hdr">Business News </h2>
                    <!--p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p-->
                </div>
                <div class="row projects">
                    
                <?php
                        $run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' ORDER BY views DESC ");
                        $count = mysqli_num_rows($run);
                        if ($count <= 0) {
                            echo '<br><center>There are no published posts</center><br>';
                        } else {
                            while ($row = mysqli_fetch_assoc($run)) {
                                $post_id = $row['id'];
                                $runq3   = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
                                $uNum    = mysqli_num_rows($runq3);
                                ?>
                        
                    <div class="col-sm-6 item zmin">
                        <div class="row">
                            <div class="col-md-12 col-lg-5"><a href="news_details.php?id=<?php echo $row['id']; ?>"><img class="img-fluid" style="height: 100%!important; border-radius: 0px !important;" src="asset/img/news/<?php echo $row['image'];?>"></a></div>
                            <div class="col">
                            <h4 class="name text-left text2-1"><a href="news_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['title'];?></a></h4>
                                <div class="p">
                                    <p class="description text1 text-justify"><?php echo html_entity_decode($row['content']);?></p>
                                </div>
                                <a style="color:#ff7900!important" class="pull-right" href="news_details.php?id=<?php echo $row['id']; ?>"><b>Read More...</b></a>
                            </div>
                        </div>
                    </div>
                <?php 
                        } 
                        }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>        
<?php include'footer.php';?>
