<?php

namespace Suilven\CommentsChatNotifications\Extensions;

use SilverStripe\Comments\Model\Comment;
use SilverStripe\Core\Extension;
use SilverStripe\View\ArrayData;
use Suilven\Notifier\NotifyTrait;

class CommentChatNotifier extends Extension
{
    use NotifyTrait;

    /**
     * Notify Members of the post there is a new comment.
     *
     * @param \SilverStripe\Comments\Model\Comment $comment
     */
    public function onAfterPostComment(Comment $comment)
    {
        $parent = $comment->Parent();


        $arrayData = new ArrayData([
            'Comment' => $comment,
            'Parent'  => $parent
        ]);

        $message = $arrayData->renderWith('CommentReceivedChatMessage');

        error_log('Message from template: ' . $message);

        $this->notify("{$message}", 'comments', 'info');
    }


}
