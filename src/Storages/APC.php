<?php

namespace Materia\Cache\Storages;

/**
 * APC cache storage implementation
 *
 * @package Materia.Cache
 * @author  Filippo Bovo
 * @link    https://lab.alchemica.io/projects/materia/
 **/

use \Materia\Cache\Storage as Storage;

class APC implements Storage {

	protected $_apcu;

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->_apcu = function_exists( 'apcu_fetch' ) ? TRUE : FALSE;

	}

	/**
	 * @see \Materia\Cache\Storage::get()
	 **/
	public function get( string $key ) {

		return $this->_apcu ? apcu_fetch( $key ) : apc_fetch( $key );

	}

	/**
	 * @see \Materia\Cache\Storage::set()
	 **/
	public function set( string $key, string $value, int $ttl = 0 ) : Storage {

		if ( $this->_apcu ) {

			apcu_store( $key, $value, $ttl );

		}
		else {

			apc_store( $key, $value, $ttl );

		}

		return $this;

	}

	/**
	 * @see \Materia\Cache\Storage::delete()
	 */
	public function delete( string $key ) : Storage {

		if ( $this->_apcu ) {

			apcu_delete( $key );

		}
		else {

			apc_delete( $key );

		}

		return $this;

	}

	/**
	 * @see \Materia\Cache\Storage::flush()
	 **/
	public function flush( string $prefix ) : Storage {

		if ( $this->_apcu ) {

			$iterator = new \APCuIterator( '/' . $prefix . ':/', APC_ITER_KEY );

		}
		else {

			$iterator = new \APCIterator( 'user', '/' . $prefix . ':/', APC_ITER_KEY );

		}

		foreach ( $iterator as $item ) {

			if ( $this->_apcu ) {

				apcu_delete( $item['key'] );

			}
			else {

				apc_delete( $item['key'] );

			}

		}

		return $this;

	}

}
