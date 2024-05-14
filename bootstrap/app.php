<?php


use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'customauth' => \App\Http\Middleware\CustomAuthMiddleware::class,
        ]);

        //Trusting the Load Balancer for Heroku Proxies
        $middleware->trustProxies(at: '*');
        $middleware->trustProxies(headers: Request::HEADER_X_FORWARDED_AWS_ELB);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
