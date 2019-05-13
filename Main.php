<?php

namespace IdnoPlugins\IPFS {
    
    class Main extends \Idno\Common\Plugin
    {

        function registerPages()
        {
	    // Register admin settings
	    \Idno\Core\site()->addPageHandler('admin/ipfs', '\IdnoPlugins\IPFS\Pages\Admin');

	    // Add menu items to account & administration screens
	    \Idno\Core\site()->template()->extendTemplate('admin/menu/items', 'admin/ipfs/menu');
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
	    
	    $config = IPFSFileSystem::getConfig();

	    if ($config->IPFS['use_cdn'] == 'Yes') { 
		// Override the image proxy
		\Idno\Core\Idno::site()->addPageHandler('/service/web/imageproxy/([^\/]+)/?', '\IdnoPlugins\IPFS\Pages\Service\ImageProxy', true);
		\Idno\Core\Idno::site()->addPageHandler('/service/web/imageproxy/([^\/]+)/([0-9]+)/?', '\IdnoPlugins\IPFS\Pages\Service\ImageProxy', true); // With scale
		\Idno\Core\Idno::site()->addPageHandler('/service/web/imageproxy/([^\/]+)/([0-9]+)/([^\/]+)/?', '\IdnoPlugins\IPFS\Pages\Service\ImageProxy', true); // With scale, with transform
	    }
	}

    }

}
