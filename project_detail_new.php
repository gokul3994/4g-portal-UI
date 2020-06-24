<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Meter Details | Solar-log</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

	 
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    
	<style>
#chartdiv1,#chartdiv2,#chartdiv3,#chartdiv2a {
  width: 75%;
  height: 300px;
}

.submit{
	background-color: #97b5e8;
  border: 1px solid black;
  color: black;
 
 
  cursor: pointer;
}
.multiselect {
  width: 150px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #66D4D4;
}
.table{
	background-color: #E0E8E8;
	color:black;
	width:30%;
	text-decoration:none;
	font-size:12px;
	height:300px;
	
}
tr:hover {background-color:#ffffff;}
.rs{
	padding:0px;
	margin:0px
}
#ex3{
	margin-left:65.5%;
}

</style>
</head>
<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>


<!-- Chart code for year -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv2", am4charts.XYChart);

// Export
chart.exporting.menu = new am4core.ExportMenu();

// Data for both series
var data = [ {
  "year": "2009",
  "energy": 23.5,
  "power": 21.1
}, {
  "year": "2010",
  "energy": 26.2,
  "power": 30.5
}, {
  "year": "2011",
  "energy": 30.1,
  "power": 34.9
}, {
  "year": "2012",
  "energy": 29.5,
  "power": 31.1
}, {
  "year": "2013",
  "energy": 30.6,
  "power": 28.2
  
}, {
  "year": "2014",
  "energy": 34.1,
  "power": 32.9
  
  
} ];

/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.minGridDistance = 30;

/* Create value axis */
//var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis1.dataFields.value = "energy";
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.dataFields.value2 = "power";



/* Create series */
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "energy";
columnSeries.dataFields.valueY = "energy";

columnSeries.dataFields.categoryX = "year";

columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";

var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "power";
lineSeries.dataFields.valueY = "power";
lineSeries.dataFields.categoryX = "year";

lineSeries.stroke = am4core.color("#fdd400");
lineSeries.strokeWidth = 3;
lineSeries.propertyFields.strokeDasharray = "lineDash";
lineSeries.tooltip.label.textAlign = "middle";

var bullet = lineSeries.bullets.push(new am4charts.Bullet());
bullet.fill = am4core.color("#fdd400"); // tooltips grab fill from parent by default
bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
var circle = bullet.createChild(am4core.Circle);
circle.radius = 4;
circle.fill = am4core.color("#fff");
circle.strokeWidth = 3;

chart.data = data;

}); // end am4core.ready()
</script>
<!-- Chart code for month -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv2a", am4charts.XYChart);

// Export
chart.exporting.menu = new am4core.ExportMenu();

// Data for both series
var data = [ {
  "month": "01",
  "energy": 23.5,
  "power": 21.1
}, {
  "month": "02",
  "energy": 26.2,
  "power": 30.5
}, {
  "month": "03",
  "energy": 30.1,
  "power": 34.9
}, {
  "month": "04",
  "energy": 29.5,
  "power": 31.1
}, {
  "month": "05",
  "energy": 30.6,
  "power": 28.2
  
}, {
  "month": "06",
  "energy": 34.1,
  "power": 32.9
  
  
} ];

/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "month";
categoryAxis.renderer.minGridDistance = 30;

/* Create value axis */
//var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis1.dataFields.value = "energy";
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.dataFields.value2 = "power";



/* Create series */
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "energy";
columnSeries.dataFields.valueY = "energy";

columnSeries.dataFields.categoryX = "month";

columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";

var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "power";
lineSeries.dataFields.valueY = "power";
lineSeries.dataFields.categoryX = "month";
lineSeries.stroke = am4core.color("#fdd400");

lineSeries.strokeWidth = 3;
lineSeries.propertyFields.strokeDasharray = "lineDash";
lineSeries.tooltip.label.textAlign = "middle";

var bullet = lineSeries.bullets.push(new am4charts.Bullet());
bullet.fill = am4core.color("#fdd400"); // tooltips grab fill from parent by default
bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
var circle = bullet.createChild(am4core.Circle);
circle.radius = 4;
circle.fill = am4core.color("#fff");
circle.strokeWidth = 3;

chart.data = data;

}); // end am4core.ready()
</script>
<!-- Day wise graph -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv1", am4charts.XYChart);

