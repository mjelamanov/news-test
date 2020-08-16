<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * @inheritDoc
     */
    protected function renderHttpException(HttpExceptionInterface $e)
    {
        $this->registerErrorViewPaths();

        $views = [$this->getCustomHttpExceptionView($e), 'errors.error', $this->getHttpExceptionView($e)];

        foreach ($views as $view) {
            if (view()->exists($view)) {
                return response()->view($view, [
                    'errors' => new ViewErrorBag(),
                    'status' => $e->getStatusCode(),
                    'message' => Response::$statusTexts[$e->getStatusCode()],
                ], $e->getStatusCode(), $e->getHeaders());
            }
        }

        return $this->convertExceptionToResponse($e);
    }

    /**
     * @param \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e
     *
     * @return string
     */
    protected function getCustomHttpExceptionView(HttpExceptionInterface $e)
    {
        return 'errors.' . $e->getStatusCode();
    }
}
