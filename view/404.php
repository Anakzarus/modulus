<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" >
	<meta charset="utf-8" >
	<title>[ERROR]Persective Buttons</title>
	<style type="text/css">
		html{

			box-sizing: border-box;
			margin: 0;
			padding: 0;
			border: none;
			outline: none;

			height: 100vh;
			line-height: 100vh;
			width: 100vw;
			perspective: 800px;
		}
		body{
			position: fixed;
			top: 0;
			left: 0;

			box-sizing: border-box;
			margin: 0;
			padding: 0;
			border: none;
			outline: none;

			height: 100vh;
			line-height: 100vh;
			width: 100vw;
			text-align: center;

			background: salmon;
			color: white;

			font-family: monospace;
			font-size: 30px;

			animation: 1s crazyentrance, 10s 1s crazyerror infinite;
		}
		@keyframes crazyentrance{
			0%{
				transform: scale(2000);
			}
			100%{
				color: white;
				transform: scale(1);
			}
			0%, 10%, 20%, 30%, 40%, 50%, 60%, 70%, 80%, 90%, 99.9%{
				color: black;
			}
			5%, 15%, 25%, 35%, 45%, 55%, 65%, 75%, 85%, 95%{
				color: transparent;
			}
		}
		@keyframes crazyerror{
			0%, 11%, 12.5%, 50%, 53%, 100%{
				color: white;
			}
			11.1%, 11.4%, 50.1%, 51%{
				color:transparent;
			}
			11.6%, 12.3%, 52%{
				color:black;
			}
			0%, 10%, 14%, 100%{
				transform: scale(1);
			}
			10.1%, 13%, 13.9%{
				transform: scale(1.5);
			}
			12.6%, 12.9%{
				transform: scale(1.3) skew(15deg);
			}
			50%, 52%{
				transform: scale(1) rotateY(0deg);
			}
			50.5%{
				transform: scale(0.5) rotateY(600deg) rotateZ(0deg);
			}
			51%{
				transform: scale(1) rotateY(1200deg) rotateZ(10deg);
			}
			51.5%{
				transform: scale(0.5) rotateY(1800deg) rotateZ(20deg);
			}
			70%{
				background: salmon;
			}
			75%{
				background: red;
			}
			75.1%, 76%{
				background: skyblue;
				opacity: 1
			}
			76.1%{
				background: black;
				color: lime;
				opacity: 0;
			}
			77%{
				opacity: 1;
			}
			79%{
				background: salmon;
			}
		}
	</style>
</head>
<body>
	404 - Page not found...
</body>
</html>