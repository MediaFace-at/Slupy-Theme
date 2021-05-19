<?php
/**
 * The template for displaying archive of Location taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Slupy
 */
get_header();
?>
<div class="row justify-content-center no-gutters" style="overflow: hidden;">
    <div class="col-md-9 col-12 bg-content">
        
    <h1 class="entry-title headline shimmerfx margin-top"><?php echo single_term_title(); ?></h1> 
        <div class="row no-gutters">   
                <?php if ( have_posts() ): ?>
                    <?php while( have_posts() ): ?>
                        <?php the_post(); ?>
                            <div class="girls_col col-lg-3 col-md-4 col-6">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="girls_container shine">
                                        <?php if(get_the_date('Y-m-d-H-i-s') > date("Y-m-d-H-i-s",strtotime("-14 day"))) { ?>
                                            <div class="new"><p class="new-inner">NEU</p></div>
                                        <?php } ?>
                                        <div class="girls_poster"><?php echo get_the_post_thumbnail(); ?></div>
                                        <div class="girls_desc">
                                        <div class="girls_name headline shimmerfx"><?php echo get_the_title(); ?></div>
                                            <!--<ul class="girl_list">
                                                <?php if($girlsData['girlsBirthday'][0]): ?>
                                                <div class="girl_att">
                                                    <span>
                                                        <?php
                                                        $girlsBirthday = date('d/m/Y', $girlsData['girlsBirthday'][0]);
                                                        calcAge($girlsBirthday);
                                                        ?>
                                                    </span>
                                                </div>
                                                <?php endif; if($girlsData['girlsWeight'][0]): ?>
                                                <div class="girl_att">
                                                    <span>
                                                        <?php echo $girlsData['girlsWeight'][0]; ?>
                                                        /kg
                                                    </span>
                                                    
                                                </div>
                                                <?php endif; 
                                                if($girlsData['girlsSize'][0]): ?>
                                                <div class="girl_att">
                                                    <span>
                                                        <?php echo $girlsData['girlsSize'][0]; ?>
                                                        /cm
                                                    </span>
                                                    
                                                </div>
                                                <?php endif; ?>
                                            </ul>-->
                                        </div> 
                                    </div>
                                </a>
                            </div>    
                            <?php // the_content(); ?>
                            <?php // the_title(); ?>
                        
                    <?php endwhile; ?>
                    <?php the_posts_pagination(); 

                 else: ?>
                    <p><?php _e( 'No Reviews found', 'slupy' ); ?></p>
                <?php endif; ?>
                
        </div>
        <h2 class="entry-title headline shimmerfx margin-top">Bald Verfügbar</h2>
    <?php echo do_shortcode('[get_girls_future rows="4"]'); ?>
    </div>
    
</div>
<?php get_footer();