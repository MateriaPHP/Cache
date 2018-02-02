<?php

namespace Materia\Cache\Storages;

/**
 * Filesystem cache storage implementation
 *
 * @package Materia.Cache
 * @author  Filippo Bovo
 * @link    https://lab.alchemica.io/projects/materia/
 **/

use \Materia\Cache\Storage as Storage;

class Filesystem implements Storage {

	protected $_dir;

	/**
	 * Constructor
	 **/
	public function __construct() {

		$this->_dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'MFSCache';

		// If not exist, create the folder
		if ( !is_dir( $this->_dir ) ) {

			mkdir( $this->_dir );

		}

	}

	/**
	 * @see \Materia\Cache\Storage::get()
	 **/
	public function get( string $key ) {

		$file = $this->_dir . DIRECTORY_SEPARATOR . $key;

		if ( file_exists( $file ) ) {

			include $file;

		}

	}

	/**
	 * @see \Materia\Cache\Storage::set()
	 **/
	public function set( string $key, string $value, int $ttl = 0 ) : Storage {
		// $value	 =	var_export( $value, TRUE );
		// HHVM fails at __set_state, so just use object cast for now
		// $value	 =	str_replace( 'stdClass::__set_state', '(object)', $value );
		// Write to temp file first to ensure atomicity
		$tmp = tempnam( $this->_dir, '' );

		file_put_contents( $tmp, '<' . '?php if ( time() > ' . ( time() + $ttl ) . ' ) return NULL else return ' . $value . ';', LOCK_EX );

		// Delete previous
		$this->detete( $key );

		rename( $tmp, $this->_dir . DIRECTORY_SEPARATOR . $key );

		return $this;

	}

	/**
	 * @see \Materia\Cache\Storage::delete()
	 */
	public function delete( string $key ) : Storage {

		$file = $this->_dir . DIRECTORY_SEPARATOR . $key;

		if ( file_exists( $file ) ) {

			unlink( $file );

		}

		return $this;

	}

	/**
	 * @see \Materia\Cache\Storage::flush()
	 **/
	public function flush( string $prefix ) : Storage {

		return $this;

	}

}
