<?php
global $post;
$team = new Team($post->ID);
$linkedin_title = strtolower($team->getTitle());
$linkedin_title = str_replace(" ", "-", $linkedin_title);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            <div class="image-wrapper no-lazy">
                <?=$team->getFeatureImage()?>
            </div>
            <div class="content-wrapper">
                <div class="socials-wrapper">
                    <ul class="plain">
                        <li class="email"><a href="mailto:<?=get_option('email')?>"><span class="fa fa-envelope"></span><?=get_option('email')?></a></li>
                        <li class="linkedin"><a href="<?=$team->getCustomField('team-linkedin')?>" target="_blank"><span class="fa fa-linkedin"></span><?=$linkedin_title?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9 staff-details">
            <h1><?=$team->getTitle()?></h1>
            <h2><?=$team->getCustomField('team-position')?></h2>
            <p><?=$team->getCustomField('team-qualifications')?></p>
            <div class="expertise-wrapper">
                <h3>Expertise</h3>
                <?=$team->getExpertise()?>
            </div>
            <div class="description">
                <?=$team->getContent()?>
            </div>
        </div>
    </div>
</article>
