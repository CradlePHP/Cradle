<?php //-->

use Cradle\Module\Utility\File;

/**
 * Render the Home Page
 *
 * @param Request $request
 * @param Response $response
 */
$this->get('/', function ($request, $response) {
    //Prepare body
    $data = [];

    //Render body
    $class = 'page-home';
    $title = cradle('global')->translate('Cradle OMS');
    $body = cradle('/app/www')->template('index', $data);

    //Set Content
    $response
        ->setPage('title', $title)
        ->setPage('class', $class)
        ->setContent($body);

    //Render blank page
    $this->trigger('www-render-page', $request, $response);
});

/**
 * Render the file preview / download
 * 
 * @param Request $request
 * @param Response $response
 */
$this->get('/download', function ($request, $response) {
    // get file location
    $location = $request->getStage('location');
    // get file name
    $filename = $request->getStage('filename');

    // get file mime type
    $mime = File::getMimeFromLink($location);

    // set file type
    $type = sprintf('%s; charset=UTF-8', $mime);

    $response
        ->addHeader('Content-Encoding', 'UTF-8')
        ->addHeader('Content-Type', $type);

    // force download?
    if ($request->hasStage('force')) {
        // let the browser download the file
        $response->addHeader('Content-Disposition', 'attachment; filename=' . $filename);
    } else {
        // this is just a preview
        $response->addHeader('Content-Disposition', 'inline; filename=' . $filename);
    }

    // load the file
    $response->setContent(file_get_contents($location));
});