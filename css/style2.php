<?php 
    header("Content-type: text/css; charset:UTF-8");

    error_reporting(0);
	include("../include/connectDB.php"); 
    
    $configsMain_list=mysqli_query($connect, "SELECT *  FROM configs WHERE configs_key='mainColor' ");
	$configsMain=mysqli_fetch_array($configsMain_list);

    $configsSecond_list=mysqli_query($connect, "SELECT *  FROM configs WHERE configs_key='secondColor' ");
	$configsSecond=mysqli_fetch_array($configsSecond_list);

	$configsThird_list=mysqli_query($connect, "SELECT *  FROM configs WHERE configs_key='thirdColor' ");
	$configsThird=mysqli_fetch_array($configsThird_list);

    $mainColor=$configsMain['configs_value'];
    $secondColor=$configsSecond['configs_value'];
	$thirdColor=$configsThird['configs_value'];
?>

/* [Optional CSS] 
=======================================================> */
:root {
    --main-color: <?php echo $mainColor; ?>;
    --second-color: <?php echo $secondColor ?>;
	--third-color: <?php echo $thirdColor ?>
}
button.ownBTN:focus,
button.ownBTN {
	outline: 1px solid var(--main-color);
	padding: 6px 10px;
	border-radius: 6px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	-ms-border-radius: 6px;
	-o-border-radius: 6px;
}
.breadcrumb {
	align-items: center;
}
.breadcrumb-item + .breadcrumb-item::before {
	content: ">";
	color: var(--main-color);
	font-size: 18px;
}
.modal {
	top: 120px;
}
.note-editable{
	background:white !important
}
.center_watermark_once{
	width:60%
}

/* [All Settings] 
=======================================================> */
.header-margin {
	margin-top: 100px;
}

fancybox-button:focus{
	border:none !important
}
#button_share img {
	width: 45px;
	box-shadow: 0;
	padding: 6px;
	display: inline;
	border: 0;
}
/* menu container */
.menu-icon {
	background-color: #fff;
	height: 50px;
	width: 50px;
	line-height: 59px;
	border-radius: 4px;
	text-align: center;
	transition: all ease 0.3s;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-ms-border-radius: 4px;
	-o-border-radius: 4px;
	margin-right: 10px;
	border: 1px solid var(--main-color);
}
.menu-icon i {
	font-size: 31px;
	color: var(--main-color);
}
.menu-item-span {
	color: #fff;
	line-height: 47px;
	vertical-align: top;
	font-size: 15px;
	font-weight: 600;
	transition: all ease 0.3s;
}

/* [Preloader CSS] 
=======================================================> */
.preloader {
	width: 100%;
	height: 100vh;
	background-color: #fff;
	position: fixed;
	left: 0;
	top: 0;
	z-index: 10;
	opacity: 0.8;
	display: none;
}
.preloader img {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	-webkit-transform: translate(-50%, -50%);
	-moz-transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	-o-transform: translate(-50%, -50%);
}
.overhidden {
	overflow: hidden;
}

/* [Scroll Up] 
=======================================================> */
.scrollUp{
	position:fixed;
	bottom:40px;
	right:40px;
	z-index:10000;
	background:var(--main-color);
	width:40px;
	height:40px;
	line-height:40px;
	text-align:center;
	color:#fff;
	cursor:pointer;
	display:none;
	transition:0.5s;
	font-size: 20px;
	border-radius: 50%;
}

/* navbar */
::-webkit-scrollbar { 
	width: 0px; 
	height:2px;
	transition:0.5s;
	cursor:pointer
} 
::-webkit-scrollbar-thumb {
	background:#ccc;
	border-radius:10px;
}
header{
	position:fixed;
	width:100%;
	z-index:1000;
}
header.active{
	background:var(--third-color);
	top:0
}
.advert-left, .advert-right{
	position:fixed;
	top:118px;
	z-index:1000;
	width:150px;
	height:82vh
}
.advert-left{
	left:0;
}
.advert-right{
	right:0;
}

/* [Owl Carousel2] 
=======================================================> */
.owl-nav {
	position: absolute;
	top: 12%;
	left: 50%;
	transform: translate(-50%, -50%);
	-webkit-transform: translate(-50%, -50%);
	-moz-transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	-o-transform: translate(-50%, -50%);
	width: 100%;
}
.owl-nav .owl-prev {
	position: absolute;
	left: 5px;
	display: block;
	color: #fff !important;
	background-color: var(--main-color) !important;
	width: 28px;
	height: 28px;
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	-ms-border-radius: 50%;
	-o-border-radius: 50%;
	font-size: 28px !important;
	line-height: 28px !important;
}
.owl-nav .owl-next {
	position: absolute;
	right: 5px;
	display: block;
	color: #fff !important;
	background-color: var(--main-color) !important;
	width: 28px;
	height: 28px;
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	-ms-border-radius: 50%;
	-o-border-radius: 50%;
	font-size: 28px !important;
	line-height: 28px !important;
}
button.owl-prev:focus {
	outline: none;
}
button.owl-next:focus {
	outline: none;
}

