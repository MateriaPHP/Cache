<?php

namespace Materia\Cache;

/**
 * Cache storage interface
 *
 * @package	Materia.Cache
 * @author	Filippo Bovo
 * @link	https://lab.alchemica.io/projects/materia/
 **/

interface Storage {

	/**
	 * Get an item from the cache
	 *
	 * @param   string  $key
	 * @return  mixed
	 **/
	public function get( string $key );

	/**
	 * Store an item in the cache
	 *
	 * @param	string	$key	final keys
	 * @param	string	$value	serialized values
	 * @param	int		$ttl	in seconds
	 * @return	self
	 **/
	public function set( string $key, string $value, int $ttl = 0 ) : self;

	/**
	 * Remove an item from the cache
	 *
	 * @param	string	$key
	 * @return	self
	 **/
	public function delete( string $key ) : self;

	/**
	 * Remove all items from the cache
	 *
	 * @param	string	$prefix
	 * @return	self
	 **/
	public function flush( string $prefix ) : self;

}
