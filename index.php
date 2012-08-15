<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="/socket.io/socket.io.js"></script>
	<script>
		var socket = io.connect("http://127.0.1.1:8080");

		socket.on("recive_chat", function (user,message) {
			$('#box_chat').prepend("<p>"+user+"<br/>"+message+"<hr/></p>");
		});



		$(document).ready(function () {
			socket.emit("adduser",<? session_start(); echo $_SESSION['username']; ?>);
			$('#text_chat').keypress(function (e) {
				if(e.which == 13 ) {
					$(this).blur();
					var message=$(this).val();
					$(this).val(' ');
					socket.emit("send_chat",message);
					$(this).focus();
				}
			});
			$('.hand').click(function () {
				var type = document.getElementsByClassName(".hand").getAttribute("data-value");
				socket.emit("send_chat",type);
			});
		});
	</script>
	<style>
	.hand {
		float:left;
		margin-left:5px;
		width:50px;
		height:50px;
	}
	#chat {
		border: 1px solid black;
		position:absolute;
		margin-bottom: 0px;
		margin-right: 50px;
	}
	#box_chat {
		overflow-y:visible;
      	overflow-x:auto;
		height: 150px;
		width: 176px;
	}

	</style>
</head>
<body>
	<div id="header">

	</div>
	<div id="container">
		
		<dvi id="other">
			<div class="other" id="1"></div>
		</div>

		<div id="hands">
			<div class="hand" data-value="1r"></div>
			<div class="hand" data-value="2v"></div>
			<div class="hand" data-value="3"></div>
			<div class="hand" data-value="4"></div>
		</div>

	</div>
	<div id="chat">
		<div id="box_chat"></div>
		<input type="text" id="text_chat"/>
	</div>
	<div id="footer">

	</div>
</body>
</html>
