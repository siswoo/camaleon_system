<!DOCTYPE html>
<html>
<head>
	<title>Estupides</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<style type="text/css">
	.counter{
  		text-align: center;
  		font-size: 100px;
	}
</style>


<div id="holaputo1">Holis!</div>
<div id="holaputo2" style="margin-top: 1200px;" class="counter">0</div>

</body>
</html>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
<script src="resources/waypoints/src/waypoint.js"></script>

<script type="text/javascript">

	function count(){
  	var counter = { var: 0 };
  	TweenMax.to(counter, 3, {
    	var: 20, 
    	onUpdate: function () {
      		var number = Math.ceil(counter.var);
      		$('.counter').html(number);
      		if(number === counter.var){ 
      			count.kill(); 
      		}
      		//return false;
    	},
    
    	onComplete: function(){
      		count();
    	},    
    	
    	ease:Circ.easeOut
  	});
}
	count();


	const waypoints = [{
	    id: 'holaputo1',
		handler(direction) { console.log('About'); }
	},
	{
		id: 'holaputo2',
		handler(direction) { console.log('Contact'); }
	}];

	var waypoint = new Waypoint({
	  element: document.getElementById('holaputo2'),
	  handler: function(direction) {
	    console.log('Scrolled to waypoint!')
	  }
	})
</script>