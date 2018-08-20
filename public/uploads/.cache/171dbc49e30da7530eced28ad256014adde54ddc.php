<?php $__env->startSection('content'); ?>
<?php if(have_posts()): ?>
    <?php while(have_posts()): ?>
        <?php echo e(the_post()); ?>

                
        <kma-slider class="slider-container"></kma-slider>

        <?php echo $__env->make('partials.quicksearch', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
        <main role="main" class="front">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <img src="<?php echo e($featuredImage['url']); ?>" class="mt-3 img-fluid" alt="Cathey & Ralph Hobbs" >
                    </div>
                    <div class="col-lg-6">
                        <article class="front">
                            <header>
                                <h1><?php echo e($headline != '' ? $headline : the_title()); ?></h1>
                            </header>
                            
                            <?php echo e(the_content()); ?>


                        </article>
                    </div>
                </div>

            </div>
        </main>
        
        <div class="feature-box-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4 text-white box-container">
                        <div class="feature-box feat-one">
                            <h3><?php echo e($featureBox1['title']); ?></h3>
                            <p><?php echo e($featureBox1['text']); ?></p>
                            <a class="btn btn-lg btn-outline-white btn-rounded" href="<?php echo e($featureBox1['link']['url']); ?>" ><?php echo e($featureBox1['link']['title']); ?> &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 text-white box-container">
                        <div class="feature-box feat-two">
                            <h3 class="text-orange"><?php echo e($featureBox2['title']); ?></h3>
                            <p><?php echo e($featureBox2['text']); ?></p>
                            <a class="btn btn-lg btn-outline-white btn-rounded" href="<?php echo e($featureBox2['link']['url']); ?>" ><?php echo e($featureBox2['link']['title']); ?> &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-white box-container">
                        <div class="feature-box feat-three">
                            <h3><?php echo e($featureBox3['title']); ?></h3>
                            <p><?php echo e($featureBox3['text']); ?></p>
                            <a class="btn btn-lg btn-outline-white btn-rounded" href="<?php echo e($featureBox3['link']['url']); ?>" ><?php echo e($featureBox3['link']['title']); ?> &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <?php echo $__env->make('pages.404', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>