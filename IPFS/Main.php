<?php

namespace IdnoPlugins\IPFS {
    
    class Main extends \Idno\Common\Plugin
    {

        function registerPages()
        {
	    
        }

        function registerTranslations()
        {

            \Idno\Core\Idno::site()->language()->register(
                new \Idno\Core\GetTextTranslation(
                    'ipfs', dirname(__FILE__) . '/languages/'
                )
            );
        }
	
	function registerEventHooks() {
	    
	    \Idno\Core\site()->filesystem = new \IdnoPlugins\IPFS\IPFSFileSystem();

	}

    }

}
