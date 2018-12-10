from flask import Flask
app = Flask(__name__)
 
@app.route("/")
def hello():
    #return "Welcome to the world of gaming"

f = open('helloworld.html','w')

message = """<!DOCTYPE html>
<html>
	<head>
		<title> PSP GAME SURVEY</title>
		<meta charset="UTF-8" />
		<meta name="author" content="Moise Medina" />
		<meta name="description" content="" />
		<meta name="keywords" content="links" />
		<!-- Name : Moise Medina
			 Course : CS 368
			 Due date : 04-26-13  -->
		<link href="program07.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="program07.js">
		</script>
		 
	</head>
	<body onload = "runSelect()" style="background-color:white;">

		<header style="text-align:left" > <br />		
		<p id ="test" name ="test"> </p>
		</header>
		
	</body>
</html>"""

f.write(message)
f.close()
 
if __name__ == "__main__":
    app.run()
