<?php //-->

use Cradle\Storm\SqlFactory;

$this->on('article-detail', function($req, $res) {
    $articleId = $req->getStage('article_id');

    if (!is_numeric($articleId)) {
        return $res->setError(true, 'Invalid ID');
    }

    $pdo = $this->package('global')->service('sql-main');
    $database = SqlFactory::load($pdo);

    $article = $database
        ->search('article')
        ->innerJoinUsing('article_profile', 'article_id')
        ->innerJoinUsing('profile', 'profile_id')
        ->filterByArticleId($articleId)
        ->getRow();

    $res->setResults($article);
});

$this->on('article-detail-2', function($req, $res) {
    $articleId = $req->getStage('article_id');

    if (!is_numeric($articleId)) {
        return $res->setError(true, 'Invalid ID');
    }

    $pdo = $this->package('global')->service('sql-main');
    $database = SqlFactory::load($pdo);

    $article = $database
        ->search('article')
        ->innerJoinUsing('article_profile', 'article_id')
        ->innerJoinUsing('profile', 'profile_id')
        ->filterByArticleId($articleId)
        ->getRow();

    if (!$article) {
        return $res->setError(true, 'Not Found');
    }

    $comments = $database
        ->search('comment')
        ->innerJoinUsing('comment_profile', 'comment_id')
        ->innerJoinUsing('profile', 'profile_id')
        ->innerJoinUsing('article_comment', 'comment_id')
        ->filterByArticleId($articleId)
        ->getRows();

    if (empty($comments)) {
        return $res->setResults($article);
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

    $subcomments = $database
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

    $article['comment'] = $commentsWithChildren;

    $res->setResults($article);
});

//use Cradle\Module\Article\SqlService;

$this->on('article-detail-3', function($req, $res) {
    $req->setStage('schema', 'article');
    $this->trigger('system-model-detail', $req, $res);

    if ($res->isError()) {
        return;
    }

    $article = $res->getResults();

    $pdo = $this->package('global')->service('sql-main');
    $database = new SqlService($pdo);

    $article['comment'] = $database->addChildrenComments($article['comment']);

    $res->setResults($article);
});