// Export
chart.exporting.menu = new am4core.ExportMenu();

// Data for both series
var data = [ {
  "hour": "00:00",
  "energy": 23.5,
  "power": 21.1,
  "export":50,
  "import":0.5
}, {
  "hour": "01:00",
  "energy": 26.2,
  "power": 30.5,
  "export":80,
  "import":0.8
}, {
  "hour": "02:00",
  "energy": 30.1,
  "power": 34.9,
  "export":90,
  "import":0.9
}, {
  "hour": "03:00",
  "energy": 29.5,
  "power": 31.1,
  "export":40,
  "import":0.4
}, {
  "hour": "04:00",
  "energy": 30.6,
  "power": 28.2,
  "export":90,
  "import":0.9
  
}, {
  "hour": "05:00",
  "energy": 34.1,
  "power": 32.9,
  "export":300,
  "import":100
  
},
 {
  "hour": "06:00",
  "energy": 30.6,
  "power": 28.2,
  "export":80,
  "import":0.8
  
}, {
  "hour": "07:00",
  "energy": 34.1,
  "power": 32.9,
  "export":70,
  "import":60
  
  
}, {
  "hour": "08:00",
  "energy": 30.6,
  "power": 28.2,
  "export":30,
  "import":0.5
  
}, {
  "hour": "09:00",
  "energy": 34.1,
  "power": 32.9,
  "export":50,
  "import":0.5
  
  
}, {
  "hour": "10:00",
  "energy": 30.6,
  "power": 28.2,
  "export":50,
  "import":0.5
  
}, {
  "hour": "11:00",
  "energy": 222,
  "power": 32.9,
  "export":50,
  "import":0.5
  
  
}, {
  "hour": "12:00",
  "energy": 30.6,
  "power": 233,
  "export":120,
  "import":50
  
}, {
  "hour": "13:00",
  "energy": 34.1,
  "power": 32.9,
  "export":80,
  "import":0.5
  
  
}, {
  "hour": "14:00",
  "energy": 30.6,
  "power": 55,
  "export":50,
  "import":0.5
  
}, {
  "hour": "15:00",
  "energy": 34.1,
  "power": 67,
  "export":50,
  "import":0.5
  
  
}, {
  "hour": "16:00",
  "energy": 30.6,
  "power": 98,
  "export":50,
  "import":0.5
  
}, {
  "hour": "17:00",
  "energy": 34.1,
  "power": 87,
  "export":50,
  "import":0.5
  
  
}, {
  "hour": "18:00",
  "energy": 22,
  "power": 28.2,
  "export":50,
  "import":0.5
  
}, {
  "hour": "19:00",
  "energy": 30,
  "power": 32.9,
  "export":50,
  "import":0.5
  
  
}, {
  "hour": "20:00",
  "energy": 56,
  "power": 100,
  "export":50,
  "import":0.5
  
  
}, {
  "hour": "21:00",
  "energy": 30.6,
  "power": 28.2,
  "export":50,
  "import":0.5
  
}, {
  "hour": "22:00",
  "energy": 34.1,
  "power": 32.9,
  "export":50,
  "import":0.5
  
  
}, {
  "hour": "23:00",
  "energy": 30.6,
  "power": 28.2,
  "export":10,
  "import":0.1
  
} ];

/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "hour";
categoryAxis.renderer.minGridDistance = 30;

/* Create value axis */
//var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis1.dataFields.value = "energy";
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.dataFields.value2 = "power";



/* Create series */
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "Grid Import energy";
columnSeries.dataFields.valueY = "energy";
columnSeries.fill = am4core.color("#FB191F");

columnSeries.dataFields.categoryX = "hour";

columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";

var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "Solar energy";
columnSeries.dataFields.valueY = "import";
columnSeries.fill = am4core.color("#60f763");

columnSeries.dataFields.categoryX = "hour";

columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";




var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "Solar Active power";
lineSeries.dataFields.valueY = "export";
lineSeries.dataFields.categoryX = "hour";

lineSeries.stroke = am4core.color("#f7a90c");
lineSeries.strokeWidth = 3;
lineSeries.propertyFields.strokeDasharray = "lineDash";
lineSeries.tooltip.label.textAlign = "middle";

