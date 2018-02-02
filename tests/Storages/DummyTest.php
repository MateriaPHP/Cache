<?php

namespace Materia\Cache\Storages;

/**
 * Test dummy caching class
 *
 * @package Materia.Cache
 * @author  Filippo Bovo
 * @link    https://lab.alchemica.io/projects/materia/
 **/

class DummyTest extends \PHPUnit\Framework\TestCase {

	protected $_storage;

	/**
	 * @see	\PHPUnit_Framework_TestCase::setUp()
	 **/
	public function setUp() {

		// Setting up the cache
		$this->_storage = new \Materia\Cache\Storages\Dummy();

	}

	/**
	 * @see	\PHPUnit_Framework_TestCase::tearDown()
	 **/
	public function tearDown() {}

	/**
	 * Test caching
	 **/
	public function testCaching() {

		$this->_storage->set( 'test', 'test' );

		// Dummy cache storage always returns NULL
		$this->assertEquals( NULL, $this->_storage->get( 'test' ) );

	}

}
