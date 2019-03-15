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
		
		<div class="row">
		    <div class="col-md-2">
			<p>
			    <label class="control-label" for="ipfs-server"><?= \Idno\Core\Idno::site()->language()->_('IPFS Server'); ?></label>
			</p>
		    </div>
		    <div class="col-md-4">
			<input type="text" id="ipfs-server" placeholder="localhost" class="form-control" name="host" value="<?=htmlspecialchars(\Idno\Core\site()->config()->IPFS['host'])?>" >
		    </div>
		    <div class="col-md-6">
		    </div>
		</div>

                <div class="row">
		    <div class="col-md-2">
			<p>
			    <label class="control-label" for="ipfs-port"><?= \Idno\Core\Idno::site()->language()->_('Port'); ?></label>
			</p>
		    </div>
                
		    <div class="col-md-4">
			<input type="text" id="ipfs-port" placeholder="8080" class="form-control" name="port" value="<?=htmlspecialchars(\Idno\Core\site()->config()->IPFS['port'])?>" >
		    </div>
		    <div class="col-md-6">
		    </div>
		</div>

		<div class="row">
		    <div class="col-md-2">
			<p><label class="control-label" for="ipfs-api-port"><?= \Idno\Core\Idno::site()->language()->_('API Port'); ?></label></p>
		    </div>
                
		    <div class="col-md-4">
                
			<input type="text" id="ipfs-api-port" placeholder="5001" class="form-control" name="apiport" value="<?=htmlspecialchars(\Idno\Core\site()->config()->IPFS['apiport'])?>" >
		    </div>
		    <div class="col-md-6">
		    </div>
		</div>
		
		<div class="row">
		    <div class="col-md-2">
			<p><label class="control-label" for="single_user"><?= \Idno\Core\Idno::site()->language()->_('Use server as CDN'); ?></label>
			</p>
		    </div>
		    <div class="config-toggle col-md-4">
			<input type="checkbox" id="ipfs-api-port" data-toggle="toggle" data-onstyle="info" data-on="Yes" data-off="No"
                           value="Yes" class="form-control" name="use_cdn" <?= \Idno\Core\site()->config()->IPFS['use_cdn'] ? 'checked' : '' ?> >
		    </div>
		    <div class="col-md-6"><p class="config-desc">
			    <?php echo \Idno\Core\Idno::site()->language()->_('IPFS can be used to proxy images. For this to work, you need to be using a public server'); ?>
			</p>
		    </div>

		</div>
		    
		<label class="control-label" for="ipfs-api-port"></label><br>
                
                    
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
