<?php
require('includes/db.php');
if(isset($_GET['page'])){
    $page = $_GET['page'];
   
   }
   else{
    $page=1;
   }

   $post_per_page = 5;
   $result = ($page-1)*$post_per_page;
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from html.themexriver.com/industrio/blog.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Dec 2022 16:06:31 GMT -->
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Industrial Corporate Industry & Factory - Industrio - Industrial Industry & Factory">
    <meta name="keywords" content="chemical, company, construction, engineering, factory, gas, industrial, industry, laboratory, manufacture, mechanical, mining, oil, pharmaceutical, refinery">
    <meta name="author" content="Themexriver">
    <title>Industrio - Responsive HTML 5 template</title>
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../ms-icon-144x144.html">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body class="_active-preloader-ovh">

<div class="preloader"><div class="spinner"></div></div> <!-- /.preloader -->

<div class="page-wrapper">
    <!--header-->
    <?php include_once('includes/header.php') ?>
    
    <div class="inner-banner" style="position: relative; top: -75px; height: 400px;">
        <div class="container">
            <h3>Blog Listing</h3>
            <ul class="breadcumb">
                <li><a href="index.php">Home</a></li><!--
                --><li><span class="sep"><i class="fa fa-angle-right"></i></span></li><!--
                --><li><span>Blog Listing</span></li>
            </ul><!-- /.breadcumb -->
        </div><!-- /.container -->
    </div><!-- /.inner-banner -->
    
    <section class="blog-listing-page sec-pad">
        <div class="container">
            <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <?php
                if(isset($_GET['search'])){
                    $keyword = $_GET['search'];
                    $postQuery = "SELECT * FROM posts WHERE title LIKE '%$keyword%'ORDER BY id DESC LIMIT $result,$post_per_page";
                }else{
                    $postQuery = "SELECT * FROM posts ORDER BY id DESC LIMIT $result,$post_per_page";
                }
                    
                    $runPQ = mysqli_query($db,$postQuery);
                    while($post=mysqli_fetch_assoc($runPQ)){
                        ?>
                        <?php $imgQuery= "SELECT image FROM images WHERE post_id = {$post['id']}"; ?>
                        <?php $img = mysqli_query($db,$imgQuery);?>
                        <?php $image = mysqli_fetch_assoc($img);?>
                        <div class="single-blog-style-two">
                        <div class="img-box">
                            <img src="img/<?= $image['image'] ?>" alt="Awesome Image" style="width: 770px; height: 385px;"/>
                        </div><!-- /.img-box -->
                        <div class="text-box">
                            <a href="blog-details.php?id=<?=$post['id']?>"><h3><?=$post['title']?></h3></a>
                            <div class="meta-info">
                                <a href="#"><i class="fa fa-user"></i> <?=$post['created_by']?></a>
                                <a href="#"><i class="fa fa-calendar"></i><?=$post['created_at']?></a>
                                <a href="#"><i class="fa fa-tags"></i><?=$post['category']?> </a>
                            </div><!-- /.meta-info -->
                            <p><?=$post['content']?></p>
                            <a href="blog-details.php?id=<?=$post['id']?>" class="more hvr-sweep-to-right">View details</a>
                        </div><!-- /.text-box -->
                    </div>
                        <?php
                    }
                ?>
               <?php
               if(isset($_GET["search"]))
               {
                $keyword =  $_GET["search"];
                $q = "SELECT * FROM posts WHERE title LIKE '%$keyword'";
               }
               else{
                $q = "SELECT * FROM posts";
               }
               
               $r = mysqli_query($db,$q);
               $total_posts=mysqli_num_rows($r);
               $total_pages = ceil($total_posts/$post_per_page);
               ?>
                    <!-- /.single-blog-style-two -->
                    <!-- /.single-blog-style-two -->
                    <!-- /.single-blog-style-two -->
                    <div class="blog-post-pagination">
                        <!--
                        -->
                        <?php
                        for($page=1; $page<=$total_pages; $page++)
                        {
                        if(isset($_GET['page']))
                            if($_GET['page'] == $page)
                            {
                                ?>
                            <a href="?page=<?=$page?>" class="active"><?=$page?></a>
                            <?php
                            }
                            else
                            {
                                ?>
                            <a href="?page=<?=$page?>"><?=$page?></a>
                            <?php
                            }
                        }
                        ?>
                        
                        <a href="?page=<?=$_GET['page']+1?>"><i class="fa fa-angle-right"></i></a>
                    </div><!-- /.blog-post-pagination -->
                </div><!-- /.col-md-9 -->
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="sidebar sidebar-right">
                        <div class="single-sidebar search-widget">
                            <form action="#">
                                <input type="text" name = "search" placeholder="Search..." />
                                <button type="submit" class="fa fa-search"></button>
                            </form>
                        </div><!-- /.single-sidebar -->
                        <div class="single-sidebar recent-post-widget">
                            <div class="title">
                                <h3>Recent Post</h3>
                            </div><!-- /.title -->
                            <div class="recent-post-list">
                                <div class="single-recent-post">
                                    <a href="#"><h3>Business structured are changed by appilo team</h3></a>
                                </div><!-- /.single-recent-post -->
                                <div class="single-recent-post">
                                    <a href="#"><h3>There are many variations of passages of Lorem Ipsum</h3></a>
                                </div><!-- /.single-recent-post -->
                                <div class="single-recent-post">
                                    <a href="#"><h3>It’s no secret that the digital industry is booming.</h3></a>
                                </div><!-- /.single-recent-post -->
                                <div class="single-recent-post">
                                    <a href="#"><h3>Many desktop publishing packages and web page editors...</h3></a>
                                </div><!-- /.single-recent-post -->
                            </div><!-- /.recent-post-list -->
                        </div><!-- /.single-sidebar -->
                        <div class="single-sidebar category-widget">
                            <div class="title">
                                <h3>Categories</h3>
                            </div><!-- /.title -->
                            <ul class="category-list">
                                <li><a href="#" class="clearfix">Fashion <span class="count">(3)</span></a></li>
                                <li><a href="#" class="clearfix">Business <span class="count">(4)</span></a></li>
                                <li><a href="#" class="clearfix">Consulting <span class="count">(3)</span></a></li>
                                <li><a href="#" class="clearfix">Technology <span class="count">(4)</span></a></li>
                                <li><a href="#" class="clearfix">Life style <span class="count">(8)</span></a></li>
                            </ul><!-- /.category-list -->
                        </div><!-- /.single-sidebar -->
                        <div class="single-sidebar category-widget">
                            <div class="title">
                                <h3>Archives</h3>
                            </div><!-- /.title -->
                            <ul class="category-list">
                                <li><a href="#" class="clearfix">January 2018 <span class="count">(3)</span></a></li>
                                <li><a href="#" class="clearfix">Febuary 2018 <span class="count">(2)</span></a></li>
                                <li><a href="#" class="clearfix">March 2018 <span class="count">(6)</span></a></li>
                                <li><a href="#" class="clearfix">April 2018 <span class="count">(0)</span></a></li>
                                <li><a href="#" class="clearfix">May 2018 <span class="count">(5)</span></a></li>
                                <li><a href="#" class="clearfix">June 2018 <span class="count">(8)</span></a></li>
                            </ul><!-- /.category-list -->
                        </div><!-- /.single-sidebar -->
                        <div class="single-sidebar tags-widget">
                            <div class="title">
                                <h3>Tags</h3>
                            </div><!-- /.title -->
                            <ul class="tags-list">
                                <li><a href="#">Business</a></li><!--
                                --><li><a href="#">Financial</a></li><!--
                                --><li><a href="#">Life</a></li><!--
                                --><li><a href="#">Investment</a></li><!--
                                --><li><a href="#">Government</a></li><!--
                                --><li><a href="#">Joy</a></li>
                            </ul><!-- /.category-list -->
                        </div><!-- /.single-sidebar -->
                    </div><!-- /.sidebar sidebar-right -->
                </div><!-- /.col-md-3 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog-listing-page -->

    <?php include_once('includes/getintouch.php') ?><!-- /.contact-info-style-one -->

</div><!-- /.page-wrapper -->

<?php include_once('includes/footer.php'); ?><!-- /.site-footer -->

<?php include_once('includes/hiddensidebar.php');?><!-- /.hidden-sidebar -->



<div class="search_area zoom-anim-dialog mfp-hide" id="test-search">
    <div class="search_box_inner">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fas fa-search"></i></button>
            </span>
        </div>
    </div>
</div>

<div class="scroll-to-top scroll-to-target" data-target="html"><i class="fa fa-angle-up"></i></div>                    

<script src="js/jquery.js"></script>

<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/isotope.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/custom.js"></script>


</body>

<!-- Mirrored from html.themexriver.com/industrio/blog.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Dec 2022 16:06:32 GMT -->
</html>