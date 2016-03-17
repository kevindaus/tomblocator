
<footer>
    <div class="footer">
        <div class="container">
            <?php echo CHtml::link('History', array('/history')); ?> | 
            <?php echo CHtml::link('Services', array('/services')); ?> | 
            <?php echo CHtml::link('Organizational Chart', array('/organizationalChart')); ?>  |
            <?php echo CHtml::link('Terms of Use', array('/terms')); ?> | 
            <?php echo CHtml::link('Privacy Policy', array('/privacy')); ?> <br>
        	Copyright &copy; <?php echo date("Y") ?>. <?php echo Yii::app()->name ?>
        </div>
	</div>
</footer>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap-collapse.js"></script>
    
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap-transition.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap-carousel.js"></script>
  </body>
</html>