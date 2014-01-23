<?php

namespace EToE;


class ErrorHandler
{
	protected $errorToExceptionConverter;
	protected $exceptionHandlerCallback;

	public function __construct(ErrorToExceptionConverter $errorToExceptionConverter = null)
	{
		$this->errorToExceptionConverter = $errorToExceptionConverter;

		if(null === $errorToExceptionConverter) {
			$this->errorToExceptionConverter = new ErrorToExceptionConverter();
		}
	}

	public function registerForNonFatalErrors($enableErrorReporting = true, $catchErrorLevel = null, $dontDisplayErrors = true)
	{
		if(null === $catchErrorLevel) {
			$catchErrorLevel = E_ALL | E_STRICT;
		}
		if($enableErrorReporting) {
			error_reporting($catchErrorLevel);
		}
		if($dontDisplayErrors) {
			ini_set('display_errors', 0);
		}
	    set_error_handler(array($this, 'catchError'), $catchErrorLevel);
	}

	public function registerForFatalErrors($exceptionHandlerCallback)
	{
		$this->exceptionHandlerCallback = $exceptionHandlerCallback;
		register_shutdown_function(array($this, 'catchFatalError'));
	}

	public static function register($exceptionHandlerCallback = null, $enableErrorReporting = true, $catchErrorLevel = null, $displayErrors = true)
	{
		$errorHandler = new static();
		$errorHandler->registerForNonFatalErrors($enableErrorReporting, $catchErrorLevel, $displayErrors);
		if(null !== $exceptionHandlerCallback) {
			$errorHandler->registerForFatalErrors($exceptionHandlerCallback);
		}
	}

	public function catchFatalError()
	{
		$error = error_get_last();
		$fatalErrorMask = E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR;
		if(null === $error || ($error['type'] & $fatalErrorMask) == 0) {
			return;
		}
		ini_set('display_errors', 1);
		$error = new FatalError($error['type'], $error['message'], $error['file'], $error['line']);
		call_user_func($this->exceptionHandlerCallback, $this->errorToExceptionConverter->convertErrorToException($error));
	}

	public function catchError($errorNumber, $errorMessage, $originatingFile = null, $originatingFileLine = null, $errorContext = null)
	{
		if(! ($errorNumber & error_reporting())) {
			return;
		}
		$error = new NonFatalError($errorNumber, $errorMessage, $originatingFile, $originatingFileLine, $errorContext);
		throw $this->errorToExceptionConverter->convertErrorToException($error);
	}
}

