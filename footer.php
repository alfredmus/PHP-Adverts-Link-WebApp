
  		<!---</div>
	</div>
</div>
    
  <!----===============FOOTER==================--------->

<div class="navbar navbar-fixed-bottom">
    <div class="container">
        <p class="navbar-text pull-left">Powered by spacecom  <?php echo date("M-Y"); ?> </p>
        <div class="pull-right">
            <a class="navbar-btn btn-primary btn">Follow us on Facebook</a>
        </div>
    </div>
</div>

<script src="js/bootstrap.js"></script>

</body>
</html>
<!----===============CLOSE DATABASE CONNECTION==================--------->
<?php 
	if(isset($connection)){
	mysql_close($connection);
	}
?>
