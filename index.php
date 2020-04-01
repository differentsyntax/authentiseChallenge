<html> 
<head> 
	
	<meta charset="UTF-8">
	<title>Dog Breeds</title> 
	<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
	<link rel = "stylesheet" type = "text/css" href="Style.css" />
	
</head> 
 
<body>

<div id="container" >
 
	<h1>Doggos Don't Catch No Virus!</h1> 

	<form id="searchform" method="post"> 
	<div> 
        <label for="search_term">Search breed</label> 
        <input type="text" name="search_term" id="search" value = "hound-english" /> 
        <button type="submit" id="picButton" >See Picture!</button>
        <button type="submit" id="randPicButton" >Random Breed!</button>
        
        <br><br>

        <div id="search_pic">
        	<img src="https://images.dog.ceo/breeds/hound-english/n02089973_1030.jpg" />
        </div>

        <br><br>

        <div id="buttons">

			<button type="button" id="searchButton" >Add to Collection</button>
			<button type="button" id="removeButton" >Remove From Collection</button>
			<button type=button id="randomButton">Add Random Breed</button>

		</div>

	</div> 
	</form> 
</div>

	<script>
	$(document).ready(function(){ 
	$("#picButton").click(function(e){ 
        e.preventDefault(); 
        picture();
    });
    $("#randPicButton").click(function(e){ 
        e.preventDefault(); 
        randPicture();
    });
	$("#searchButton").click(function(e){ 
        e.preventDefault(); 
        search();
    });
    $("#removeButton").click(function(e){ 
        e.preventDefault(); 
        remove();
    });
    $("#randomButton").click(function(e){ 
        e.preventDefault(); 
        random();
    });
	});

	function picture(){

		var name = $("#search").val();

		$.ajax({
	    url: "https://dog.ceo/api/breed/" + name + "/images",
	    type: "GET",
	    dataType: 'json',
	    cache: false,
	    success: function (response) {
	        $("#search_pic").html("<img src=" + response.message[0] + " />");
	    }
	  });
	}

	function randPicture(){
	  $.ajax({
	    url: "https://dog.ceo/api/breeds/image/random",
	    type: "GET",
	    dataType: 'json',
	    success: function (response) {

	    	var url = response.message;
	    	var name = url.replace("https://images.dog.ceo/breeds/", "");
	    	name = name.substring(0, name.indexOf("/"));
	    	$("#search").val(name);
	    	$("#search_pic").html("<img src=" + url + " />");
	    }
	  });
	}

	function search(){

		var name = $("#search").val();

		$.ajax({
	    url: "https://dog.ceo/api/breed/" + name + "images",
	    type: "GET",
	    dataType: 'json',
	    success: function (response) {
	        search_add(name, response.message[0]);
	    }
	  });	
	}

	function search_add(name, url){
		$.ajax({
	    url: "add",
	    type: "POST",
	    data: {'name':name, 'picture_url': url},
	    dataType: 'json',
	    success: function (response) {
	    	if(response=="True"){
	        alert(name + "has been added to the collection");
	    	}
		}
	  });
	}

	function remove(){

		var name = $("#search").val();

		$.ajax({
	    url: "remove",
	    type: "POST",
	    data: name,
	    dataType: 'text',
	    success: function (response) {
	        if(response=="True"){
	        alert(name + "has been removed from the collection");
	    	}
	    }
	  });	
	}

	function random(){
	  $.ajax({
	    url: "https://dog.ceo/api/breeds/image/random",
	    type: "GET",
	    dataType: 'json',
	    success: function (response) {
	    	var url = response.message;
	    	var name = url.replace("https://images.dog.ceo/breeds/", "");
	    	name = name.substring(0, name.indexOf("/"));
	        $("#search").val(name);
	    	$("#search_pic").html("<img src=" + url + " />");
	        random_add(response.message);
	    }
	  });
	}

	function random_add(url){
		var name = url.replace("https://images.dog.ceo/breeds/", "");
		name = name.substring(0, name.indexOf("/"));
		$.ajax({
	    url: "add",
	    type: "POST",
	    data: {'name':name, 'picture_url': url},
	    dataType: 'json',
	    success: function (response) {
	    	if(response=="True"){
	        alert(name + "has been added to the collection");
	    	}
	    }
	  });	
	}
	</script>
</body> 
</html>