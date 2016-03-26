<?php get_header(); ?>
<?php
    $projects = new WP_Query(
        array(
            'post_type' => 'projects',
            'posts_per_page' => -1
        )
    );
    $events = get_field_object('field_56c6ffc4120b3');
?>
<div class="container">
    <div class="projects">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="project-heading">Projects</h1>
            </div>
        </div>
        <?php if ( $projects->have_posts() ) { ?>
            <div class="row">
                <div class="large-12 columns">
                    <div class="projects-notification">
                        <div class="row">
                            <div class="large-12 columns">
                                <h2 class="projects-notification-heading">Masters of Tinkering Awards 2016</h2>
                            </div>
                            <div class="large-6 columns">
                                <p class="projects-notification-description">In 1 year: <?php echo count($events['choices']); ?> hackathons, 4 countries, 3 continents and <?php echo $projects->found_posts; ?> prototypes. Time to celebrate with the Masters of Tinkering Awards.</p>
                                <p><strong class="projects-notification-goal">You chose the winners of the first Masters of Tinkering Awards:</strong></p>
                            </div>
                            <div class="large-6 columns">
                                <div class="projects-notification-icon project-vote-experimental">
                                    <h3 class="projects-notification-subheading">Best experiment: Flight</h3>
                                    <p>Stretching the boundaries of possibilities</p>
                                </div>
                                <div class="projects-notification-icon project-vote-potential">
                                    <h3 class="projects-notification-subheading">Most potential: News Bricks</h3>
                                    <p>Creations with exceeding values</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="projects-filter">
                        <input type="checkbox" class="projects-filter-toggle" id="projects-filter-toggle">
                        <label for="projects-filter-toggle" class="projects-filter-toggle-label">Filter</label>
                        <div class="projects-filter-content">
                            <?php
                                $categories = get_field_object('project-categories');

                                if ( $categories && isset($categories['choices']) && !empty($categories['choices']) ) {
                                    ?>
                                    <h4 class="projects-filter-heading">Categories</h4>
                                    <ul class="projects-filter-list">
                                        <?php foreach ( $categories['choices'] as $choice ) { ?>
                                            <li>
                                                <input type="checkbox" class="projects-filter-category" value="<?php echo $choice; ?>" id="<?php echo $choice; ?>">
                                                <label for="<?php echo $choice; ?>"><?php echo $choice; ?></label>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row projects-list-empty">
                <div class="large-12 columns">
                    <p>No projects could be found</p>
                </div>
            </div>
            <ul class="projects-list row">
                <?php
                    while ( $projects->have_posts() ) {
                        $projects->the_post();
                        $image = get_field('project-image');

                        ?>
                        <li class="medium-6 columns"
                            data-categories="<?php echo join(',', get_field('project-categories')); ?>"
                            data-timestamp="<?php the_time('U'); ?>">
                            <div class="project-excerpt">
                                <div class="project-excerpt-image-container">
                                    <div class="project-excerpt-image"<?php if ( $image ) echo ' style="background-image: url(' . $image['sizes']['medium_large'] . ');"'; ?>></div>
                                </div>
                                <h2 class="project-excerpt-heading"><?php the_title(); ?></h2>
                                <?php if ( get_field('project-event') ) { ?>
                                    <small class="project-excerpt-subheading"><?php the_field('project-event'); ?></small>
                                <?php } ?>
                                <a href="<?php the_permalink(); ?>" class="project-excerpt-anchor"></a>
                                <?php if ( get_field('project-banner') ) { ?>
                                    <span class="project-excerpt-banner"><?php the_field('project-banner'); ?></span>
                                <?php } ?>
                                <?php if ( get_field('project-members') ) { ?>
                                    <ul class="project-members">
                                        <?php
                                            while ( has_sub_field('project-members') ) {
                                                $image = get_sub_field('project-member-image');
                                                $url = esc_url(get_sub_field('project-member-url'));
                                                ?>
                                                <li class="project-member" title="<?php the_sub_field('project-member-name'); ?>"<?php if ( $image ) echo ' style="background-image: url(' . $image['sizes']['thumbnail'] . ');"'; ?>>
                                                    <?php the_sub_field('project-member-name'); ?>
                                                    <?php if ( $url ) { ?>
                                                        <a href="<?php echo $url; ?>" target="_blank" class="project-member-anchor"></a>
                                                    <?php } ?>
                                                </li>
                                                <?php
                                            }
                                        ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        <?php } else { ?>
            <div class="row">
                <div class="large-12 columns">
                    <p>No projects could be found.</p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.0/js.cookie.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/projects.js"></script>
<?php get_footer(); ?>
