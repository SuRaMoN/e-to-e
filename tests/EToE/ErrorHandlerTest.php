<?php

namespace EToE;

use PHPUnit_Framework_TestCase;


class ErrorHandlerTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function testDontThrow()
	{
		ErrorHandler::register();
		error_reporting(0);
		strlen($a);
	}

	/**
	 * @test
	 * @expectedException EToE\Exception\UndefinedVariableException
	 */
	public function testThrowsUndefinedVariableException()
	{
		ErrorHandler::register();
		strlen($a);
	}

	/**
	 * @test
	 * @expectedException EToE\Exception\UndefinedIndexException
	 */
	public function testThrowsUndefinedIndexException()
	{
		ErrorHandler::register();
		$a = array();
		strlen($a['jos']);
	}

	/**
	 * @test
	 * @expectedException EToE\Exception\UndefinedPropertyException
	 */
	public function testThrowsUndefinedPropertyException()
	{
		ErrorHandler::register();
		$a = new \stdClass();
		strlen($a->jos);
	}

	/**
	 * @test
	 * @expectedException EToE\Exception\IOException\FileSystemException\FileAlreadyExistsException
	 */
	public function testThrowsFileAlreadyExistsException()
	{
		ErrorHandler::register();
		mkdir(sys_get_temp_dir());
	}

	/**
	 * @test
	 * @expectedException EToE\Exception\IOException\FileSystemException\FileNotFoundException
	 */
	public function testThrowsFileNotFoundException()
	{
		ErrorHandler::register();
		file_get_contents(__DIR__ . '/i-am-not-here');
	}

	/**
	 * @test
	 * @expectedException EToE\Exception\DivisionByZeroException
	 */
	public function testThrowsDivisionByZeroException()
	{
		ErrorHandler::register();
		1/0;
	}
}

