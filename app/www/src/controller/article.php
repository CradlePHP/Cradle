<?php

$this->get('/script/test\.js', function($req, $res) {
    $res->setContent('Hello');
});

$this->get('/articles', function($req, $res) {
    //get all the articles
    $req->setStage('schema', 'article');
    $this->trigger('system-model-search', $req, $res);

    //set the template variables
    $data = $res->getResults();

    //render the body
    $body = $this->package('/app/www')->template('article/search', $data);

    //Set the page content
    $res
        ->setPage('title', 'Articles')
        ->setContent($body);

    //Render a page
    $this->trigger('www-render-page', $req, $res);
});

$this->get('/article/:article_id', function($req, $res) {
    $data = [];
    //if this is a return back from processing the comment form
    if ($req->hasPost()) {
        $data['form'] = $res->getPost();
    }

    //and it's has of an error
    if ($res->isError()) {
        //pass the error messages to the template
        $res->setFlash($res->getMessage(), 'error');
        $data['errors'] = $res->getValidation();
    }

    //get the article
    $req->setStage('schema', 'article');
    $this->trigger('system-model-detail', $req, $res);

    //if there is no data
    if (!$res->hasResults()) {
        //let the 404 catch this
        return;
    }

    //add the article detail
    $data['item'] = $res->getResults();

    //render the body
    $body = $this->package('/app/www')->template('article/detail', $data);

    //Set Content
    $res
        ->setPage('title', $data['item']['article_title'])
        ->setContent($body);

    //Render a page
    $this->trigger('www-render-page', $req, $res);
});

$this->post('/article/:article_id', function($req, $res) {
    //get the article id
    $articleId = $req->getStage('article_id');
    //setup the routing path
    $route = sprintf('/article/%s', $articleId);

    //get the session profile id
    $profileId = $req->getSession('me', 'profile_id');

    if (!$profileId) {
        $res->setError(true, 'Must be logged in to comment.');
        // go back to GET /article/:article_id route
        return $this->routeTo('get', $route, $req, $res);
    }

    //create the comment
    $req
        ->setStage('schema', 'comment')
        ->setStage('profile_id', $profileId);

    $this->trigger('system-model-create', $req, $res);

    //if there was an error creating the comment
    if ($res->isError()) {
        // go back to GET /article/:article_id route
        return $this->routeTo('get', $route, $req, $res);
    }

    //get the comment id
    $commentId = $res->getResults('comment_id');

    //link the article to the comment
    $req
        ->setStage('schema1', 'article')
        ->setStage('schema2', 'comment')
        ->setStage('comment_id', $commentId);

    $this->trigger('system-relation-link', $req, $res);

    //if there was an error linking the article to the comment
    if ($res->isError()) {
        // go back to GET /article/:article_id route
        return $this->routeTo('get', $route, $req, $res);
    }

    //it was good
    //get the global package
    $global = $this->package('global');
    //add a happy message
    $global->flash('Comment Added', 'success');
    //redirect to /article/:article_id
    $global->redirect($route);
});
