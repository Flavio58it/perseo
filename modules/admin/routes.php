<?php
$app->get('/admin[/]', function (\Slim\Http\Request $request, \Slim\Http\Response $response) use ($container) {
    $container->set('view', function ($container) {
        $view = new \Slim\Views\Twig('modules', [
            'cache' => false
        ]);
        $router = $container->get('router');
        $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
        $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));
        return $view;
    });
    $panel = new \admin\Controllers\Panel($container, $request);
    return $this->get('view')->render($response,
        '/admin/views/' . $container->get('settings.global')['template'] . '/admin/index.twig',
        $panel->get('/admin/views/' . $container->get('settings.global')['template'] . '/admin/dashboard.twig'));
})->add(new \login\Controllers\CheckLogin($container, 'admins'));
$app->post('/admin/logout[/]', function (\Slim\Http\Request $request, \Slim\Http\Response $response) use ($container) {
	$myresponse = array(
		'type' => 'json',
		'verbose' => true
	);
	$container->set('myresponse', $myresponse);	
    $mylogin = new \login\Controllers\Login($container, 'admins');
    return $response->withJson($mylogin->logout());
})->add(new \login\Controllers\CheckLogin($container, 'admins'));