<?php if (Theme::get('premium')==1):?>
    <?php if (count($providers = Social::enabled_providers()) > 0) :?>
        <ul class="list-inline social-providers">
            <?php foreach ($providers as $key => $provider) :?>     
                <li>
                    <a class="zocial <?php echo strtolower($key) == 'live' ? 'windows' : strtolower($key)?> social-btn" href="<?php echo Route::url('default',array('controller'=>'social','action'=>'login','id'=>strtolower($key)))?>">
                        <?php echo $key?>
                    </a>
                </li>
            <?php endforeach?>
        </ul>
    <?php endif?>
<?php endif?>