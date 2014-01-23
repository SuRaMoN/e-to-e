<?php

namespace EToE;

use EToE\Exception\DivisionByZeroException;
use EToE\Exception\ErrorException;
use EToE\Exception\IOException\FileSystemException\FileAlreadyExistsException;
use EToE\Exception\IOException\FileSystemException\FileNotFoundException;
use EToE\Exception\UndefinedConstantException;
use EToE\Exception\UndefinedIndexException;
use EToE\Exception\UndefinedPropertyException;
use EToE\Exception\UndefinedVariableException;
use EToE\StringUtil;


class ErrorToExceptionConverter
{
	public function __construct()
	{
	}

	public function convertErrorToException(Error $error)
	{
		switch(true) {
			case StringUtil::startsWith($error->getErrorMessage(), 'Undefined variable: '):
				return new UndefinedVariableException($error);

			case StringUtil::startsWith($error->getErrorMessage(), 'Undefined index: '):
				return new UndefinedIndexException($error);

			case StringUtil::startsWith($error->getErrorMessage(), 'Undefined property: '):
				return new UndefinedPropertyException($error);

			case StringUtil::endsWith($error->getErrorMessage(), ': File exists'):
				return new FileAlreadyExistsException($error);

			case StringUtil::endsWith($error->getErrorMessage(), 'failed to open stream: No such file or directory'):
				return new FileNotFoundException($error);

			case $error->getErrorMessage() == 'Division by zero':
				return new DivisionByZeroException($error);

			case StringUtil::startsWith($error->getErrorMessage(), 'Use of undefined constant '):
				return new UndefinedConstantException($error);
		}
		return new ErrorException($error);
	}
}
 
