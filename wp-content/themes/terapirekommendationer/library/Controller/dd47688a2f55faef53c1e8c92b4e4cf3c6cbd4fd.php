<?php global $post; ?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/terapirekommendationer/library/Controller/min.css">
</head>
<body>
    <main class="main" role="main">
        <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="section" id="<?php echo e($key+1); ?>">
                <h1><?php echo e($chapter->post_title); ?></h1>
                <?php echo apply_filters('the_content', $chapter->post_content); ?>

                <div class="chapter-header"></div>
                    
                   

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </main>
</body>