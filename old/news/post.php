<?php
include "core.php";
head();
?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                    <section class="alignleft col-md-12">
<?php
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
echo '
                    <article class="blog-post">
                        <div class="block-grey">
                            <div class="block-light">
                                <div class="wrapper-img">
                                    <img src="' . $row['image'] . '" width="100%" height="260"/>
                                </div>
                                <div class="wrapper">
                                    <h2 class="post-title">' . $row['title'] . '</h2><hr />
                                    ' . html_entity_decode($row['content']) . '
									<hr>
                                    <p>
                                        <i class="fa fa-calendar"></i> Date: ' . $row['date'] . '&nbsp;&nbsp;&nbsp;
										<i class="fa fa-comments-o"></i> Comments: <a href="#comments">' . $uNum . '</a>
                                    </p>
                                    <hr>

                                    <div class="title-divider" id="comments">
                                        <h3><i class="fa fa-comments-o"></i> Comments - ' . $uNum . '</h3>
                                        <div class="divider-arrow"></div>
                                    </div>
';
?>

<?php
$q     = mysqli_query($connect, "SELECT * FROM comments WHERE post_id='$row[id]' AND approved='Yes' ORDER BY id DESC");
$count = mysqli_num_rows($q);
if ($count <= 0) {
    echo '<div class="alert alert-info">There are no comments yet</div>';
} else {
    while ($comment = mysqli_fetch_array($q)) {
        
        echo '
	    <article class="row">
            <div class="col-md-2">
              <figure class="thumbnail">
                <img class="img-responsive" src="' . $comment['avatar'] . '" />
              </figure>
            </div>
            <div class="col-md-10">
              <div class="panel panel-default">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user"><i class="fa fa-user"></i> ' . $comment['author'] . '</div>
                    <time class="comment-date"><i class="fa fa-clock-o"></i> ' . $comment['date'] . ' at ' . $comment['time'] . '</time>
                  </header><hr />
                  <div class="comment-post">
                    <p>
                      ' . $comment['comment'] . '
                    </p>
                  </div>
                </div>
              </div>
            </div>
		</article>
	';
    }
}
?>                                  <br />
									
                                    <div class="title-divider">
                                        <h3>Leave A Comment</h3>
                                        <div class="divider-arrow"></div>
                                    </div>

                                    <form action="post.php?id=<?php echo $id; ?>" method="post">
                                                <label for="name"><i class="fa fa-user"></i> Your Name:</label>
                                                <input type="text" name="author" value="" class="form-control" required />
                                                <br />

                                                <label for="dontfill" style="display:none;">Don't fill:</label>
                                                <input type="text" name="dontfill" value="" style="display:none;" />

                                                <label for="input-message"><i class="fa fa-comment-o"></i> Comment:</label>
                                                <textarea name="message" rows="10" class="form-control" required></textarea>
                                                <br />
												
                                                <input type="submit" name="post" class="btn btn-primary btn-block" value="Post" />
                                            </div>
                                        </div>
                                    </form>
<?php
if (isset($_POST['post'])) {
    
    $comment = $_POST['message'];
    $author  = $_POST['author'];
    $spam    = $_POST['dontfill'];
    
    $date = date('d F Y');
    $time = date('H:i');
    
    if (strlen($comment) < 2) {
        echo '<div class="alert alert-danger">Your comment is too short</div>';
    } else {
        if (strlen($author) < 2) {
            echo '<div class="alert alert-warning">Your name is too short</div>';
        } else {
            if ($spam) { // Honeypot - Stop spam bots
                exit("Spam Detected!");
            } else {
                $runq = mysqli_query($connect, "INSERT INTO `comments` (post_id, `comment`,author, date, time) VALUES ('$row[id]', '$comment', '$author', '$date', '$time')");
                echo '<div class="alert alert-success">Your comment has benn successfully posted</div>';
            }
        }
    }
}
?>
                    </article>
            </section>

			</div>
<?php
sidebar();
footer();
?>