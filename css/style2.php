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
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
:root {
    --main-color: <?php echo $mainColor; ?>;
    --second-color: <?php echo $secondColor ?>;
	--third-color: <?php echo $thirdColor ?>
}
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: "Poppins", sans-serif;
}
body {
	background-color: #fcfcfc;
	font-family: 'Montserrat', sans-serif;
	background:#eee
}
a:hover {
	text-decoration: none;
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
.btn:focus {
	box-shadow: none !important;
	outline: none !important;
}
.col-1,
.col-2,
.col-3,
.col-4,
.col-5,
.col-6,
.col-7,
.col-8,
.col-9,
.col-10,
.col-11,
.col-12,
.col,
.col-auto,
.col-sm-1,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11,
.col-sm-12,
.col-sm,
.col-sm-auto,
.col-md-1,
.col-md-2,
.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6,
.col-md-7,
.col-md-8,
.col-md-9,
.col-md-10,
.col-md-11,
.col-md-12,
.col-md,
.col-md-auto,
.col-lg-1,
.col-lg-2,
.col-lg-3,
.col-lg-4,
.col-lg-5,
.col-lg-6,
.col-lg-7,
.col-lg-8,
.col-lg-9,
.col-lg-10,
.col-lg-11,
.col-lg-12,
.col-lg,
.col-lg-auto,
.col-xl-1,
.col-xl-2,
.col-xl-3,
.col-xl-4,
.col-xl-5,
.col-xl-6,
.col-xl-7,
.col-xl-8,
.col-xl-9,
.col-xl-10,
.col-xl-11,
.col-xl-12,
.col-xl,
.col-xl-auto {
	padding-right: 7px;
	padding-left: 7px;
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

/* [All Settings] 
=======================================================> */
.flex-between-center {
	display: flex;
	align-items: center;
	justify-content: space-between;
	width: 100%;
	height: 100%;
}
ul.custom {
	display: flex;
	margin-bottom: 0;
}
ul.custom li {
	margin-right: 15px;
	list-style: none;
}
ul.custom li:last-child {
	margin-right: 0;
}
.header-margin {
	margin-top: 100px;
}
/* search container */
.search-form {
	position: relative;
	margin-right: 5px;
	width: 100%;
}
.search-form input {
	height: 40px;
	padding-left: 40px;
	font-size: 16px;
}
.search-form i {
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	-webkit-transform: translateY(-50%);
	-moz-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	-o-transform: translateY(-50%);
	left: 10px;
	font-size: 19px;
	color: #eee;
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
}
.navbar-container{
	display:flex;
	align-items:center;
	justify-content:space-between;
	padding:10px 0
}
/* navbar brand */
.navbar-container .brand{
	width:150px
}
.navbar-container .brand img{
	width:100%
}
/* navbar button */
.navbar-container .button-container{
	display:flex;
	align-items:center
}
.navbar-container .button-container a{
	margin-right:7px
}
.navbar-container .button-container a:last-child{
	margin-right:0
}
.navbar-container .button-container .heart, 
.search-button{
	font-size:28px;	
}
.navbar-container .button-container .heart{
	color:red	
}
.add-button{
	text-transform:capitalize
}
.menu-bars{
	font-size: 23px;
    color: var(--main-color);
	display:none
}
			


/* search section */
.search-container form{
	display:flex;				
}
.search-container form input{
	margin-right:5px;	
}

/* category section */
.category-container{
	display: flex;
    align-items: stretch;
    flex-wrap: nowrap;
}
.category-container .cat-item{
	margin:10px 13px 10px 0;
	min-width:94px;
	text-align: center;
}
.category-container .cat-item:last-child{
	margin-right:0;
}
.category-container .cat-item a{
	text-decoration:none;
	color:#000;
	font-size:14px;
	transition:0.3s
}
.category-container .cat-item img{
    width: 66px;
    height: 66px;
    border-radius: 50%;
    text-align: center;
    line-height: 66px;
    font-size: 33px;
    color: #fff;
    display: block;
	margin: 0 auto;
	transition:0.5s
}
.category-container .cat-item:hover a{
	color:var(--main-color)
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

/* item */
.item-container {
	width: 100%;
	height: 242px;
	border: 1px solid #ccc;
	border-radius: 7px;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	-ms-border-radius: 7px;
	-o-border-radius: 7px;
	margin-bottom: 14px;
	transition: 0.5s;
	-webkit-transition: 0.5s;
	-moz-transition: 0.5s;
	-ms-transition: 0.5s;
	-o-transition: 0.5s;
}
.item-container:hover {
	box-shadow: 0 0 7px rgba(0, 0, 0, 0.5);
}
.item-container a {
	text-decoration: none;
}
.item-image {
	width: 100%;
	height: 150px;
	position: relative;
	font-size: 18px;
	border-top-right-radius: 7px;
	border-top-left-radius: 7px;
}
.item-image img {
	width: 100%;
	height: 100%;
	border-top-right-radius: 7px;
	border-top-left-radius: 7px;
	object-fit: cover;
}
.item-image .price {
	position: absolute;
	left: 0px;
	bottom: 0px;
	color: #fff;
	font-size: 17px;
	background: var(--main-color);
	padding: 4px 7px;
}
.item-image .item-status {
	position: absolute;
	right: 10px;
	bottom: 10px;
	color: #000;
	display: flex;
	margin-bottom: 0;
}
.item-image .item-status li {
	margin-right: 7px;
	list-style: none;
	width: 24px;
	height: 24px;
	line-height: 28px;
	background: #fff;
	text-align: center;
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-ms-border-radius: 4px;
	-o-border-radius: 4px;
	font-size: 14px;
	background: var(--main-color);
	color:#fff
}
.item-image .item-status li:last-child {
	margin-right: 0;
}
.item-image .item-love {
	position: absolute;
	right: 7px;
	top: 7px;
	padding: 4px 5px;
	width: 40px;
	height: 35px;
	cursor: pointer;
}
.item-love img {
	width: 100%;
}
.item-content {
	width: 100%;
	height: 89px;
	position: relative;
	background: #fff;
	padding: 10px;
	border-top: 1px solid #eee;
	border-radius:7px
}
.item-content h2 {
	font-size: 16px;
}
.item-content h2 a {
	color: #000;
}
.item-content p {
	position: absolute;
	bottom: 10px;
	left: 10px;
	color: #555;
	margin-bottom: 0;
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

/* [Footer] 
=======================================================> */
footer {
	width: 100%;
	height: auto;
	margin-top: 60px;
	background: #464646;
	color: #93a6a6;	
}
/* footer content */
.footer-content {
	width: 100%;
	text-align: center;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 25px 20px;
}
.footer-content h1 {
	font-size: 2.8rem;
	margin-bottom: 1rem;
}
.footer-content p {
	max-width: 500px;
}
.footer-content ul {
	margin-bottom: 1rem !important;
}
.footer-content ul li {
	width: 40px;
	height: 40px;
	background: #fff;
	line-height: 40px;
	text-align: center;
	font-size: 20px;
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	-ms-border-radius: 50%;
	-o-border-radius: 50%;
	transition: 0.5s;
	-webkit-transition: 0.5s;
	-moz-transition: 0.5s;
	-ms-transition: 0.5s;
	-o-transition: 0.5s;
	cursor: pointer;
}
.footer-content ul li:hover {
	background-color: var(--main-color);
}
.footer-content ul li a i {
	color: #93a6a6;
}
.footer-content ul li:hover a i {
	color: #fff;
}
/* footer bottom */
.footer-bottom {
	width: 100%;
	background: #3b3b3b;
	padding: 10px 0;
}
.footer-bottom ul li a {
	color: #93a6a6;
	transition: 0.5s;
}
.footer-bottom ul li a:hover {
	color: var(--main-color);
}

/* [Responsive] 
=======================================================> */
@media (max-width:361px){
	/* category section */
	.category-container .cat-item {
		min-width: 36%;
		margin-right: 36px !important;
	}
}
@media(max-width: 461px){
	/* category section */
	.category-container .cat-item {
		min-width: 55% !important;
	}
	.category-container .cat-item i{
		font-size:26px
	}
}
@media (max-width:576px){
	/* category section */
	.category-container .cat-item {
		min-width: 25% !important;
	}
}
@media (max-width: 620px) {
	.item-container{
		height:223px
	}
	.item-image{
		height:140px
	}
	.item-content{
		height:80px
	}
	.item-image .price{
		font-size:16px
	}
	.item-image .item-status{
		right: 5px;
    	bottom: 5px;
	}
	.item-image .item-status li{
		font-size: 14px;
	}
	.item-content h2{
		font-size: 15px;
	}
	.item-content p{
		font-size: 14px;
	}
	.price-container .services{
		display:block !important;
	}
	.price-container .services .services-item{
		font-size: 16px;
		width: 100%;
	}
	.photo-container .thumbnails ul{
		display:flex
	}
	.photo-container .thumbnails ul li{
		min-width:105px;
		height: 90px;
	}
	.photo-container .thumbnails ul li img {
		height: 100%;
	}
}
@media (max-width: 691px) {
	.col-1,
	.col-2,
	.col-3,
	.col-4,
	.col-5,
	.col-6,
	.col-7,
	.col-8,
	.col-9,
	.col-10,
	.col-11,
	.col-12,
	.col,
	.col-auto,
	.col-sm-1,
	.col-sm-2,
	.col-sm-3,
	.col-sm-4,
	.col-sm-5,
	.col-sm-6,
	.col-sm-7,
	.col-sm-8,
	.col-sm-9,
	.col-sm-10,
	.col-sm-11,
	.col-sm-12,
	.col-sm,
	.col-sm-auto,
	.col-md-1,
	.col-md-2,
	.col-md-3,
	.col-md-4,
	.col-md-5,
	.col-md-6,
	.col-md-7,
	.col-md-8,
	.col-md-9,
	.col-md-10,
	.col-md-11,
	.col-md-12,
	.col-md,
	.col-md-auto,
	.col-lg-1,
	.col-lg-2,
	.col-lg-3,
	.col-lg-4,
	.col-lg-5,
	.col-lg-6,
	.col-lg-7,
	.col-lg-8,
	.col-lg-9,
	.col-lg-10,
	.col-lg-11,
	.col-lg-12,
	.col-lg,
	.col-lg-auto,
	.col-xl-1,
	.col-xl-2,
	.col-xl-3,
	.col-xl-4,
	.col-xl-5,
	.col-xl-6,
	.col-xl-7,
	.col-xl-8,
	.col-xl-9,
	.col-xl-10,
	.col-xl-11,
	.col-xl-12,
	.col-xl,
	.col-xl-auto {
		padding-right: 5px;
		padding-left: 5px;
	}
}
@media (max-width: 767px) {
	.card-title{
		font-size: 1rem !important;
	}
	.price-container .services{
		display:flex
	}
	.price-container .price{
		margin:0 auto
	}
	/* category section */
	.category-container .cat-item{
		min-width: 23% !important;
	}
	.category-container .cat-item i{
		width:56px;
		height:56px;
		line-height:56px;
		font-size: 31px;
	}
	/* page detail header */
	.pageTitle p {
		text-align: left;
	}
	.count-adddetail {
		position: relative !important;
		right: 0 !important;
	}
}
@media (max-width:991px){
	.card-title{
		font-size: 1.1rem;
	}
	.flex-between-center {
		flex-direction: column;
	}
	.menu-bars{
		display:block
	}
	/* navbar */
	.navbar-container .button-container .add-button{
		display:none
	}
	.ctmBorder{
		border-radius:50%;
		font-size: 14px;
		padding: 4px 8px;
	}
	.navbar-container .brand{
		margin-bottom:2px;
		width:140px;
		margin-left:40px
	}	
	.search-button{
		display:none
	}

	/* category section */
	.category-container{
		overflow-x: auto;
	}
	.category-container .cat-item {
		min-width:100px;
		padding:7px;
		margin-right:20px;

	}	
	.category-container .cat-item i{
		border-radius: 50%;
		border:1px solid var(--main-color)
	}

	/* page detail header */
	.pageTitle h1 {
		font-size: 25px;
	}	

	/* photo container */
	.photo-container {
		flex-direction: column;
		height: auto;
	}
	.photo-container .thumbnails {
		padding: 10px 0 0 0;
	}
	.photo-container .thumbnails ul li {
		width: 23% !important;
	}
	.photo-container .large-photo,
	.photo-container .thumbnails {
		width: 100% !important;
	}

	/* price */
	.price-container .services {
		margin-left: 0;
	}

	/* contact person */
	.person-container .person-content h5 {
		font-size: 18px;
	}
	.person-container .person-content p {
		font-size: 23px;
	}
	.person-container .person-content p.all-adds {
		font-size: 16px;
	}

	/* table parametres */
	.table-parametres {
		width: 100%;
	}

	/* footer bottom */
	.footer-bottom ul {
		margin-top: 4px;
	}
}
@media(max-width:1200px){
	.card-title{
		font-size: 1.15rem;
	}
	/* navbar */
	.navbar-container .button-container .bars-button, .search-button{
		display:none
	}	

	/* photo container */
	.photo-container .thumbnails ul li {
		width: 30%;
		margin-right: 6px;
		margin-bottom: 12px;
	}		

	/* contact person */
	.person-container .person-content h5 {
		font-size: 15px;
	}
	.person-container .person-content p {
		font-size: 18px;
	}
	.person-container .person-content p.all-adds {
		font-size: 15px;
	}
}
@media(max-width:2000px){
	/* navbar */
	.navbar-container .button-container .bars-button, .search-button{
		display:none
	}			
}