/* [New Advertisement] 
=======================================================> */
/* add rules */
h5.rulers::before {
	content: "";
	position: absolute;
	bottom: -3px;
	left: 0;
	width: 100px;
	height: 2px;
	background-color: var(--main-color);
}
.add-rules ul li {
	position: relative;
	padding-left: 15px;
	list-style: none !important;
	margin-bottom: 6px;
}
.add-rules ul li::before {
	content: "";
	position: absolute;
	top: 10px;
	left: 0;
	width: 6px;
	height: 6px;
	border-radius: 50%;
	background-color: var(--main-color);
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	-ms-border-radius: 50%;
	-o-border-radius: 50%;
}
.form-check a,
.add-rules a {
	text-decoration: underline;
	color: var(--main-color);
}
.form-check a:hover,
.add-rules a:hover {
	text-decoration: underline;
}
/* form */
.custom-radio .custom-control-input:checked ~ .custom-control-label::before{
	background-color: var(--main-color);
}
.form-control:focus,
button:focus {
	box-shadow: none !important;
	border: 1px solid var(--main-color);
}
.custom-button {
	background-color: var(--main-color) !important;
	border-color: var(--main-color) !important;
}
.custom-button:hover {
	background-color: var(--main-color) !important;
	border-color: var(--main-color) !important;
}
.breadcrumb a {
	color: var(--main-color);
}
#selectCategory option {
	text-transform: none;
}
/* img preview */
input[type="file"] {
	display: block;
}
.imageThumb {
	max-height: 131px;
	padding: 1px;
	cursor: pointer;
}
.pip {
	display: inline-block;
	margin: 10px 10px 0 0;
	position:relative
}
.remove {
	background: #444;
	color: white;
	text-align: center;
	cursor: pointer;
	margin-top: 1px;
	position:absolute;
	top:-10px;
	right:-10px;
	width:28px;
	height:27px;
	border-radius:50%;
	line-height: 28px;
	font-size: 17px;
}
.remove:hover {
	background: white;
	color: black;
}

