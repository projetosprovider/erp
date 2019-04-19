<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $userLevelCheck = $exception instanceof \jeremykenedy\LaravelRoles\Exceptions\RoleDeniedException ||
              $exception instanceof \jeremykenedy\LaravelRoles\Exceptions\RoleDeniedException ||
              $exception instanceof \jeremykenedy\LaravelRoles\Exceptions\PermissionDeniedException ||
              $exception instanceof \jeremykenedy\LaravelRoles\Exceptions\LevelDeniedException;

          if ($userLevelCheck) {

              if ($request->expectsJson()) {
                  return Response::json(array(
                      'error'    =>  403,
                      'message'   =>  'Unauthorized.'
                  ), 403);
              }

              abort(403);
          }

        if($exception instanceof ModelNotFoundException) {

            $error['code'] = 500;
            $error['message'] = 'Erro interno no servidor.';

            return response()->view('errors.custom', $error, $error['code']);
        }

        if($exception instanceof HttpException && $exception->getStatusCode() == 403) {

            $error = [
              'code' => 403,
              'message' => 'Você NÃO tem permissão para acessar esta área do sitema!.'
            ];

            return response()->view('errors.custom', $error, $error['code']);
        }

        if($exception instanceof NotFoundHttpException) {

            $error = [
              'code' => 404,
              'message' => 'Página não encontrada.'
            ];

            return response()->view('errors.custom', $error, $error['code']);
        }

        return parent::render($request, $exception);
    }
}
