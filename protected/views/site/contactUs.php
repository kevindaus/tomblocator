<div class="shout-box">
    <div class="shout-text">
      <h1>
        <?php echo Yii::app()->params['company_name'] ?>
    </h1>
    </div>
</div>
<br>
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'fade'=>true,
    'closeText'=>'×',
    'alerts'=>array(
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
    ),
)); ?>
      
        <div class="row-fluid">
            <div class="span6">
                <?php echo CHtml::beginForm(array('/contact'), 'POST'); ?>
                    <div class="row-fluid">
                        <?php
                        $this->widget('bootstrap.widgets.TbAlert', array(
                            'fade'=>true,
                            'closeText'=>'×',
                            'alerts'=>array(
                                'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), 
                            ),
                        )); ?>
                    </div>
                	<div class="row-fluid">
                        <div class="span6">
                            <h3>Address</h3>
                            <p>
                            <?php echo Yii::app()->params['street_name'] ?><br />
                            <?php echo Yii::app()->params['province'] ?><br />
                            <?php echo Yii::app()->params['country'] ?><br />
                            <?php echo Yii::app()->params['zipcode'] ?><br />
                            </p>
                        </div>
                        <div class="span6">
                            <h3>Contact details</h3>
                            <p>
                            <?php echo Yii::app()->params['phone_number'] ?><br />
                            <?php echo Yii::app()->params['email_address'] ?><br />

                            </p>
                        </div>
                    </div>
                    <br />
                    <label>Full Name</label>
                    <?php echo CHtml::activeTextField($model, 'name', array('class'=>'span12')); ?>
                    <?php echo CHtml::error($model, 'name'); ?>
                    <label>Email Address</label>
                    <?php echo CHtml::activeTextField($model, 'email', array('class'=>'span12')); ?>
                    <?php echo CHtml::error($model, 'email'); ?>
                    <label>Message</label>
                    <?php echo CHtml::activeTextArea($model, 'body', array('class'=>'span12','style'=>'margin: 0px 0px 9px; height: 154px;')); ?>
                    <?php echo CHtml::error($model, 'body'); ?>
                    <p>
                        <button class="btn btn-primary btn-block" type="submit" style='font-size: 20px;padding: 10px;'>
                            Send
                        </button>
                    </p>
                <?php echo CHtml::endForm(); ?>
            </div>
            <div class="span6">
                <iframe  width="450" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d788.0756652729787!2d121.17913943738874!3d16.512516090217417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDMwJzQ1LjAiTiAxMjHCsDEwJzQ3LjAiRQ!5e1!3m2!1sen!2sph!4v1446432666981" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

        </div>
    </div>