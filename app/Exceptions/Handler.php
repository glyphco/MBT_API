<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler {
	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		AuthorizationException::class,
		HttpException::class,
		ModelNotFoundException::class,
		ValidationException::class,
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e) {
		parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e) {
		if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
			$response = [
				'code'    => 403,
				'status'  => 'error',
				'data'    => 'Token Is Expired (Code#exception12)',
				'message' => 'Unprocessable entity',
			];
			return response()->json($response, $response['code']);
		}

		if ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
			$response = [
				'code'    => 401,
				'status'  => 'error',
				'data'    => 'Token Is Invalid (Code#exception22)',
				'message' => 'Unprocessable entity',
			];
			return response()->json($response, $response['code']);
		}

		if ($e instanceof \Symfony\Component\HttpKernel\Exception\BadRequestHttpException) {
			if ($e->getMessage() == 'Token not provided') {
				$message  = $e->getMessage();
				$response = [
					'code'    => 401,
					'status'  => 'error',
					'data'    => 'Token Not Provided (Code#exception32)',
					'message' => $message,
				];
				return response()->json($response, $response['code']);
			}
		}

		if ($e instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
			$message  = $e->getMessage();
			$response = [
				'code'    => 401,
				'status'  => 'error',
				'data'    => 'Must supply a valid token (Code#exception32)',
				'message' => $message,
			];
			return response()->json($response, $response['code']);
		}

		return parent::render($request, $e);
	}
}
