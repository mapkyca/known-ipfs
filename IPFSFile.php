<?php

namespace IdnoPlugins\IPFS {

    require_once(dirname(__FILE__) . '/vendor/autoload.php');

    class IPFSFile extends \Idno\Files\File implements \Idno\Files\CDNStorable {

	protected function getURL() {
	    $config = IPFSFileSystem::getConfig();
	    
	    return "http://{$config->IPFS['host']}:{$config->IPFS['port']}/ipfs/" . $this->metadata['_ipfs_file_id'];
	}
	
	public function delete() {
	    // TODO... somehow
	}

	public function getBytes() {
	    
	    $contents = '';
            $handle = $this->getResource();
            while (!feof($handle)) {
                $contents .= fread($handle, 8192);
            }
            fclose($handle);

            return $contents;
	}

	public function getFilename() {
	    if (!empty($this->metadata['filename'])) {
		return $this->metadata['filename'];
	    }

	    return false;
	}

	public function getResource() {
	    $config = IPFSFileSystem::getConfig();
	    
	    return fopen($this->getURL(), 'r');
	}

	public function getSize() {
	    $client = IPFSFileSystem::client();
	    
	    return $client->size($this->metadata['_ipfs_file_id']);
	}

	public function passThroughBytes() {
	    $config = IPFSFileSystem::getConfig();
	    
	    if ($file_handle = $this->getResource()) { 
		
		if (!empty($this->metadata['mime_type'])) header("Content-Type: " . $this->metadata['mime_type'] );
		if (!empty($this->metadata['length'])) header("Content-Length: " . $this->metadata['length'] );
		header("X-Known-IPFS-Meta: " . $this->_id);
		header("X-Known-IPFS-Data: " . $this->metadata['_ipfs_file_id']);
		
		ob_end_flush();
		fpassthru($file_handle);
		fclose($file_handle);
	    }
	}

	public function write($path) {
	    try {
                if ($out = fopen($path, 'wb')) {
                    fwrite($out, $this->getBytes());

                    fclose($out);

                    return true;
                }
            } catch (\Exception $e) {
                \Idno\Core\site()->logging()->debug($e->getMessage());
            }

            return false;
	}

	public function getCDNStoredURL() {
	    return $this->getURL();
	}

    }

}
