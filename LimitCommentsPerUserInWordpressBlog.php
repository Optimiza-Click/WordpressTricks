<?php

class LimitCommentsPerUserInWordpressBlog
{
    public function __construct()
    {
        add_filter('pre_comment_approved', [$this, 'commentCheck'], 99, 2);
    }

    public function commentCheck($approved, $comment) {
        if ( $comment['user_ID'] ) {
            $args = [
                'user_id' => $comment['user_ID'],
                'post_id' => $comment['comment_post_ID']
            ];
            $userComment = get_comments( $args );
            if ( 1 <= count( $userComment ) )
                return 0;
        }
        return $approved;
    }

}