var bullet = lineSeries.bullets.push(new am4charts.Bullet());
bullet.fill = am4core.color("#fdd400"); // tooltips grab fill from parent by default
bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
var circle = bullet.createChild(am4core.Circle);
circle.radius = 2;
circle.fill = am4core.color("#fff");
circle.strokeWidth = 2;

chart.data = data;

}); // end am4core.ready()
</script>
<!-- Chart code for systemview -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv3", am4charts.XYChart);

// Export
chart.exporting.menu = new am4core.ExportMenu();

// Data for both series
var data = [ {
  "Day": "11",
  "energy": 23.5,
  "power": 21.1
}, {
  "Day": "12",
  "energy": 26.2,
  "power": 30.5
}, {
  "Day": "13",
  "energy": 30.1,
  "power": 34.9
}, {
  "Day": "14",
  "energy": 29.5,
  "power": 31.1
}, {
  "Day": "15",
  "energy": 30.6,
  "power": 28.2
  
}, {
  "Day": "16",
  "energy": 34.1,
  "power": 32.9
  
  
} ];

/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "Day";
categoryAxis.renderer.minGridDistance = 30;

/* Create value axis */
//var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis1.dataFields.value = "energy";
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.dataFields.value2 = "power";

var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "energy";
lineSeries.dataFields.valueY = "energy";
lineSeries.dataFields.categoryX = "Day";

lineSeries.stroke = am4core.color("#3CDAF3");
lineSeries.strokeWidth = 3;
lineSeries.propertyFields.strokeDasharray = "lineDash";
lineSeries.tooltip.label.textAlign = "middle";

var bullet = lineSeries.bullets.push(new am4charts.Bullet());
bullet.fill = am4core.color("#3CDAF3"); // tooltips grab fill from parent by default
bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
var circle = bullet.createChild(am4core.Circle);
circle.radius = 4;
circle.fill = am4core.color("#fff");
circle.strokeWidth = 3;


var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "power";
lineSeries.dataFields.valueY = "power";
lineSeries.dataFields.categoryX = "Day";

lineSeries.stroke = am4core.color("#fdd400");
lineSeries.strokeWidth = 3;
lineSeries.propertyFields.strokeDasharray = "lineDash";
lineSeries.tooltip.label.textAlign = "middle";

var bullet = lineSeries.bullets.push(new am4charts.Bullet());
bullet.fill = am4core.color("#fdd400"); // tooltips grab fill from parent by default
bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
var circle = bullet.createChild(am4core.Circle);
circle.radius = 4;
circle.fill = am4core.color("#fff");
circle.strokeWidth = 3;

chart.data = data;

}); // end am4core.ready()
</script>
 <script>
function selFunction(){
var s = document.getElementById("sel").value;
if(s==2){
	document.getElementById("chartdiv2a").style.display = "none";
	document.getElementById("chartdiv2").style.display = "block";
	document.getElementById("yeartable").style.display = "inline";
	document.getElementById("monthtable").style.display = "none";
	
}
else if(s==1){
	document.getElementById("chartdiv2").style.display = "none";
	document.getElementById("chartdiv2a").style.display = "block";
	document.getElementById("monthtable").style.display = "inline";
	document.getElementById("yeartable").style.display = "none";
}
else{
	
}
}

var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
   $( function() {
    $( "#datepickersys" ).datepicker();
  } );
   $( function() {
    $( "#datepickerfrom" ).datepicker();
  } );
   $( function() {
    $( "#datepickerto" ).datepicker();
	
  } );
  </script>
