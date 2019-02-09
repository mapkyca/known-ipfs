<?php


namespace IdnoPlugins\IPFS\Tests {

    class IPFSTest extends \Tests\KnownTestCase
    {
	static $id;
	
	public function testWrite() {
	    
	    
	    $filestore = new \IdnoPlugins\IPFS\IPFSFileSystem();
	    
	    $result = $filestore->storeFile(dirname(__FILE__) . '/DSC_0601.JPG', [

		'filename'  => 'DSC_0601.JPG',
		'mime_type' => 'image/jpeg'
	    ]);
	    
	    $this->assertTrue(!empty($result));
	    
	    self::$id = $result;
	}
	
	public function testRead() {
	    
	    $orig_contents = file_get_contents(dirname(__FILE__) . '/DSC_0601.JPG');
	    
	    
	    $filestore = new \IdnoPlugins\IPFS\IPFSFileSystem();
	    
	    $file = $filestore->findOne(self::$id);
	    
	    $this->assertNotEmpty($file);
	    
	    $this->assertEquals($orig_contents, $file->getBytes());
	    
	}
	
    }
}