<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-area__title">
            <?php
            $uxmastery_comments_number = get_comments_number();

            if ( $uxmastery_comments_number == 1 ) :
                /* translators: %s: post title */
                printf(_x('Một câu trả lời cho &ldquo;%s&rdquo;', 'comments title', 'uxmastery'), get_the_title());
            else :
                printf(
                /* translators: 1: number of comments, 2: post title */
                    _nx(
                        '%1$s trả lời cho &ldquo;%2$s&rdquo;',
                        '%1$s trả lời cho &ldquo;%2$s&rdquo;',
                        $uxmastery_comments_number,
                        'comments title',
                        'uxmastery'
                    ),
                    number_format_i18n($uxmastery_comments_number),
                    get_the_title()
                );
            endif;
            ?>
        </h2>

        <?php uxmastery_comment_nav(); ?>

        <ul class="comments-area__list">
            <?php
            wp_list_comments(array(
                'type' => 'comment',
                'short_ping' => true,
                'avatar_size' => 60,
                'callback' => 'uxmastery_comments'
            ));
            ?>
        </ul>
    <?php
        uxmastery_comment_nav();
    endif;

    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments">
            <?php esc_html_e('Bình luận đã đóng.', 'uxmastery'); ?>
        </p>
    <?php
    endif;

    $uxmastery_commenter = wp_get_current_commenter();
    $uxmastery_req = get_option('require_name_email');
    $uxmastery_comments_args = ($uxmastery_req ? " aria-required='true'" : '');

    $uxmastery_comments_args = array(
        'title_reply' => '<span>' . esc_html__('Để lại bình luận', 'uxmastery') . '</span>',
        'fields' => apply_filters('comment_form_default_fields',
            array(
                'comment_notes_before' => '<div class="comment-fields-row order-1"><div class="row">',
                'author' => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="author" placeholder="' . esc_html__('Họ và tên', 'uxmastery') . '" class="form-control" name="author" type="text" value="' . esc_attr($uxmastery_commenter['comment_author']) . '" size="30" ' . $uxmastery_comments_args . ' /></div></div>',
                'email' => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="email" placeholder="' . esc_html__('Email', 'uxmastery') . '" class="form-control" name="email" type="text" value="' . esc_attr($uxmastery_commenter['comment_author_email']) . '" size="30" ' . $uxmastery_comments_args . ' /></div></div>',
                'comment_notes_after' => '</div></div>',
            )
        ),
        'comment_field' => '<div class="form-comment-item form-comment-field order-3"><textarea rows="7" id="comment" placeholder="' . esc_html__('Bình luận', 'uxmastery') . '" name="comment" class="form-control"></textarea></div>',
    );

    comment_form($uxmastery_comments_args);
    ?>
</div>
