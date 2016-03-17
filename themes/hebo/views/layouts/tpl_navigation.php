<?php $baseUrl = Yii::app()->theme->baseUrl;  ?>
<section id="navigation-main">  
<div class="navbar">
	<div class="navbar-inner">

    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a href="<?php echo $this->createUrl("/") ?>" class="brand">
            <?php echo CHtml::image($baseUrl.'/images/LOGO.png', 'logo', array('style'=>'height: 97px;')); ?>        
          </a>
          <div class="nav-collapse">
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'nav','style'=>"margin-top: 31px;"),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'<span class=" icon-home "></span> Home', 'url'=>array('/home'),'linkOptions'=>array("data-description"=>"Home page")),
                        array('label'=>'Manage Tomb<span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>'Manage Tomb Records'), 
                            'items'=>array(
                                array('label'=>'Move to bone box', 'url'=>array('/slot/move'),'linkOptions'=>array("data-description"=>"Replace tomb resident"),'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Register Tomb Slot', 'url'=>array('/slot/register'),'linkOptions'=>array("data-description"=>"Register tomb information"),'visible'=>!Yii::app()->user->isGuest),
                            ),
                            'visible'=>!Yii::app()->user->isGuest
                        ),
                        array('label'=>'<span class=" icon-flag"></span> Available',  'visible'=>Yii::app()->user->isGuest,'url'=>array('/slot/available'),'linkOptions'=>array("data-description"=>"Search available tomb")),
                        array('label'=>'Manage Available', 'url'=>array('/slot/addAvailable'), 'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"Register available slot")),
                        array('label'=>'Bonebox', 'url'=>array('/bonebox/admin'), 'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"Manage bonebox")),
                        array('label'=>'<span class="icon-user"></span> Person', 'url'=>array('/person/admin'),'linkOptions'=>array("data-description"=>"Manage person records"),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'<span class=" icon-search"></span> Search', 'url'=>array('/slot/search'),'linkOptions'=>array("data-description"=>"Search tomb")),
                        array('label'=>'<span class=" icon-picture"></span> Gallery','visible'=>Yii::app()->user->isGuest ,'url'=>array('/gallery'),'linkOptions'=>array("data-description"=>"Image gallery")),
                        array('label'=>'<span class=" icon-envelope"></span> Contact Us','visible'=>Yii::app()->user->isGuest, 'url'=>array('/contact'),'linkOptions'=>array("data-description"=>"Talk to us")),
                        array('label'=>'Login', 'url'=>array('/login'), 'visible'=>Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"Admin area")),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/logout'), 'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"Logout to site")),
                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>
</section><!-- /#navigation-main -->