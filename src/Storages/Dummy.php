<?php

namespace Materia\Cache\Storages;

/**
 * Dummy cache storage implementation
 *
 * @package Materia.Cache
 * @author  Filippo Bovo
 * @link    https://lab.alchemica.io/projects/materia/
 **/

use \Materia\Cache\Storage as Storage;

class Dummy implements Storage {

	/**
	 * @see \Materia\Cache\Storage::get()
	 **/
	public function get( string $key ) {

		return FALSE;

	}

	/**
	 * @see \Materia\Cache\Storage::set()
	 **/
	public function set( string $key, string $value, int $ttl = 0 ) : Storage {

		return $this;

	}

	/**
	 * @see \Materia\Cache\Storage::delete()
	 */
	public function delete( string $key ) : Storage {

		return $this;

	}

	/**
	 * @see \Materia\Cache\Storage::flush()
	 **/
	public function flush( string $prefix ) : Storage {

		return $this;

	}

}
