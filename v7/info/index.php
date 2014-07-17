<!DOCUMENT html>
<html>
<head>
	<title>Info Screen - Infected</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="instafeed.min.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
	<meta charset="UTF-8">
</head>
<body>
	<div id="container">
	<!--Instafeed script. Plz dont steal our client id. -->
		<script type="text/javascript">
		    var feed = new Instafeed({
		        get: 'tagged',
		        tagName: 'infectedlan',
		        clientId: '922e04dec98849259347d27d1704d43a',
		        resolution: 'standard_resolution',
		        limit: '1',
		        sortBy: 'random'
		    });
		</script>
		<script>
			var contentsArray = new Array();
			var contentsTwoArray = new Array();
			var slideAt = 0;
			var slideTwoAt = 0;
			var nextImage = "";
			var imageArray = new Array("BF01", "BF02", "BF03", "BF04", "cod01", "cod02", "cod03", "cod04", "ghost_recon01", "MOH01", "sniper01");
			function preloadImage (url) {
		        try {
		            var _img = new Image();
		            _img.src = url;
		        } catch (e) { }
		    }
			function updatePage() {
				feed.run();
				//Get json for agenda
				$.getJSON("json/getAgenda.php",
          			function(data){
          				$("#agendaContainer").empty();
          				for (var i = 0; i < data.agendas.length; i++) {
          					if(data.agendas[i].isHappening=="1")
          					{
          						$("#agendaContainer").append('<div class="happeningAgenda">' + '<h3>' + data.agendas[i].datetime + '</h3><h1><b>' + data.agendas[i].name + '</b></h1><h4>' + data.agendas[i].description + '</h4></div>');
          					}
          					else
          					{
          						$("#agendaContainer").append('<div class="pendingAgenda">' + '<h3>' + data.agendas[i].datetime + '</h3><h1><b>' + data.agendas[i].name + '</b></h1><h4>' + data.agendas[i].description + '</h4></div>');
          					}
						}
              	});
              	//Get JSON for slides
              	$.getJSON("json/getSlide.php",
          			function(data){
          				contentsArray = new Array();
          				contentsTwoArray = new Array();
          				for (var i = 0; i < data.slides.length; i++) {
          					if(i%2==0)
          					{
          						contentsArray.push("<h1>" + data.slides[i].title + "</h1>" + data.slides[i].content);
          					}
          					else
          					{
          						contentsTwoArray.push("<h1>" + data.slides[i].title + "</h1>" + data.slides[i].content);
          					}
						}
              	});
              	//Load footer
              	$("#footerContainer").load("footer.php");
			}
			function prepareNextImage() {
				var r = Math.floor((Math.random()*(imageArray.length-1))+1);
              	nextImage = "../images/backgrounds/"+ imageArray[r] +".jpg";
              	preloadImage(nextImage);
			}
			function updateImage() {
				//Change background
              	$("html").css('background-image', 'url('+ nextImage +')');
	            prepareNextImage();
			}
			function updateSlide() {
				$("#slideContainer").fadeOut('slow', function(){
					$("#slideContainer").empty();
		            $("#slideContainer").append(contentsArray[slideAt]);
					$("#slideContainer").fadeIn('slow');
		        });  
		        $("#slideContainerTwo").fadeOut('slow', function(){
					$("#slideContainerTwo").empty();
		            $("#slideContainerTwo").append(contentsTwoArray[slideTwoAt]);
					$("#slideContainerTwo").fadeIn('slow');
		        });  
		        var shouldUpdate = false;
				slideAt++;
				if(slideAt==contentsArray.length)
				{
					shouldUpdate = true;
					slideAt=0;
				}
				slideTwoAt++;
				if(slideTwoAt==contentsTwoArray.length)
				{
					shouldUpdate = true;
					slideTwoAt=0;
				}
				if(shouldUpdate)
				{
					updatePage();
				}
			}
			setInterval(function(){
				updateSlide();
			},1000*15);
			setInterval(function(){
				updateImage();
			},1000*5*60);
			prepareNextImage();
			updatePage();
		</script>
		<section id="colRight"> <!-- Skejmamenyen til høyre -->
			<div id="agendaPadding">
				<div id="agendaContainer">
					<i>Laster data...</i>
				</div>
			</div>
		</section>
		<section id="colMid1"> <!-- infoboksen -->
			<div id="slideContainer">
				<i>Laster data...</i>
			</div>
		</section>
		<section id="colMid2"> <!-- infoboksen -->
			<div id="slideContainerTwo">
				<i>Laster data...</i>
			</div>
		</section>
		<!-- Right -->
		<section id="colFoot"> <!-- footerboksen for meny, sponsorlogoer og butikktekst -->
			<img src="images/infected_logo_hvit_medium.png" alt="Infected" height="70%;" style="margin-top:1%;">
			<div id="footerContainer">
				<i>Laster data...</i>
			</div>
		</section>
	</div>
</body>
</html>