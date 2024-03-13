<?php
$team_title = get_sub_field('team_title');
$team_members = get_sub_field('team_members'); //url
$team_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $team_title . '</h1>' : '<h2 class="h1">' . $team_title . '</h2>';
?>
<section class="team-section fadeInUp wow">
    <div class="content-holder">
        <?php if (!empty($team_title)) : echo $team_title_h; endif; ?>
        <?php if (!empty($team_members)): ?>
            <div class="three-columns">
                <?php foreach ($team_members as $t_member):
                    $member_img = $t_member['member_img'];
                    $member_name = $t_member['member_name'];
                    $member_position = $t_member['member_position'];
                    $member_description = $t_member['member_description']; ?>
                    <div class="col">
                        <?php if (!empty($member_img)): ?>
                            <div class="img-box">
                                <img src="<?php echo $member_img['url']; ?>"
                                     alt="<?php echo !empty($member_img['alt']); ?>"/>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($member_name)): ?>
                            <strong><?php echo $member_name; ?></strong>
                        <?php endif; ?>
                        <?php if (!empty($member_position)): ?>
                            <span><?php echo $member_position; ?></span>
                        <?php endif; ?>
                        <?php echo $member_description; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>