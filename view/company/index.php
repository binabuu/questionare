<html>
<?php 
include 'view/head.php';
?>

<body>
<?php 
include 'view/header.php';
?>
<div class="w3-container w3-white" id="topBody">
<?php 
include 'view/nav.php';
?>
<div class="w3-container" style="margin-left:160px">
</p>
<div class="w3-responsive">
	<table class="w3-table-all">
	<tr><th>OCHU FAMILY FARM</th><th></th></tr>
	<tr><td><b>THAMANI YA BIDHAA ZILOBAKI</b></td><td><b><?php echo number_format($this->stock['stock'])?></b></td></tr>
	<tr><td><b>MAUZO YA LEO</b></td><td><b><?php echo number_format($this->mauzo['mauzo'])?></b></td></tr>
	<tr><td><b>MADENI TUNAYODAI</b></td><td><b><?php echo number_format($this->tunayodai)?></b></td></tr>
	<tr><td><b>MADENI TUNAYODAIWA</b></td><td><b><?php echo number_format($this->tunayodaiwa)?></b></td></tr>
	</table>
	</div>
 </div> 
 </div> 

</body>

</html>
