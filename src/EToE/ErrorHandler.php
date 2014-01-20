<?php

namespace EToE;


class ErrorHandler
{
	protected $errorToExceptionConverter;

	public function __construct(ErrorToExceptionConverter $errorToExceptionConverter = null)
	{
		$this->errorToExceptionConverter = $errorToExceptionConverter;

		if(null === $errorToExceptionConverter) {
			$this->errorToExceptionConverter = new ErrorToExceptionConverter();
		}
	}

	public static function register($enableErrorReporting = true, $catchErrorLevel = null, $displayDisplayErrors = true)
	{
		if(null === $catchErrorLevel) {
			$catchErrorLevel = E_ALL | E_STRICT;
		}
		if($enableErrorReporting) {
			error_reporting($catchErrorLevel);
		}
		if($displayDisplayErrors) {
			ini_set('display_errors', 0);
		}
	    set_error_handler(new static(), $catchErrorLevel);
	}

	public function __invoke($errorNumber, $errorMessage, $originatingFile = null, $originatingFileLine = null, $errorContext = null)
	{
		if(! ($errorNumber & error_reporting())) {
			return;
		}
		$error = new Error($errorNumber, $errorMessage, $originatingFile, $originatingFileLine, $errorContext);
		throw $this->errorToExceptionConverter->convertErrorToException($error);
	}
}

