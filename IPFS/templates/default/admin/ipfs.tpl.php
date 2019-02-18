<div class="row">

    <div class="col-md-10 col-md-offset-1">
	            <?=$this->draw('admin/menu')?>
        <h1>IPFS configuration</h1>

    </div>

</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <form action="<?=\Idno\Core\site()->config()->getDisplayURL()?>admin/ipfs/" class="form-horizontal" method="post">
            <div class="controls-group">
                <div class="controls-config">
                    <p>
			<?= \Idno\Core\Idno::site()->language()->_('Configure your IPFS server.'); ?>
		    </p>
                    
                </div>
            </div>
            
            <div class="controls-group">
                <label class="control-label" for="ipfs-server"><?= \Idno\Core\Idno::site()->language()->_('IPFS Server'); ?></label><br>
                
                    <input type="text" id="ipfs-server" placeholder="localhost" class="form-control" name="host" value="<?=htmlspecialchars(\Idno\Core\site()->config()->IPFS['host'])?>" >

                <label class="control-label" for="ipfs-port"><?= \Idno\Core\Idno::site()->language()->_('Port'); ?></label><br>
                
                    <input type="text" id="ipfs-port" placeholder="8080" class="form-control" name="port" value="<?=htmlspecialchars(\Idno\Core\site()->config()->IPFS['port'])?>" >

		<label class="control-label" for="ipfs-api-port"><?= \Idno\Core\Idno::site()->language()->_('API Port (often not used)'); ?></label><br>
                
                    <input type="text" id="ipfs-api-port" placeholder="5001" class="form-control" name="apiport" value="<?=htmlspecialchars(\Idno\Core\site()->config()->IPFS['apiport'])?>" >
            </div>
            
                        
          	<div>

                <div class="controls-save">
                    <button type="submit" class="btn btn-primary"><?= \Idno\Core\Idno::site()->language()->_('Save settings'); ?></button>
                </div>
          	</div>

            <?= \Idno\Core\site()->actions()->signForm('/admin/ipfs/')?>
        </form>
    </div>
</div>
