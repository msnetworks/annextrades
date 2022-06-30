<?php 
    include'core.php';
    include'config.php';
    //include'controller/select_query.php';
    $id = (int) $_GET['id'];

    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=blog.php">';
    }

    $runq = mysqli_query($connect, "SELECT * FROM `posts` WHERE id='$id'");
    if (mysqli_num_rows($runq) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=blog.php">';
    }

    mysqli_query($connect, "UPDATE `posts` SET views = views + 1 WHERE active='Yes' and id='$id'");
    $row         = mysqli_fetch_assoc($runq);
    $post_id     = $row['id'];
    $runq3       = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
    $uNum        = mysqli_num_rows($runq3);
    $category_id = $row['category_id'];
    $runq4       = mysqli_query($connect, "SELECT * FROM `categories` WHERE id='$category_id'");
    $cat         = mysqli_fetch_array($runq4);
?>
    <?php include'header.php';?>
        <div class="" style="background: #F7F7F7 !important;">
            <!-- Page Content -->
            <div class="container">

                <div class="row">

                <!-- Post Content Column -->
                <div class="col-lg-8" style="font-size: 15px !important;">

                    <!-- Title -->
                    
                    <div class="title-divider pd-tp-30">
                        <h1 class="line-sp" style="font-size: 30px; padding-left: 0px!important;"><?php echo $row['title'];?></h1>
                    </div>
                    <!-- Author - ->
                    <p class="lead">
                    by
                    <a href="#">Start Bootstrap</a>
                    </p>

                    <hr>

                    <!- - Date/Time --><br>
                    <p class="lead" style="font-size: 12px;">Posted on <?php echo $row['date']; ?></p>

                    <hr>

                    <!-- Preview Image -->
                    <img class="img-fluid rounded w-100 shdw zmin" style="border-radius: 0px !important;" src="asset/img/news/<?php echo $row['image'];?>" alt="">

                    <hr>

                    <!-- Post Content -->
                    <p class="lead"><?php echo html_entity_decode($row['content']); ?></p>
                    <hr>

                    <!-- Comments Form -->
                    <div class="card my-4">
                        <p class="card-header">
                            <i class="fa fa-calendar"></i> Date: <?php echo $row['date'] ;?>&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-comments-o"></i> Comments: <a href="#comments"><?php echo $uNum; ?></a>
                        </p>
                        <div class="title-divider pd-15" id="comments">
                            <h3><i class="fa fa-comments-o"></i> Comments -<?php echo $uNum ; ?></h3>
                            <div class="divider-arrow"></div>
                        </div>
                        <?php if (@$_GET['action'] == 'Success') {
                            echo '<div class="alert alert-success mr-15">Your comment has been successfully posted</div>';
                        } elseif (@$_GET['action'] == 'Failed') {
                            echo '<div class="alert alert-danger mr-15">Your comment has not been posted</div>';
                        }
                        ?>
                        <div class="wrap-300">
                            <?php
                                $q = mysqli_query($connect, "SELECT * FROM comments WHERE post_id='$row[id]' AND approved='Yes' ORDER BY id DESC");
                                $count = mysqli_num_rows($q);
                                if ($count <= 0) {
                                    echo '<div class="alert alert-info">There are no comments yet</div>';
                                } else {
                                    while ($comment = mysqli_fetch_array($q)) {
                            ?>


                            <div class="media mb-4 mr-15 block-grey">
                                <figure class="thumbnail">
                                    <?php if ($comment['avatar'] == '') {
                                    ?>
                                    <img class="d-flex mr-3 rounded-circle" src="asset/img/other/dummy-man.png" width="50px" height="50px" alt="">
                                    <?php }else { ?>
                                        <img class="d-flex mr-3 rounded-circle" src="asset/img/other/dummy-man.png" width="50px" height="50px" alt="">
                                    <?php } ?>
                                </figure>
                                <div class="media-body ">
                                    <h5 class="mt-0 mr-bt-0"><?php echo $comment['author']; ?></h5>
                                    <time class="comment-date"><i class="fa fa-clock-o"></i><?php echo $comment['date'] . " at " . $comment['time'];?></time><hr>
                                    <?php echo $comment['comment'];?>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>    


                        <div class="title-divider pd-15">
                            <h3>Leave A Comment</h3>
                            <div class="divider-arrow"></div>
                        </div>
                        <div class="card-body">
                            <form action="controllers/news_comments.php?id=<?php echo $id; ?>" method="post">
                            <div class="form-group">

                                <label for="name"><i class="fa fa-user"></i> Your Name:</label>
                                
                                <input type="text" name="author" class="form-control" required/>

                            </div>
                            <label for="dontfill" style="display:none;">Don't fill:</label>
                                <input type="text" name="dontfill" value="" style="display:none;" />
                            <div class="form-group">
                                <label for="name"><i class="fa fa-envelope"></i> Your E-mail:</label>
                                <input type="email" name="email" class="form-control" rows="3" required/>
                            </div>
                            <div class="form-group">
                            <label for="input-message"><i class="fa fa-comment-o"></i> Comment:</label>
                                <textarea class="form-control" name="message" rows="3" required/></textarea>
                            </div>
                            <input type="submit" class="jn-btn w-25 pull-right mr-bt-15" name="submit" value="SUBMIT">
                            </form>
                            
                        </div>
                    </div>
                </div>

                <!-- Sidebar Widgets Column -->
                <div class="col-md-4 pd-0 mr-0" style="background: #fbfbfb;">
                    <!-- Categories Widget -->
                    <section class="">
                        <div class="wrap15"><br>
                            <div class="title-divider mr-bt-30 pd-bt-30">
                                <h1 class="hdr" style="font-family: 'lora'">Categories</h1>
                            </div>
                            <ul class="pd-lft-0">
                                <?php
                                    $cunq = mysqli_query($connect, "SELECT * FROM `categories`");
                                    while ($c = mysqli_fetch_array($cunq)) {
                                        $cunq1 = mysqli_query($connect, "SELECT * FROM `posts` WHERE category_id='$c[id]'");
                                        $cNum = mysqli_num_rows($cunq1);
                                ?>
                                <li class="list-group-item border-0 pd-lft-0" ><span class="badge">(<?php echo $cNum; ?>)</span><a style="color: #787878!important; font-weight: bold;" href="news_category_list.php?category_id=<?php echo $c['id'];?>"><!--i class="fa fa-arrow-right" "=""></i-->&nbsp; <?php echo $c['category'];?></a></li> 
                                 <hr>
                                 <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </section>
                    <!-- Subscribe Newsletter -->
                    
                    <section class="mr-tp-30 bdr-0">
                        <div class="wrap15">
                            <div class="title-divider mr-bt-30 pd-bt-30">
                                <h1 class="hdr" style="font-family: 'lora'">Subscribe to our newsletter</h1>
                                <!--div class="divider-arrow"></div-->
                            </div>
                            <p>Subscribe to Annexis Services's newsletter to receive the latest news and exclusive offers.</p>
                            <form action="" method="POST">
                            <div class="input-group">
                                <input type="email" class="form-control" style="border-radius: 40px 0px 0px 40px !important;" placeholder="Enter your E-Mail Address" name="email" required="">
                                <span class="input-group-append">
                                    <button class="jn-btn" style="border-radius: 0px 40px 40px 0px !important;" type="submit" name="subscribe">Subscribe</button>
                                </span>
                            </div>
                            </form>
                        </div>
                    </section>

                    <!-- Side Widget -->
                    <section class="mr-tp-30 bdr-0" id="tabs">
                        <ul class="nav nav-tabs nav-justified w-100 bdr-0 text-center">
                            <li class="w-50 active mr-0 bdr-0"><a href="#popular" data-toggle="tab"><i class="fa fa-fire"></i> Popular</a></li>
                            <li class="w-50 mr-0 bdr-0"><a font-weight: bold;" href="#recent" data-toggle="tab"><i class="fa fa-clock-o"></i> Recent</a></li>
                            <!--li class="w-33 mr-0"><a href="#comments" data-toggle="tab"><i class="fa fa-comments"></i> Comments</a></li-->
                        </ul>
                        <div class="tab-content bdr-0">
                            <div id="popular" class="tab-pane active pd-lft-0 pd-rt-0">
                            <?php
                                $run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' ORDER BY views DESC LIMIT 4");
                                $count = mysqli_num_rows($run);
                                if ($count <= 0) {
                                    echo '<br><center>There are no published posts</center><br>';
                                } else {
                                    while ($row = mysqli_fetch_assoc($run)) {
                                        $post_id = $row['id'];
                                        $runq3   = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
                                        $uNum    = mysqli_num_rows($runq3);
                                        echo '
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="news_details.php?id=' . $row['id'] . '"><img class="media-object" style="width: 80px; height:90px; border-radius: 0px;" src="asset/img/news/' . $row['image'] . '" style="width: 64px; height: 64px;"></a>
                                            </div>
                                            <div class="media-body pd-lft-15">
                                                <a href="news_details.php?id=' . $row['id'] . '"><h4 class="media-heading">' . $row['title'] . '</h4></a>
                                                <i class="fa fa-clock-o"></i> ' . $row['date'] . ' at ' . $row['time'] . '<br />
                                                <i class="fa fa-comments"></i> Comments: ' . $uNum . '
                                            </div>
                                        </div><hr />
                                        ';
                                                }
                                            }
                            ?>
                            </div>
                            <div id="recent" class="tab-pane fade">
                            <?php
                                $run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' ORDER BY id DESC LIMIT 4");
                                $count = mysqli_num_rows($run);
                                if ($count <= 0) {
                                    echo '<br><center>There are no published posts</center><br>';
                                } else {
                                    while ($row = mysqli_fetch_assoc($run)) {
                                        $post_id = $row['id'];
                                        $runq3   = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
                                        $uNum    = mysqli_num_rows($runq3);
                                        echo '
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="news_details.php?id=' . $row['id'] . '"><img class="media-object" src="asset/img/news/'. $row['image'] .'" style="width: 64px; height: 64px;"></a>
                                            </div>
                                            <div class="media-body pd-lft-15">
                                                <a href="news_details.php?id=' . $row['id'] . '"><h4 class="media-heading">' . $row['title'] . '</h4></a>
                                                <i class="fa fa-clock-o"></i> ' . $row['date'] . ' at ' . $row['time'] . '<br />
                                                <i class="fa fa-comments"></i> Comments: ' . $uNum . '
                                            </div>
                                        </div><hr />
                                        ';
                                                }
                                            }
                                        ?>
                            </div>
                        </div>
                    </section>
                </div>

                    

                </div>

                </div>
                <!-- /.row -->

            </div>
        </div>
<!-- /.container -->
<link href='https://fonts.googleapis.com/css?family=Abhaya Libre' rel='stylesheet'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
    <?php include'footer.php';?>