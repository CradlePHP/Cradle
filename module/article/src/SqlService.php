<?php //-->

namespace Cradle\Module\Article;

use Cradle\Storm\SqlFactory;
use PDO as SqlResource;

class SqlService
{
    protected $resource;

    public function __construct(SqlResource $resource)
    {
        $this->resource = SqlFactory::load($resource);
    }

    public function addChildrenComments(array $comments): array
    {
        if (empty($comments)) {
            return [];
        }

        $commentIds = [];
        $commentsWithChildren = [];

        foreach($comments as $comment) {
            $commentId = $comment['comment_id'];
            $commentIds[] = $commentId;
            $commentsWithChildren[$commentId] = $comment;
        }

        $filter = sprintf(
            'comment_id_1 IN (%s)',
            implode(',', $commentIds)
        );

        $subcomments = $this->resource
            ->search('comment')
            ->innerJoinOn('comment_comment', 'comment_id_2=comment_id')
            ->innerJoinUsing('comment_profile', 'comment_id')
            ->innerJoinUsing('profile', 'profile_id')
            ->addFilter($filter)
            ->getRows();

        foreach ($subcomments as $comment) {
            $primaryCommentId = $comment['comment_id_1'];
            $secondaryCommentId = $comment['comment_id_2'];

            $primaryComment = $commentsWithChildren[$primaryCommentId];
            $primaryComment['children'][$secondaryCommentId] = $comment;
            $commentsWithChildren[$primaryCommentId] = $primaryComment;
        }

        return $commentsWithChildren;
    }
}
