	  <!DOCTYPE html>
	  <html>
	  <head>
	  <title>Lesson 8: Declare a function</title>
	  </head>
	  <body>
	  <h1>Lesson 8: Declare a function</h1>
	
	  <div>
	
	    <h2>Today's date is:</h2>
	  
	    <span id="calendar"></span>
	  
	    <input type="button" id="myButton" value="Get Date"  onclick="showDate();"/>
	
	
	  </div>
	  
	  <script type="text/javascript">
	
	  //Declare your function here
	
	  function showDate()
	
	  {
	
	  //the block of code starts here:
	
	  //First get all your vars ready
	
	  //This is how JavaScript retrieves today's date
	
	  var today = new Date();
	
	  //get hold of the calendar span element
	
	  //where today's date will be inserted
	
	  var myCalendar = document.getElementById("calendar");
	
	  //get hold of the button:you need this when it comes
	
	  //to change its value attribute
	
	  var myButton = document.getElementById("myButton");
	
	  //insert the date in the span element.
	
	  //toDateString() changes the date just retrieved
	
	  //into a user-friendly format for display
	
	  myCalendar.innerHTML = today.toDateString();
	
	  //change the value attribute of the button
	
	  //to say something more appropriate once the date is displayed
	
	  myButton.value = "Well done!";
	
	  }
	
	  </script>

	    
		
	  </body>
	  </html>
	