<?php  
$page_title = "Add new post";
include '../mysql.php';
include 'header.php'; 
$page_title = "Add post";
    if(isset($_POST['submit'])){
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $level = $_POST['level'];
        $term = $_POST['term'];
        $subject = $_POST['subject'];
        $content =mysqli_real_escape_string($conn, $_POST['content']);
        $catagory= 'CSE'.$level.$term.$subject;
        $date = date('Y-m-d H:i:s');
        $img_name = 'default_post.jpg';

        // dealing with feature image
        $file=$_FILES['file'];
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_type = $file['type'];
        
        $file_ext = explode('.',$file_name);
        $file_actual_ext = strtolower(end($file_ext));

        if($file_error===0){
            $file_new_name = $file_ext[0].uniqid('',true).".".$file_actual_ext ;
            $file_destination = '../img/post_image/'.$file_new_name ;
            $file_final_destination = 'img/post_image/'.$file_new_name ;
            move_uploaded_file($file_tmp_name,$file_destination);
        }else{
            $file_final_destination = 'img/post_image/default_post.jpg';
        }
        $link_status=0;
        $link=mysqli_real_escape_string($conn, $_POST['link']);
        $keyword=mysqli_real_escape_string($conn, $_POST['keyword']);
        if($link!=''){
            $link_status=1;
        }
        $query = "INSERT INTO post_init (title,catagory,keyword,ins_id,post_date,content,image_name,video_status,video_link)";
        $query.=" VALUES ('$title','$catagory','$keyword',$u_id,'$date','$content','$file_final_destination',$link_status,'$link')";
        $rr = mysqli_query($conn,$query);
        mysqli_close($conn);
    }
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            New Post
                            <small>by <?php echo $u_name; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <div class="post_wrapper">
                <form action="new_post.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control title" class="title"  placeholder="Enter Title">
                    </div>
                    <div class="cats">
                        <div class="form-group cat">
                            <label for="level">Level</label>
                            <select class="form-control" name="level">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            </select>
                        </div>
                        <div class="form-group cat">
                            <label for="term">Term</label>
                             <select class="form-control" name="term">
                            <option>1</option>
                         <option>2</option>
                             <option>3</option>
                            </select>
                        </div>
                        <div class="form-group cat">
                            <label for="level">Subject</label>
                            <select class="form-control" name="subject">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="file">Select featured image</label>
                        <input type="file" name="file" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="title">Video link from youtube</label>
                        <input type="text" name="link" class="form-control title"   placeholder="Enter Link">
                    </div>
                    <div class="form-group">
                        <label for="title">Keyword</label>
                        <input type="text" name="keyword" class="form-control title"  placeholder="Enter Keyword">
                        <small>Use ',' comma to separate keywords</small>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="body" class="form-control" rows="6"></textarea>
                    </div>
                    <button name = "submit" type="submit" class="btn btn-primary mb-2">Submit Post</button>
                    
                </form>
            </ >
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script src="js/scripts.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>


</html>
