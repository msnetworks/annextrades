<?php 
    include "config.php";
    //include'controller/select_query.php';
?>
<?php include'header.php';?>
    <div class="" style="background: #F7F7F7;">
        <div class="container">
            <div class="projects-clean" style="background: rgba(255,255,255,0) !important;">
                <div class="container">
                    <div class="intro">
                        <h2 class="text-center hdr">Featured Guest </h2>
                        <!--p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p-->
                    </div>
                    <div class="row projects">
                    <?php
                        $run   = mysqli_query($connect, "SELECT * FROM `feature_post` WHERE active='Yes' ORDER BY views DESC ");
                        $count = mysqli_num_rows($run);
                        if ($count <= 0) {
                            echo '<br><center>There are no published posts</center><br>';
                        } else {
                            while ($row = mysqli_fetch_assoc($run)) {
                                $post_id = $row['id'];
                                $runq3   = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
                                $uNum    = mysqli_num_rows($runq3);
                                ?>
                            <div class="col-sm-4 col-lg-4 item">
                                <a href="feature_details.php?id=<?php echo $row['id']; ?>"><img class="img-fluid shdw" style="height:303px;border-radius: 0%;" src="asset/img/feature/<?php echo $row['image'];?>" style="height:170px" width="100%" /></a>
                                <h4 class="name text-left"><a href="feature_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['title'];?></a></h4>
                                <div style="height: 100px; font-size: 15px !important; font-weight: 100 !important; text-align: left!important;">
                                    <p class="text-left" style="" >
                                        <?php 
                                            $fcnt = htmlspecialchars_decode($row['content']);
                                            echo substr($fcnt, 0, 100)."...";
                                        ?>
                                    </p>
                                </div> 
                                <!-- <div class="p">
                                    <p class="description text2 text-justify">< ?php echo html_entity_decode($row['content']);?></p>
                                </div> -->
                                <a style="color:#ff7900!important" class="pull-left" href="feature_details.php?id=<?php echo $row['id']; ?>"><b>Read More...</b></a>
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
