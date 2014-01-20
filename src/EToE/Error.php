<?php

namespace EToE;


class Error
{
	protected $errorNumber;
	protected $errorMessage;
	protected $originatingFile;
	protected $originatingFileLine;
	protected $errorContext;

	public function __construct($errorNumber, $errorMessage, $originatingFile = null, $originatingFileLine = null, $errorContext = null)
	{
		$this->errorNumber = $errorNumber;
		$this->errorMessage = $errorMessage;
		$this->originatingFile = $originatingFile;
		$this->originatingFileLine = $originatingFileLine;
		$this->errorContext = $errorContext;
	}

 	public function getErrorNumber()
 	{
 		return $this->errorNumber;
 	}

 	public function getErrorMessage()
 	{
 		return $this->errorMessage;
 	}
 
 	public function getOriginatingFile()
 	{
 		return $this->originatingFile;
 	}
 
 	public function getOriginatingFileLine()
 	{
 		return $this->originatingFileLine;
 	}
 
 	public function getErrorContext()
 	{
 		return $this->errorContext;
 	}
}

