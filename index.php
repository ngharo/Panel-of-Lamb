<html>
<head>
	<title>Wall Formerly Known as Sheep</title>
	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="js/wos.js"></script>
	<link rel="stylesheet" href="css/trontastic/jquery-ui-1.8.16.custom.css" type="text/css">
	<style type="text/css">
		body {
			background-image: url(sheep.jpg);	
		}
		#header {
			text-align: center;
		}
		#header > h1 {
			color: white;
			display: inline;
		}
		#disclaimer {
			float: left;
			font-size: 12px;
		}

		#wall {
			width: 100%;
		}

		#wall td {
			padding: 15px;
		}
		
		#add {
			display: none;
		}
		#addsheep { float: left }
	</style>
</head>
<body>
	<div id="add">
		<form id="sheepForm">
			<label for="svc">Service</label><br />
			<input type="text" id="svc" name="svc" size="15" /> <br /><br />
			<div style="float: left"><label for="username">Login</label><br />
			<input type="text" id="username" name="username" size="25" /></div>
			<div style="float:left"><label for="password">Password</label><br />
			<input type="text" id="password" name="password" size="25" /> <br /><br /></div>
			<label for="destination">Destination Address (hostname or IP)</label><br />
			<input type="text" id="destination" name="destination" size="30" /><br /><br />
			<label for="comments">Notes</label><br />
			<textarea id="comments" name="comments" cols="50" rows="4"></textarea>
		</form>
		<div id="disclaimer">A sheapard will verify your sheep before posting to the wall.  Passwords will be masked for security. lol</div>
	</div>

	<div id="header">
		<?php if($_SERVER['REMOTE_ADDR'] != '127.0.0.1') echo "		<button id=\"addsheep\">Add Sheep</button><br />\n"; ?>
		<h1>Wall Formerly Known as Sheep</h1> :: <h1>Visit me @ https://dc414.org/sheep/</h1>
		<img height="50px" src="dc414.png" style="float: right" />
	</div>
	<div id="content">
		<table cellspacing="0px" id="wall" class="ui-widget">
			<thead class="ui-widget-header">
				<tr>
					<td width="100px">Service</td>
					<td width="200px">Username</td>
					<td width="100px">Password</td>
					<td width="200px">Destination</td>
					<td>Info</td>
				</tr>
			</thead>
			<tbody id="sheep" class="ui-widget-content"></tbody>
			<tfoot class="ui-widget-header">
				<tr>
					<td colspan="4">Hosted by dc414.org</td>
				</tr>
			</tfoot>
		</table>
	</div>
	</div>
</body>
</html>
