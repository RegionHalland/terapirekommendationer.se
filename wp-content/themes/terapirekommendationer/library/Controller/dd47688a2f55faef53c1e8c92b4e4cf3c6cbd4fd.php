<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/terapirekommendationer/assets/dist/css/app.dev.css">
</head>
<body>
    <h2 class="table-of-contents__header">Table of contents</h2>
    <ul class="table-of-contents">
        <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="table-of-contents__chapter">Kapitel <?php echo e($key+1); ?> · <?php echo e($chapter->post_title); ?><a href="#1"></a></li>
             <?php $__currentLoopData = $chapter->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="table-of-contents__subchapter"><?php echo e($children->post_title); ?><a href="#1.1"></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <main class="main" role="main">
            <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="section" id="<?php echo e($key+1); ?>">
                    <h1><?php echo e($chapter->post_title); ?></h1>
                    <div class="chapter-header"></div>
                    <?php $__currentLoopData = $chapter->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h2 id="<?php echo e($key+1); ?>.<?php echo e($k+1); ?>"><?php echo e($children->post_title); ?></h2>
                        <?php echo apply_filters('the_content', $children->post_content); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </main>
</body>