</script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>SDSI</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/SL.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>SDSI</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="tables_dynamic.php" ><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    
                  </li>
                  <!--<li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">General Form</a></li>
                      <li><a href="form_advanced.html">Advanced Components</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                      <li><a href="form_wizards.html">Form Wizard</a></li>
                      <li><a href="form_upload.html">Form Upload</a></li>
                      <li><a href="form_buttons.html">Form Buttons</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">General Elements</a></li>
                      <li><a href="media_gallery.html">Media Gallery</a></li>
                      <li><a href="typography.html">Typography</a></li>
                      <li><a href="icons.html">Icons</a></li>
                      <li><a href="glyphicons.html">Glyphicons</a></li>
                      <li><a href="widgets.html">Widgets</a></li>
                      <li><a href="invoice.html">Invoice</a></li>
                      <li><a href="inbox.html">Inbox</a></li>
                      <li><a href="calendar.html">Calendar</a></li>
                    </ul>
                  </li>-->
                  <li><a><i class="fa fa-table"></i> Meters <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables_dynamic.php">NC</a></li>
                      <li><a href="tables_dynamic.php">Not_Installed</a></li>
                      <li><a href="tables_dynamic.php">SC</a></li>
                    </ul>
                  </li>
                  <!--<li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>-->
                </ul>
             
			   <div class="project_detail">

                            <p class="title">Installer Name</p>
                            <p>Illinois Solar</p>
                            <p class="title">Project Adminstrator</p>
                            <p>Spring Field University</p>
                          </div>

                          <br />
                          <h5>Project files</h5>
                          <ul class="list-unstyled project_files">
                            <li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                            </li>
                            <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                            </li>
                            <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                            </li>
                          </ul>
                          <br />

                          <div class="text-center mtop20">
                            <a href="#" class="btn btn-sm btn-primary">Add files</a>
                            <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                          </div>
                        </div>
 </div>
              <!--<div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>-->

            </div>
            <!-- /sidebar menu -->


            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

                <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="images/SL.png" alt="">SDSI
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="javascript:;"> Profile</a>
                        <a class="dropdown-item"  href="javascript:;">
                          <span class="badge bg-red pull-right">50%</span>
                          <span>Settings</span>
                        </a>
                    <a class="dropdown-item"  href="javascript:;">Help</a>
                      <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
  
                  <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                     <!-- <i class="fa fa-envelope-o"></i>
                      <span class="badge bg-green">2</span>
                    </a>-->
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                      <!--<li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/SL.png" alt="Profile Image" /></span>
                         <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Meters Working fine now
                          </span>-->
                        </a>
                      </li>
                      
                      
                      <li class="nav-item">
                        <!--<a class="dropdown-item">
                          <span class="image"><img src="images/SL.png" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>-->
                          </span>
                          <span class="message">
                            <!--Meters Not Communicating for Last 2 Days-->
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <div class="text-center">
                           <!--<a class="dropdown-item">
                           <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>-->
                          </a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Meter Details</h3>
              </div>

              <!--<div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>-->
            </div>
            
            <div class="clearfix"></div>

            <div class="row" style="height:110%;">
              <div class="col-md-12" >
                <div class="x_panel" style="background-color:#fafffa;">
                  <div class="x_title">
                    <h2>Meter Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content" > 

                    <div class="col-md-12 col-sm-12  ">

                      <ul class="stats-overview">
                        <li>
                          <span class="name"> Plant Status </span>
                          <span class="value text-success"> <button class="btn btn-success"></button> </span>
                        </li>
                        <li>
                          <span class="name"> Latest Interval Data Read </span>
                          <span class="value text-none"><b>Jan 11, 2020 03:00:00 PM </b></span>
                        </li>
                        <li class="hidden-phone">
                          <span class="name"> Communication status </span>
                          <span class="value text-success"> <button class="btn btn-success"></button> </span>
                        </li>
                      </ul>
                      <br />
					  
                        <h3 align="left">Daily Generation</h3>
                      <!--<div id="mainb" style="height:350px;"></div>-->
					  
				  <p align="center">Select Date: <input type="text" id="datepicker" placeholder="Choose a Date"></p>
					  
					  
					  <br>
					  
					  <br>
					  <h6 align="right">Export</h6>
					  <div id="chartdiv1" style="width:100%;"></div>
					  
					  <div class="col-md-12 col-sm-12" >

                      <ul class="stats-overview">
                        <li style="width:24%">
                          <span class="name"> Peak Power (kW)</span>
                          <span class="value text-warning"><b> 300 </b></span>
                        </li>
                        <li style="width:24%">
                          <span class="name"> Solar Active Power (kW)</span>
                          <span class="value text-warning"><b> 1000 </b> </span>
                        </li>
                        <li style="width:24%">
                          <span class="name">Grid Import Energy (kWh)</span>
                          <span class="value text-danger"><b> 390 </b></span>
                        </li>
						 <li style="width:24%">
                          <span class="name">Solar Production (kWh)</span>
                          <span class="value text-success"><b> 3890 </b></span>
                        </li>
                      </ul>
					  
					  </div>
				
					  <br>
                    <br>
				   <br>
				   <br>
				   <h3 align="left">Systemview Graph</h3>
				   
				   					 <div class="col-md-4 col-sm-4  tile">
					 
              <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
      <select>
        <option>Select...</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div id="checkboxes">
      <label for="one">
        <input type="checkbox" id="one" /><b>&nbsp;UAC</b></label>
      <label for="two">
        <input type="checkbox" id="two" /><b>&nbsp;PAC</b></label>
      <label for="three">
        <input type="checkbox" id="three" /><b>&nbsp;EAE</b></label>
    </div>
  </div>
						  
						  
						
              
			  <br>
			  <br>
			  <br>
			  <br>
			  <br> 
			  		  
	
					 
					  </div>
					  <p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Date: <input type="text" id="datepickersys" placeholder="Choose a Date"></p>
					  <br>
					  <br>
			       <h6 align="right">Export</h6>
				   <div id="chartdiv3" style="height:300px;width:100%;" ></div>
				   <br>
				   <br>
				   <br>
				    <h3 align="left">Monthly / Yearly Generation</h3>
					 <div class="col-md-4 col-sm-4  tile">
					 
              <label for="heard">Generation selection:</label>
                          <select id="sel" class="form-control" required>
                            <option value=1 id="mon">Monthly Generation</option>
                            <option value=2 id="ye">Yearly Generation</option>
                            
                          </select>
						  
						  
						
              </div>
			  <br>
			  <br>
			  
			  <button onclick="selFunction()" class="submit" >Submit</button>
                   
				   <br>
				   		  
			
					  
					  
					  
					  <br>
					  <br>
					  <div class="row">
					  <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From Date: <input type="text" id="datepickerfrom" placeholder="Choose a Date"></p>
					  <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;To Date: <input type="text" id="datepickerto" placeholder="Choose a Date"></p>
					  </div>
				   <br>
				   <br>
				    <h6 id="ex3">Export</h6>
				  <div class="row">
                  <div id="chartdiv2" style="height:300px;display:none;width:70%;"></div>
				  <div id="chartdiv2a" style="height:300px;width:70%;"></div>
				  
				  <div class="table table-bordered" id="monthtable">
				  <table>
				  
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;"><u>Month-Wise</td><td style="padding:2.5px; margin:0px;"><u>Peak (kW)</td><td style="padding:2.5px; margin:0px;"><u>Solar prd.(kWh)</td><td style="padding:2.5px; margin:0px;"><u>Grid import(kWh)</td></u></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Jan 2020 </td><td style="padding:2.5px; margin:0px;">200</td><td style="padding:2.5px; margin:0px;">5000</td><td style="padding:2.5px; margin:0px;">100</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Feb 2020 </td><td style="padding:2.5px; margin:0px;">300</td><td style="padding:2.5px; margin:0px;">6000</td><td style="padding:2.5px; margin:0px;">200</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Mar 2020 </td><td style="padding:2.5px; margin:0px;">400</td><td style="padding:2.5px; margin:0px;">5430</td><td style="padding:2.5px; margin:0px;">330</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Apr 2020 </td><td style="padding:2.5px; margin:0px;">590</td><td style="padding:2.5px; margin:0px;">3320</td><td style="padding:2.5px; margin:0px;">320</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">May 2020 </td><td style="padding:2.5px; margin:0px;">300</td><td style="padding:2.5px; margin:0px;">4420</td><td style="padding:2.5px; margin:0px;">550</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Jun 2020 </td><td style="padding:2.5px; margin:0px;">700</td><td style="padding:2.5px; margin:0px;">1202</td><td style="padding:2.5px; margin:0px;">440</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Aug 2020 </td><td style="padding:2.5px; margin:0px;">300</td><td style="padding:2.5px; margin:0px;">4402</td><td style="padding:2.5px; margin:0px;">340</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Sep 2020 </td><td style="padding:2.5px; margin:0px;">100</td><td style="padding:2.5px; margin:0px;">1200</td><td style="padding:2.5px; margin:0px;">200</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Oct 2020 </td><td style="padding:2.5px; margin:0px;">500</td><td style="padding:2.5px; margin:0px;">3032</td><td style="padding:2.5px; margin:0px;">600</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Nov 2020 </td><td style="padding:2.5px; margin:0px;">300</td><td style="padding:2.5px; margin:0px;">4042</td><td style="padding:2.5px; margin:0px;">220</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">Dec 2020 </td><td style="padding:2.5px; margin:0px;">100</td><td style="padding:2.5px; margin:0px;">120</td><td style="padding:2.5px; margin:0px;">120</td></tr>

				 </table>
				 <div>
				 </div>
				  

                    </div>
					<div class="table" id="yeartable" style="display:none;">
				  <table>
				  <tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;"><u>Year-Wise</td>&nbsp;&nbsp;<td style="padding:2.5px; margin:0px;"><u>Peak (kW)</td><td style="padding:2.5px; margin:0px;"><u>Solar prd.(kWh)</td><td style="padding:2.5px; margin:0px;"><u>Grid import(kWh)</td></u></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">2014 </td>&nbsp;&nbsp;<td style="padding:2.5px; margin:0px;">200</td><td style="padding:2.5px; margin:0px;">5000</td><td style="padding:2.5px; margin:0px;">130</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">2015 </td>&nbsp;&nbsp;<td style="padding:2.5px; margin:0px;">300</td><td style="padding:2.5px; margin:0px;">6009</td><td style="padding:2.5px; margin:0px;">230</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">2016 </td>&nbsp;&nbsp;<td style="padding:2.5px; margin:0px;">400</td><td style="padding:2.5px; margin:0px;">5408</td><td style="padding:2.5px; margin:0px;">120</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">2017 </td>&nbsp;&nbsp;<td style="padding:2.5px; margin:0px;">200</td><td style="padding:2.5px; margin:0px;">5040</td><td style="padding:2.5px; margin:0px;">130</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">2018 </td>&nbsp;&nbsp;<td style="padding:2.5px; margin:0px;">300</td><td style="padding:2.5px; margin:0px;">6040</td><td style="padding:2.5px; margin:0px;">230</td></tr>
				  <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;">2019 </td>&nbsp;&nbsp;<td style="padding:2.5px; margin:0px;">400</td><td style="padding:2.5px; margin:0px;">5040</td><td style="padding:2.5px; margin:0px;">120</td></tr>
				  
				  </tr>
				 </table>
				
				  

                    </div>
 <div class="col-md-12 col-sm-12" >

                      <ul class="stats-overview">
                        
                        <li style="width:33%">
                          <span class="name"> Peak Power (kW)</span>
                          <span class="value text-success"><b> 1000 </b></span>
                        </li>
                        <li style="width:33%">
                          <span class="name">Grid Import Energy (kWh)</span>
                          <span class="value text-danger"><b> 390 </b></span>
                        </li>
						 <li style="width:33%">
                          <span class="name">Solar Production (kWh)</span>
                          <span class="value text-success"> <b> 3890 </b> </span>
                        </li>
                      </ul>
					  
					  </div>
                    <!-- start project-detail sidebar -->
                   <!-- <div class="col-md-3 col-sm-3  ">

                      <section class="panel">

                        <div class="x_title">
                          <h2>Meter Parameters</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                          <h3 class="green"><i class="fa fa-paint-brush"></i> SDSI</h3>

                          
                          <br />

                          <div class="project_detail">

                            <p class="title">Client Company</p>
                            <p>Deveint Inc</p>
                            <p class="title">Project Leader</p>
                            <p>Tony Chicken</p>
                          </div>

                          <br />
                          <h5>Project files</h5>
                          <ul class="list-unstyled project_files">
                            <li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                            </li>
                            <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                            </li>
                            <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                            </li>
                          </ul>
                          <br />

                          <div class="text-center mtop20">
                            <a href="#" class="btn btn-sm btn-primary">Add files</a>
                            <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                          </div>
                        </div>

                      </section>

                    </div>-->
                    <!-- end project-detail sidebar -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <!--Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- ECharts -->
    <script src="../vendors/echarts/dist/echarts.min.js"></script>

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="0e63e0d5a4e47e4b477b26a8-|49" defer=""></script></body>

	
	
	
	
	<!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </body>
  
</html>