<!-- End of main content -->
<footer>
	<hr>
	<p class="text-center">
		Site Navigation: 
		<a href="index.php">Home</a> |
		<a href="sell.php">Sell</a> |
		<a href="about.php">About</a> |
		<a href="help.php">Help</a> |
		<a href="help.php#contact">Contact Us</a>
		<?php
		if(!empty($_SESSION['logged_in'])) {
			echo " | <a href='account.php'>My Account</a>";
			if($_SESSION['user']->getAdmin()) {
				echo " | <a href='admin.php'>Admin Panel</a>";
			}
		}
		?>
	</p>
	<p class="text-center"><?php echo date('Y'); ?> &copy; SwiftThrift</p>
</footer>

</div>
<!--END OF FROM HEADER.php CONTAINTER-->

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-50552628-1', 'sfsuswe.com');
	ga('send', 'pageview');

</script>

</body>
</html>
