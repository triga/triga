<?php namespace Triga\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException'
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return Response
     */
    public function render($request, Exception $e)
    {
        if ($this->isHttpException($e)) {
            $this->notifyDevelopers($e, $request->url(), '404');

            return $this->renderHttpException($e);
        } else {
            $this->notifyDevelopers($e, $request->url(), 'general');

            return $this->renderExceptionWithWhoops($e);
        }
    }

    /**
     * Render an exception using Whoops.
     *
     * @param  \Exception $e
     * @return Response
     */
    protected function renderExceptionWithWhoops(Exception $e)
    {
        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler());

        return new Response(
            $whoops->handleException($e),
            $e->getStatusCode(),
            $e->getHeaders()
        );
    }

    /**
     * Sends an email to the developer(s) with the error report.
     *
     * @param Exception $exception
     * @param string $url
     * @param string $type
     */
    protected function notifyDevelopers(Exception $exception, $url, $type)
    {
        $report = (new CrashReport())->setErrorUrl($url)
            ->setException($exception)
            ->setSessionData(\Session::all())
            ->getMessage();

        (new Mailer($report))->send($type);
    }

}
