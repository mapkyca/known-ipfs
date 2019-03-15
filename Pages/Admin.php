<?php

    /**
     * IPFS pages
     */

    namespace IdnoPlugins\IPFS\Pages {

        /**
         * Default class to serve IPFS settings in administration
         */
        class Admin extends \Idno\Common\Page
        {

            function getContent()
            {
                $this->adminGatekeeper(); // Admins only
                $t = \Idno\Core\site()->template();
                $body = $t->draw('admin/ipfs');
                $t->__(array('title' => 'IPFS', 'body' => $body))->drawPage();
            }

            function postContent() {
                $this->adminGatekeeper(); // Admins only
                $host = $this->getInput('host', 'localhost');
                $port = $this->getInput('port', 8080);
		$apiport = $this->getInput('apiport', 5001);
		$use_cdn = $this->getInput('use_cdn');
		
                \Idno\Core\site()->config->config['IPFS'] = array(
                    'host' => $host,
                    'port' => $port,
		    'apiport' => $apiport,
		    'use_cdn' => $use_cdn
                );
		
                \Idno\Core\site()->config()->save();
                \Idno\Core\site()->session()->addMessage( \Idno\Core\Idno::site()->language()->_('Your IPFS settings were saved.'));
		
                $this->forward(\Idno\Core\site()->config()->getDisplayURL() . 'admin/ipfs/');
            }

        }

    }