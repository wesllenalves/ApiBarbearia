<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\BusinessException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


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
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if (config('app.env') != 'local') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Origin, Content-type, Accept, Authorization, Local-address');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        }

        $codigo = 500;
        $resposta = [
            'erro' => 'Ocorreu um erro no sistema.',
            'dados' => null,
        ];

        if ($exception instanceof ValidationException) {
            $codigo = 422;
            $resposta = [
                'erro' => 'Os dados fornecidos não são válidos.',
                'dados' => $exception->validator->errors(),
            ];
        }

        if ($exception instanceof BusinessException) {
            $codigo = $exception->getCode();
            $resposta = [
                'erro' => $exception->getMessage(),
            ];
        }

        if ($exception instanceof NotFoundHttpException) {
            $codigo = 404;
            $resposta = [
                'erro' => 'O servidor não encontrou o recurso solicitado.',
            ];
        }

        if (config('app.debug')) {
            $resposta['exception'] = get_class($exception);
            $resposta['message'] = $exception->getMessage();
            $resposta['trace'] = $exception->getTrace();
            $resposta['line'] = $exception->getLine();
            $resposta['file'] = $exception->getFile();
        }

        return response()->json($resposta, $codigo);
    }

    protected function toJson($model)
    {
        $model = (array) $model;
        foreach ($model as $chave => $objeto) {
            if ($objeto instanceof UploadedFile) {
                $model[$chave] = [
                    'tipo' => 'Arquivo Binário',
                    'mime' => $objeto->getMimeType(),
                    'tamanho' => $objeto->getSize(),
                    'nome' => $objeto->getClientOriginalName(),
                ];
            }
        }

        $json = json_encode(array_filter($model));
        preg_replace('@"senha":".*?"@', '"senha":"***"', $json);
        preg_replace('@"password":".*?"@', '"password":"***"', $json);
        preg_replace('@"token":".*?"@', '"token":"***"', $json);
        return $json;
    }
}
