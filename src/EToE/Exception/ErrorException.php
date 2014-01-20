<?php

namespace EToE\Exception;

use EToE\Error;


class ErrorException extends \ErrorException
{
	public function __construct(Error $error)
	{
		parent::__construct($error->getErrorMessage(), 0, $error->getErrorNumber(),
			$error->getOriginatingFile(), $error->getOriginatingFileLine());
	}
}

