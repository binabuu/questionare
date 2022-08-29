<div  class="w3-container w3-teal w3-top" style="	height: 30px;" >
  <div class="w3-container w3-left ">
  <div class="w3-container" id="name">PIMS</div>
  </div>
   <div class="w3-container w3-right w3-green w3-border">
    <?php Session::init();
		$fn = Session::get('fn');
   echo $fn;
   ?>
  </div>
 
</div>