/* [Add Detail] 
=======================================================> */
/* page detail header */
.pageTitle {
	width: 100%;
	margin-bottom: 20px;
}
.pageTitle h1 {
	font-size: 23px;
	margin-top: 0.5rem;
	margin-bottom: 0.8rem;
}
.pageTitle ul {
	display: flex;
}
.pageTitle li {
	padding: 3px 13px;
	background: #f6f6f6;
	border-radius: 24px;
	margin-right: 10px !important;
	cursor: pointer;
	transition: 0.5s;
	border: 1px solid var(--main-color);
	-webkit-border-radius: 24px;
	-moz-border-radius: 24px;
	-ms-border-radius: 24px;
	-o-border-radius: 24px;
	-webkit-transition: 0.5s;
	-moz-transition: 0.5s;
	-ms-transition: 0.5s;
	-o-transition: 0.5s;
	list-style: none;
}
.pageTitle li a {
	color: var(--main-color);
	transition: 0.5s;
}
.pageTitle li:hover {
	background: var(--main-color);
}
.pageTitle li:hover a {
	color: #fff;
}
.pageTitle p {
	text-align: right;
	font-size: 16px;
}
.count-adddetail {
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	right: 15px;
	-webkit-transform: translateY(-50%);
	-moz-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	-o-transform: translateY(-50%);
}
/* photo container */
.photo-container {
	height: 600px;
	width: 100%;
	background: #323232;
	padding: 15px;
	display: flex;
}
.photo-container .large-photo {
	width: 53%;
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
}
.photo-container .thumbnails {
	width: 47%;
	height: 100%;
	padding: 7px 10px;
	overflow-y: auto;
}
.photo-container .thumbnails ul {
	margin-bottom: 0;
}
.photo-container .thumbnails ul li {
	display: inline-block;
	margin-right: 4px;
	width: 23%;
	margin-bottom: 10px;
	border: 3px solid #fff;
	padding: 1px;
}
.photo-container .thumbnails ul li:hover {
	border: 3px solid var(--main-color);
}
.photo-container .thumbnails ul li:hover img {
	filter: grayscale();
	-webkit-filter: grayscale();
}
.photo-container .thumbnails ul li img {
	width: 100%;
	height: 100px;
	cursor: zoom-in;
}
/* price */
.price-container {
	display: flex;
	align-items: flex-end;
	background-color: #f4f2ef;
	padding: 23px 20px;
	margin-bottom: 20px;
}
.price-container .price {
	height: 65px;
	width: 180px;
	background: var(--main-color);
	color: #fff;
	text-align: center;
	line-height: 65px;
	font-size: 23px;
	border-radius:4px
}
.price-container .services {
	display: inline-block;
	width: 624px;
	margin-left: 22px;
	font-size: 18px;
}
.price-container .services .services-item {
	position: relative;
	display: inline-block;
	margin-top: 15px;
	border-radius: 4px;
	border: 1px solid var(--main-color);
	padding: 9px;
	background-color: #fff;
	color: var(--main-color);
	line-height: 22px;
	text-align: center;
	font-weight: bold;
	transition: 0.2s;
	margin-right: 5px;
	-webkit-transition: 0.2s;
	-moz-transition: 0.2s;
	-ms-transition: 0.2s;
	-o-transition: 0.2s;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-ms-border-radius: 4px;
	-o-border-radius: 4px;
	cursor: pointer;
}
.price-container .services .services-item:hover {
	background: #dadada;
}
.price-container .services .services-item:focus {
	outline: none;
}
.price-container .services .services-item-active {
	position: relative;
	display: inline-block;
	margin-top: 15px;
	border-radius: 4px;
	border: 1px solid var(--main-color);
	padding: 9px;
	background-color: var(--main-color);
	color: #fff;
	line-height: 22px;
	text-align: center;
	margin-right: 5px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-ms-border-radius: 4px;
	-o-border-radius: 4px;
}
.price-container .services .services-item-active span{
	position: absolute;
    top: -18px;
    right: -7px;
    color: white;
    background: green;
    padding: 3px 6px;
    border-radius: 3px;
}
/* contact person */
.person-container {
	background-color: #fff;
	border-radius: 10px !important;
	box-shadow: 0 4px 24px 0 rgb(0 0 0 / 8%);
	padding: 18px;
	-webkit-border-radius: 10px !important;
	-moz-border-radius: 10px !important;
	-ms-border-radius: 10px !important;
	-o-border-radius: 10px !important;
}
.person-container .person-content {
	width: 100%;
	color: #000;
}
.person-container .person-content h5 {
	font-size: 18px;
	font-weight: bold;
}
.person-container .person-content p {
	font-size: 23px;
	margin-bottom: 0.5rem;
}
.person-container .person-content p.all-adds {
	font-size: 16px;
	text-align: center;
	margin-bottom: 0;
	margin-top: 18px;
}
.person-container .person-content p.all-adds a {
	color: #797979;
}
.person-container .person-content p.all-adds a:hover {
	text-decoration: underline;
}
.person-container .person-content p.all-adds i {
	margin-right: 8px;
	color: #797979;
	font-size: 22px;
}
/* table parametres */
.table-parametres {
	margin-left: 0.5rem;
}
table.parameters {
	width: 100%;
	font-size: 15px;
}
table.parameters tr {
	border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
table.parameters td {
	padding: 10px 0px;
	color: #8c8c8c;
	float: right;
}
table.parameters td.table-title {
	color: #000;
	font-weight: bold;
	float: left;
}

/* [User Elan] 
=======================================================> */
ul.filters {
	display: block;
	width: 100%;
	margin: 0;
	padding: 30px 0;
}
ul.filters > li {
	list-style: none;
	display: inline-block;
}
ul.filters > li > a {
	display: block;
	color: var(--main-color);
	text-decoration: none;
	padding: 5px 20px;
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-ms-border-radius: 4px;
	-o-border-radius: 4px;
}
ul.filters > li > a:hover {
	background-color: #e6e9ed;
}
ul.filters > li.active > a {
	background-color: var(--main-color);
	color: #fff;
}

/* [Confirmation] 
=======================================================> */
.box-container {
	background: #f4f2ef;
	padding: 15px;
	border-radius: 6px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	-ms-border-radius: 6px;
	-o-border-radius: 6px;
}
.box-title-h5 {
	position: relative;
	margin-bottom: 15px;
}
.box-title-h5:before {
	content: "";
	position: absolute;
	bottom: -5px;
	width: 7%;
	height: 2px;
	background: #000;
}
.box-container .mob {
	font-size: 20px;
	margin-top: 2px;
	margin-bottom: 0;
}
.box-container span {
	color: #8c8c8c;
}
/* swipe slider
--------------------------------------------------------> */
.swiper-container {
	width: 100%;
	padding-bottom: 45px;
}
.swiper-slide {
	background-position: center;
	background-size: cover;
	width: 300px;
	height: 300px;
	overflow: hidden;
}
.swiper-slide img {
	width: 100%;
	height: 100%;
	object-fit: cover;
}
