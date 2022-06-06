	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <img src="img/saglikbak.png" width="50">
		</div>
		<ul class="nav navbar-nav">
		  <li class="active"><a href="kullanicipanel.php">Anasayfa</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		  <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['name'].' ' .$_SESSION['surname']; ?></a></li>
		  <li><a href="kullanicipanel.php?cikisyap=1"><span class="glyphicon glyphicon-off"></span> Çıkış Yap </a></li>
		</ul>
	  </div>
	</nav>	