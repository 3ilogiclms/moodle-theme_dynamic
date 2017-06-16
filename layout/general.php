<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));
dynamic_check_colourswitch();
dynamic_initialise_colourswitcher($PAGE);
$bodyclasses = array();
$bodyclasses[] = 'dynamic-' . dynamic_get_colour();
if ($hassidepre && !$hassidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($hassidepost && !$hassidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$hassidepost && !$hassidepre) {
    $bodyclasses[] = 'content-only';
}
$haslogo = (!empty($PAGE->theme->setting_file_url('logo', 'logo')));
$hasfootnote = (!empty($PAGE->theme->settings->footnote));
$hidetagline = (!empty($PAGE->theme->settings->hide_tagline) && $PAGE->theme->settings->hide_tagline == 1);
if (!empty($PAGE->theme->settings->tagline)) {
    $tagline = $PAGE->theme->settings->tagline;
} else {
    $tagline = get_string('defaulttagline', 'theme_dynamic');
}
echo $OUTPUT->doctype()
?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
<title><?php echo $PAGE->title ?></title>
<link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme') ?>" />
<meta name="description" content="<?php echo strip_tags(format_text($SITE->summary, FORMAT_HTML)) ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php echo $PAGE->bodyid ?>" class="<?php echo $PAGE->bodyclasses . ' ' . join(' ', $bodyclasses) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<header>
    <?php if ($hasheading || $hasnavbar) { ?>
     <div class="slide-banner">
    <div id="page-header" >
        <div id="page-header-wrapper" class="wrapper clearfix">
         <?php if ($hasheading) { ?>
        <div id="headermenu">
         <div class="container zero-padding">
                    <?php
                                if (isloggedin()) {
                                    echo html_writer::start_tag('div', array('id' => 'userdetails'));
                                    echo html_writer::start_tag('p', array('class' => 'prolog'));
                                    echo html_writer::link(new moodle_url('/user/profile.php', array('id' => $USER->id)), get_string('myprofile')) . ' | ';
                                    echo html_writer::link(new moodle_url('/login/logout.php', array('sesskey' => sesskey())), get_string('logout'));
                                    echo html_writer::end_tag('p');
                                    echo html_writer::end_tag('div');
                                } else {
                                    echo html_writer::start_tag('div', array('id' => 'userdetails_loggedout'));
                                    $loginlink = html_writer::link(new moodle_url('/login/'), get_string('loginhere', 'theme_dynamic'));
                                    echo html_writer::tag('h1', get_string('welcome', 'theme_dynamic', $loginlink));
                                    echo html_writer::end_tag('div');
                                    ;
                                }
                                ?>

                    <?php echo $OUTPUT->lang_menu(); }?>
                    </div>
                     </div>
            <div class="container zero-padding">
            <?php if ($hasheading) { ?>
                


                <div id="logobox">
                    <?php
                                if ($haslogo) {
                                    //echo html_writer::link(new moodle_url('/'), "<img src='" . (!empty($PAGE->theme->setting_file_url('logo', 'logo'))) . "' alt='logo' />");
									?>
									<a href="<?php echo $CFG->wwwroot; ?>">
							<img alt="Logo" src="<?php echo $PAGE->theme->setting_file_url('logo', 'logo') ?>">
						</a>
									<?php
                                } else {
                                    ?>
                                    <a href="<?php echo $CFG->wwwroot; ?>">
							<img src="<?php echo $OUTPUT->pix_url('logo', 'theme'); ?>" alt="Logo" />
						</a>
                                    <?php
                                }
                                ?>
                    <?php if (!$hidetagline) { ?>
                    <h4><?php echo $tagline ?></h4>
                    <?php } ?>
                </div>
                <div class="clearer"></div>
                <?php if ($haslogo) { ?>
                <h4 class="headermain inside">&nbsp;</h4>
                <?php } else { ?>
                <h4 class="headermain inside">&nbsp;</h4>
                <?php } ?>
                <?php } // End of if ($hasheading)?>

                <!-- DROP DOWN MENU -->

                <div id="dropdownmenu">
                    <?php if ($hascustommenu) { ?>
                    <div id="custommenu"><?php echo $custommenu; ?></div>
                    <?php } ?>
                    <div class="navbar">
                        <div class="wrapper clearfix">
                            <div class="breadcrumb">
                                <?php if ($hasnavbar) echo $OUTPUT->navbar(); ?>
                            </div>
                            <div class="navbutton"> <?php echo $PAGE->button; ?></div>
                        </div>
                    </div>
                </div>
                <!-- END DROP DOWN MENU -->
            </div>
        </div>
    </div>
     </div>
    <?php } // if ($hasheading || $hasnavbar)  ?>
    <!-- END OF HEADER -->
</header>
<div id="page">

    <!-- START OF CONTENT -->
    <div id="page-content" class="container">
        <div id="region-main-box">
            <div id="region-post-box">
               
                    <?php if ($hassidepre) { ?>
                     <div class="col-md-2 zero-padding">
                    <div id="region-pre" class="block-region">
                        <div class="region-content"> <?php echo $OUTPUT->blocks_for_region('side-pre') ?> </div>
                    </div>
                    
                </div>
                <?php } ?>
                <div class="
                <?php 
					if (!$hassidepost || !$hassidepost) {  
                			echo "col-md-10";
						}
					else if (!$hassidepost && !$hassidepost)	{
							echo "col-md-12";
						}
					else {
							echo "col-md-8";
						}
                ?>
                ">
                    <div id="region-main-wrap">
                        <div id="region-main">
                            <div class="region-content"> <?php echo core_renderer::MAIN_CONTENT_TOKEN ?> </div>
                        </div>
                    </div>
                </div>
               
                    <?php if ($hassidepost) { ?>
                     <div class="col-md-2 zero-padding">
                    <div id="region-post" class="block-region">
                        <div class="region-content"> <?php echo $OUTPUT->blocks_for_region('side-post') ?> </div>
                    </div>
                    </div>
                    <?php } ?>
                
            </div>
        </div>
    </div>
    <!-- END OF CONTENT -->
    <div class="clearfix">&nbsp;</div>
    <!-- END OF #Page -->
</div>
<!-- START OF FOOTER -->

<?php if ($hasfooter) { ?>
<div id="page-footer">
    <div id="footer-wrapper">
        <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
        <?php if ($hasfootnote) { ?>
        <div id="footnote"><?php echo $PAGE->theme->settings->footnote; ?></div>
        <?php
            }
            echo $OUTPUT->login_info();
            echo $OUTPUT->standard_footer_html();
            ?>
    </div>
</div>
<?php } ?>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>