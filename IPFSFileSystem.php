<?php

namespace IdnoPlugins\IPFS {

    require_once(dirname(__FILE__) . '/vendor/autoload.php');

    use Cloutier\PhpIpfsApi\IPFS;

    class IPFSFileSystem extends \Idno\Files\FileSystem {

	private static $client;

	/**
	 * Find a file by its id
	 * @param type $_id
	 * @return \IdnoPlugins\IPFS\IPFSFile
	 * @throws \RuntimeException
	 */
	public function findOne($_id) {
	    
	    $client = self::client();
	    
	    try {
		if (is_array($_id) && !empty($_id['_id']))
		    $_id = $_id['_id'];
				
		
		// Load metadata
		$metadata = json_decode($client->cat($_id), true);
		if (empty($metadata))
		    throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_ ('Could not find the id %s', [$_id]));

		// Construct file
		$file = new IPFSFile();
		$file->_id = $_id;
		$file->_ipfs_file_id = $metadata['_ipfs_file_id'];
		$file->metadata = $metadata;
		
		// Compatibility with LocalFileSystem and Mongo
		$file->file = $metadata;
		$file->file['_id'] = $_id;
		$file->file['length'] = $metadata['length'];

		return $file;
	    } catch (\Exception $e) {
		\Idno\Core\Idno::site()->logging()->error($e->getMessage());
	    }
	    
	    return false;
	}

	public function storeFile($file_path, $metadata, $options = []) {

	    if (file_exists($file_path)) {
		
		$client = self::client();
		
		// Store actual data (TODO: Upload direct from file)
		$file_id = $client->add( file_get_contents($file_path) );				
		
		if (empty($file_id))
		    throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_ ('There was a problem writing the file contents of "%s", is the server up?', [$file_path]));
		
		// Add id to metadata
		$metadata['_ipfs_file_id'] = $file_id;
		
		// Store the file size
		$metadata['length'] = filesize($file_path);
		
		// Store metadata and get ID
		$id = $client->add( json_encode($metadata) );
		
		if (empty($id))
		    throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_ ('There was a problem writing metadata to IPFS'));
		
		return $id;
	    } else {
		throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_ ('File %s doesn\'t exist', [$file_path]));
	    }
	    
	    return false;
	}
	
	public static function getConfig() {
	    $config = \Idno\Core\Idno::site()->config();

	    if (empty($config->IPFS)) {
		$config->IPFS = [
		    'host' => 'localhost',
		    'port' => 8080,
		    'apiport' => 5001,
		    'use_cdn' => false
		];
	    }
	    
	    return $config;
	}

	/**
	 * Get a new IPFS client, used internally
	 * 
	 * @return \Cloutier\PhpIpfsApi\IPFS
	 */
	public static function client() {

	    $config = self::getConfig();

	    if (empty(self::$client))
		self::$client = new IPFS($config->IPFS['host'], $config->IPFS['port'], $config->IPFS['apiport']);

	    return self::$client;
	}

	/**
	 * Store content from memory
	 * @param type $content
	 * @param type $metadata
	 * @param type $options
	 * @return boolean
	 * @throws \RuntimeException
	 */
	public function storeContent($content, $metadata, $options = array()) {
	    if (!empty($content)) {
		
		$client = self::client();
		
		// Store actual data
		$file_id = $client->add($content);				
		
		if (empty($file_id))
		    throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_ ('There was a problem writing the file contents (%d bytes), is the server up?', [strlen($content)]));
		
		// Add id to metadata
		$metadata['_ipfs_file_id'] = $file_id;
		
		// Store the file size
		$metadata['length'] = strlen($content);
		
		// Store metadata and get ID
		$id = $client->add( json_encode($metadata) );
		
		if (empty($id))
		    throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_ ('There was a problem writing metadata to IPFS'));
		
		return $id;
	    } else {
		throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_ ('You\'re trying to store empty content'));
	    }
	    
	    return false;
	}

    }

}