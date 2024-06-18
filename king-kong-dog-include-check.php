<div class="layout-wrapper">
	<div class="layout-content">
<?php
	if(!isset($_SESSION["myusername"])) {
		if($_SESSION["admin"] != "fuckyeah") {
			header("Location: index.php");
			exit();
		}
	}
?>
<style>
			.AdminWrap input[type="text"],.AdminWrap input[type="password"], .AdminWrap select, .AdminWrap textarea {
				padding: 10px 20px;
				border: 1px solid #e2e2e2;
				border-radius: 3px;
				background: #fefefe;
				width: -moz-calc(100% - 42px);
				width: -webkit-calc(100% - 42px);
				width: -o-calc(100% - 42px);
				width: calc(100% - 42px);
			}
			.AdminWrap input[type="submit"] {
				border-radius: 5px;
				border: 0;
				background: #2dc17c;
				color: #fff;
				padding: 10px 20px;
				font-weight: 700;
			}
/*CLASSES*/
ol.BreadCrumb {
	width: -moz-calc(100% - 20px);
	width: -webkit-calc(100% - 20px);
	width: -o-calc(100% - 20px);
	width: calc(100% - 20px);
	padding: 0 20px 10px 0;
	list-style: none;
}

	ol.BreadCrumb li {
		float: left; 
		margin: 0;
		display: inline;
		font-size: 1.000em;
	}

	ol.BreadCrumb li+li:before {
		padding: 4px 4px 4px 14px;
		color: black;
		content: "â€º\00a0";
	}
.MarginLeftTwenty {
	margin: 0 0 0 20px;
}
.MarginRightTwenty {
	margin: 0 20px 0 0;
}
.Loader {
	background: #fff url("../images/loader.svg") center center no-repeat;
	background-size: 30px;
	height: 30px;
}
.MoreResultsBtn {
	margin: 10px auto 20px auto;
	width: 70%;
	padding: 10px 0;
}
	.MoreResultsBtn:hover {
		border: 1px solid #eb5155;
	}
.ConfirmBox {
	position: Fixed;
	bottom: 0;
	left: 0;
	z-index: 4000;
	color: #61755a;
	background: #def0d8;
	padding: 10px 0;
}
.ErrorBox {
	position: Fixed;
	bottom: 0;
	left: 0;
	z-index: 4000;
	color: #000;
	background: #fb836b;
	padding: 10px 0;
}
.HeaderClose {
	width: 30px;
	height: 30px;
	background: #fff url("../images/exit.svg") center center no-repeat;
	background-size: 20px;
	position: absolute;
	right: 15px;
	top: 15px;
}
.ExitBtn {
	width: 30px;
	height: 30px;
	background: transparent url("../images/exit_white.svg") center center no-repeat;
	background-size: 20px;
	border: 0;
	margin: -10px 0 0 0;
}
.InBetweenText {
	margin: 20px 0 0 20px;
}
.HeaderSimpleSmall {
	font-weight: 400;
	font-size: 1.200em;
}
.SmallFont {
	font-size: 0.8125em; /*13 px*/
}
.SmallFontFourteen {
	font-size: 0.875em; /*14 px*/
}
.SmallFontFifteen {
	font-size: 0.9375em; /*15 px*/
}
.TextCenter {
	text-align: center;
}
.MarginTop {
	margin-top: 10px;
}
.MarginBottomTen {
	margin-bottom: 10px;
}
.PaddingLeftTwenty {
	padding: 0 0 0 20px;
}
.MarginBottomTwenty {
	margin-bottom: 20px;
}
.Pointer:hover {
	cursor: pointer;
}
.DisplayBlock {
	display: block;
}
.NoMargin {
	margin: 0;
}
.FloatLeft {
	float: left;
}
.FloatRight {
	float: right;
}
.BorderRound {
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
.BorderTotalRound {
	-webkit-border-radius: 300px;
	-moz-border-radius: 300px;
	border-radius: 300px;
}
.CoverBG {
	-webkit-background-size: cover !important;
	-moz-background-size: cover !important;
	-o-background-size: cover !important;
	background-size: cover !important;
	background-repeat: no-repeat;
	background-position: center center;
	border-radius: 200px;
}
.PositionRelative {
	position: relative;
}
.PositionAbsolute {
	position: absolute;
}
.CoverNoBR {
	-webkit-background-size: cover !important;
	-moz-background-size: cover !important;
	-o-background-size: cover !important;
	background-size: cover !important;
	background-repeat: no-repeat;
	background-position: center center;
}
.BorderRight {
	border-right: 1px solid #e2e2e2;
}
.BorderBottom {
	border-bottom: 1px solid #e2e2e2;
}
.BorderTop {
	border-top: 1px solid #e2e2e2;
}
.BorderLeft {
	border-left: 1px solid #e2e2e2;
}
.BorderFull {
	border: 1px solid #e2e2e2;
}
.BoxShadow {
	box-shadow:0 1px 3px rgba(114,114,114,.2);
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}
.DisplayNone {
	display: none;
}
.WidthHundred {
	width: 100%;
}
.WidthHalf {
	width: 50%;
}
.WhiteBG {
	background: #fff;
}
.GreyBG {
	background: #f2f3f5;
}
.SubmitBtn {
	padding: 7px 20px;
	border: 0;
	background: #eb5155;
	color:#fff;
	font-size: 0.900em;
}
.CleanBtn {
	border: 0;
	padding: 6px 0;
	background: #fff;
}
.Bold {
	font-weight: 500;
}
.White {
	color: #fff;
}
.Black {
	color: #333;
}
.DarkGrey {
	color: #332D37;
}
a.DarkGreyA:link,a.DarkGreyA:visited,a.DarkGreyA:active,a.DarkGreyA:hover {
	color: #332D37;
	text-decoration: none;
}
a.WhiteA:link,a.WhiteA:visited,a.WhiteA:active,a.WhiteA:hover {
	color: #fff;
	text-decoration: none;
}
.Grey {
	color: #565a5f;
}
.LightGrey {
	color: #9b9b9b;
}
.BorderGrey {
	border: 1px solid e2e2e2;
}
.Blue {
	color: #5a7bb4;
}
.NoWrap {
  white-space: nowrap ;
}
.BorderNone {
	border: 0;
}
.BorderRed {
	border: 1px solid #eb5155;
}
.OverFlowHidden {
	overflow: hidden;
	text-overflow: ellipsis;
}
.Underline {
	text-decoration: underline;
}
</style>
<?php
	if(isset($_GET['page'])) {
		if($_GET['page'] != "kingkong-control-panel") {
?>
<p style="margin: 0 0 20px 0; padding: 0 0 20px 0; border-bottom: 1px solid #e2e2e2; display: block; float: left; width: 100%;"><a href="index.php?page=kingkong-control-panel">Admin panel</a></p>
<?php
		}
	}
?>
</div>
</div>