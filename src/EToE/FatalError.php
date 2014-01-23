<?php

namespace EToE;


class FatalError implements Error
{
	protected $errorNumber;
	protected $errorMessage;
	protected $originatingFile;
	protected $originatingFileLine;

	public function __construct($errorNumber, $errorMessage, $originatingFile = null, $originatingFileLine = null)
	{
		$this->errorNumber = $errorNumber;
		$this->errorMessage = $errorMessage;
		$this->originatingFile = $originatingFile;
		$this->originatingFileLine = $originatingFileLine;
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
}

