<?php

class LimitCommentsPerUserInWordpressBlog
{
    const NUMBER = 1;

    public function __construct()
    {
        add_filter('pre_comment_approved', [$this, 'commentCheck'], 99, 2);
    }

    public function commentCheck($approved, $comment) {
        if ( isset($comment['user_ID']) ) {
            
            $args['user_id'] = $comment['user_ID'];
            
            if ( self::NUMBER <= count(get_comments( $args )) )
                return 0; //0 = to aprove, 1 = aprove, 'trash' and 'spam'
        }
        return $approved;
    }

}
