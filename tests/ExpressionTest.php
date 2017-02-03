<?php

// require "./vendor/autoload.php";
use PHPUnit\Framework\TestCase;

class ExpressionTest extends TestCase
{
	/** @test */
	public function it_finds_a_string() 
	{
		$regex = Expression::make()->find('www');
		$this->assertTrue($regex->test('www'));

		$regex = Expression::make()->then('www');
		$this->assertTrue($regex->test('www'));
	}

	/** @test */
	public function it_checks_for_anything()
	{
		$regex = Expression::make()->anyThing();
		
		$this->assertTrue($regex->test('foo'));
	}

	/** @test */
	public function it_may_be_has_a_value()
	{
		$regex = Expression::make()->maybe('http');
		$this->assertTrue($regex->test('http'));
		$this->assertTrue($regex->test(''));
	}

	/** @test */
	public function it_can_chain_method_calls()
	{
		$regex = Expression::make()->find('www')->maybe('.')->then('laracast');

		$this->assertTrue($regex->test('www.laracast'));
		$this->assertFalse($regex->test('wwwxlaracast'));
	}

	/** @test */
	public function it_exclude_values()
	{
		$regex = Expression::make()
				->find('foo')
				->anyThingBut('bar')
				->then('biz');

		$this->assertTrue($regex->test('foobiz'));
		$this->assertFalse($regex->test('foobarbiz'));		
	}
}	