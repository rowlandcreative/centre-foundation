<?php
/**
 * Focus Stripe
 *
 * @package Centre_Foundation
 */
?>

<?php 	
global $zindex;

$title = get_sub_field('section_title');
$content = get_sub_field('section_content');
$bg_color = get_sub_field('background_color');

$btn_label = get_sub_field('button_label');
$btn_link = esc_url(get_sub_field('button_link'));

$resources_title = get_sub_field('resources_title'); 
?>

<div class="focus stripe-shadow"
    style="background-color: <?php echo $bg_color; ?>;
    z-index:<?php echo $zindex ?>;">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell medium-7">
                <div class="section-title font-C color-Gray flexline-long-gray">
                    <?php echo $title ?>
                </div>
                <div class="section-content font-E color-Blue">
                    <?php echo $content ?>
                </div>
                <?php if ($btn_label) { ?>
                    <div class="button-container">
                        <a href="<?php echo $btn_link ?>" class="button large shadow">
                            <?php echo $btn_label ?>
                        </a>
                    </div>     
                <?php } ?>
            </div>  
            <div class="cell medium-5">
                <div class="grid-container">
                    <div class="grid-x grid-padding-x">
                        <?php
                        // check if the repeater field has rows of data
                        if( have_rows('resources') ):
                        ?>
                            <div class="cell">
                                <div class="resources-title font-J color-Gray">
                                    <?php echo $resources_title;?>
                                </div>
                            </div>
                            <div class="cell">
                                <?php
                                    // loop through the rows of data
                                    while ( have_rows('resources') ) : the_row(); 
                                        $name = get_sub_field('resource_name');
                                        $desc = get_sub_field('resource_description');
                                        $type = get_sub_field('resource_type'); 

                                        $file = esc_url(get_sub_field('file'));
                                        $link = esc_url(get_sub_field('hyperlink'));
                                        
                                        if ($type == "download") {
                                ?> 
                                            <ul>
                                                <li class="file-list">
                                                    <a href="<?php echo $file ?>">
                                                        <span class="font-K color-Blue">
                                                            <?php echo $name ?>
                                                        </span>
                                                        <br>
                                                        <span class="font-L color-Blue">
                                                            <?php echo $desc ?>
                                                        </span>
                                                    </a>
                                                </li>  
                                            </ul> 
                                        <?php } elseif ($type == "hyperlink") { ?>
                                            <ul>
                                                <li class="hyperlink-list">
                                                    <a href="<?php echo $link ?>">
                                                        <span class="font-K color-Blue">
                                                            <?php echo $name ?>
                                                        </span>
                                                        <br>
                                                        <span class="font-L color-Blue">
                                                            <?php echo $desc ?>
                                                        </span>
                                                    </a>
                                                </li>  
                                            </ul>
                                        <?php } elseif ($type == "bullet") { ?>
                                            <ul>
                                                <li class="bullet-list">
                                                    <span class="font-K color-Blue">
                                                        <?php echo $name ?>
                                                    </span>
                                                    <br>
                                                    <span class="font-L color-Blue">
                                                        <?php echo $desc ?>
                                                    </span>
                                                </li>  
                                            </ul>
                                        <?php }   
                                    endwhile; 
                                ?>
                            </div>
                        <?php 
                        endif;
                        ?>
                    </div>
                </div>
            </div>

            <?php
            // check if the repeater field has rows of data
            if( have_rows('projects') ):
            ?>
                <div class="cell">
                    <div class="projects-title">
                        <?php echo $title_2;?>
                    </div>
                </div>
            <?php
                // loop through the rows of data
                while ( have_rows('projects') ) : the_row(); 

                    $name = get_sub_field('project_name');
                    $desc = get_sub_field('project_description');

                    $file = get_sub_field('pdf_file'); 
            ?>
                    <div class="cell medium-6">
                        <a href="<?php echo $file['url']; ?>" target="_blank">
                            <div class="shadow">
                                <div class="content">
                                    <div class="grid-x grid-padding-x">
                                        <div class="cell auto">
                                            <div class="resource-name">
                                                <?php echo $name ?>
                                            </div>
                                            <div class="resource-desc">
                                                <?php echo $desc ?>
                                            </div>
                                        <?php if( $file ): ?>
                                            <div class="download">
                                                Download PDF
                                            </div>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php    
                endwhile;
            endif;
            ?>
        </div>
    </div>
</div>
