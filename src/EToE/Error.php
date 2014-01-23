<?php

namespace EToE;


interface Error
{
 	function getErrorNumber();
 	function getErrorMessage();
 	function getOriginatingFile();
 	function getOriginatingFileLine();
}

