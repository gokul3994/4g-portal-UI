
<?php
//select%20mean(value)%20from%20v%20where%20time%20>%201592764200s%20AND%20time%20<%201592850600s%20group%20by%20time(1h)
$meters = array(10439395=>array("daily_generation" => array("energy_series"=>array("query"=>"select last(value) from v where (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='KWH') ","groupby"=>"group by time(1h),f fill(null)"))));

$meters_day = array(10439395=>array("daily_generation" => array("energy_series"=>array("query"=>"select last(value) from v where (\"d\"='10439395' AND \"f\"='Deg_C') OR (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='KWH') ","groupby"=>"group by time(15m),f fill(null)")))); 

$meters_month = array(10439395=>array("monthly_generation" => array("energy_series"=>array("query"=>"select mean(value) from v where \"d\"='10439395' AND \"f\"='KWH' ","groupby"=>"group by time(1h)"))));

$meters_year = array(10439395=>array("yearly_generation" => array("energy_series"=>array("query"=>"select mean(value) from v where \"d\"='10439395' AND \"f\"='KWH' ","groupby"=>"group by time(1h)"))));

$transdate = date('m-d-Y', time());
$day = date('d');
$month = date('m');
$year = date('y');
$yearFull = date('Y');
  
$daily_generation_energy_query = $meters[$_GET['meter']]["daily_generation"]["energy_series"]["query"];
$daily_generation_energy_groupby = $meters[$_GET['meter']]["daily_generation"]["energy_series"]["groupby"];
$daily_generation_date = mktime(0,0,0,$month,$day,$year);
//$daily_generation_end_date = $daily_generation_date+86400;

$day_generation_energy_query = $meters_day[$_GET['meter']]["daily_generation"]["energy_series"]["query"];
$day_generation_energy_groupby = $meters_day[$_GET['meter']]["daily_generation"]["energy_series"]["groupby"];
$day_generation_date = mktime(0,0,0,$month,$day,$year);


$monthly_generation_energy_query = $meters_month[$_GET['meter']]["monthly_generation"]["energy_series"]["query"];
$monthly_generation_energy_groupby = $meters_month[$_GET['meter']]["monthly_generation"]["energy_series"]["groupby"];
$monthly_generation_date =$month."/".$day."/".$yearFull;

$yearly_generation_energy_query = $meters_year[$_GET['meter']]["yearly_generation"]["energy_series"]["query"];
$yearly_generation_energy_groupby = $meters_year[$_GET['meter']]["yearly_generation"]["energy_series"]["groupby"];
$yearly_generation_date = $month."/".$day."/".$yearFull;


$meter_id = $_GET['meter'];

?>



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

.rs{
  padding:0px;
  margin:0px
}
.ex3{
  margin-left:65.5%;
}
.ex4{
  margin-left:97%;
  margin-bottom:0%
}

</style>
</head>
<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code for year -->
<script>
 $( function() {
//dayPeakPower

var meter_id = '<?php echo $meter_id; ?>';
var day_calendar = '<?php echo $daily_generation_date; ?>';
function loadDayWidgets(){



}




    $( "#datepickerfromyear" ).datepicker({
        onSelect:function(selectedDate){
          //calendarSelDate = selectedDate.split("/");
          //var selTimestamp = new Date(calendarSelDate[2], calendarSelDate[0]-1, calendarSelDate[1], 0, 0, 0, 0).getTime() / 1000;
          load_yearly_generation(selectedDate);
          //alert(seconds);
        }
    });

var yearly_generation_date = '<?php echo $yearly_generation_date; ?>';
load_yearly_generation(yearly_generation_date);

function load_yearly_generation(yearly_generation_date){

$.ajax( {
				  url:'http://pv-india.eu/usaportal/production/meter_details.php?widget_id=yearGen&meter_id='+meter_id+'&year_calendar='+yearly_generation_date+'',
				  
                  success:function(realdata) {
           //alert(realdata);         
           yeargen(realdata);
                  }
               });
   
}



  function yeargen(mytestdata){
    //alert("in test function");
//alert(mytestdata);
    // Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv2", am4charts.XYChart);

// Export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.filePrefix = "SDSI_year";
    //alert(mytestdata);
    //alert(mytestdata);
    //console.log(mytestdata);
    series = JSON.parse(mytestdata);
   /*[{"name":"v","columns":["time","mean"],"values":[["2020-02-08T00:00:00Z",185.27858405596],["2020-03-09T00:00:00Z",146.52633922773],["2020-04-08T00:00:00Z",142.21535513506],["2020-05-08T00:00:00Z",149.57406825825],["2020-06-07T00:00:00Z",126.74245426379],["2020-07-07T00:00:00Z",null]]}]*/
    if(series.length == 0){
      //
      chart.data = [];
      chart.validateData();
      //return
    }

    var i;
    var data = [];
      for (i = 0; i < series[0].values.length; i++){
        //alert(series[0].values[i]);
        tmpObj = {};
        tmpObj["year"]   = series[0].values[i][0].substring(5,7);
        tmpObj["export"] = series[0].values[i][1];
		tmpObj["import"] = series[1].values[i][1];
        data.push(tmpObj);
      }
    
   // alert(series[1].values[0][1]);
  
console.log(data);


/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.minGridDistance = 30;

/* Create value axis */
//var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.dataFields.value = "energy";




/* Create series */
/*var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "Grid Import energy";
columnSeries.dataFields.valueY = "energy";
columnSeries.fill = am4core.color("#FB191F");

columnSeries.dataFields.categoryX = "month";

columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";
*/
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "Solar energy";
columnSeries.dataFields.valueY = "import";
columnSeries.fill = am4core.color("#60f763");
columnSeries.dataFields.categoryX = "year";
columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";

var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "Solar Active power";
lineSeries.dataFields.valueY = "export";
lineSeries.dataFields.categoryX = "year";
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

// Add legend
chart.legend = new am4charts.Legend();

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.data = data;

//Updating the graph to show the new data

        
}
//});

//chart.validateData();





  });
</script>
<!-- chart code for year ends -->
<!-- Chart code for month -->
<script>
 $( function() {
//dayPeakPower

var meter_id = '<?php echo $meter_id; ?>';
var day_calendar = '<?php echo $daily_generation_date; ?>';
function loadDayWidgets(){



}
/*
function loadDayPeakPower(){

$.ajax( {
                  url:'http://pv-india.eu/usaportal/production/meter_details.php?widget_id=dayPeakPower&meter_id='+meter_id+"&calendar=",
                  success:function(realdata) {
           //alert(realdata);         
           monthgen(realdata);
                  }
               });

}

*/
    $( "#datepickerfrom" ).datepicker({
        onSelect:function(selectedDate){
          //calendarSelDate = selectedDate.split("/");
          //var selTimestamp = new Date(calendarSelDate[2], calendarSelDate[0]-1, calendarSelDate[1], 0, 0, 0, 0).getTime() / 1000;
          load_monthly_generation(selectedDate);
          //alert(seconds);
        }
    });

var monthly_generation_date = '<?php echo $monthly_generation_date; ?>';
load_monthly_generation(monthly_generation_date);

function load_monthly_generation(monthly_generation_date){

$.ajax( {
				  url:'http://pv-india.eu/usaportal/production/meter_details.php?widget_id=monthGen&meter_id='+meter_id+'&month_calendar='+monthly_generation_date+'',
                  success:function(realdata) {
           //alert(realdata);         
           monthgen(realdata);
                  }
               });
   
}
/*
var monthly_generation_energy_query = '<?php echo addslashes($monthly_generation_energy_query); ?>';
var monthly_generation_energy_groupby = '<?php echo addslashes($monthly_generation_energy_groupby); ?>';
var monthly_generation_date = '<?php echo addslashes($monthly_generation_date); ?>';
//var daily_generation_end_date = '<?php echo addslashes($daily_generation_end_date); ?>';
load_monthly_generation(monthly_generation_date);
function load_monthly_generation(monthly_generation_date){
  //alert(daily_generation_date);
  //$("#daily_generation_query").val();
  //$("#daily_generation_groupby").val();
  //$("#daily_generation_date").val();
  //$("#daily_generation_end_date").val();
  monthly_generation_end_date = parseInt(monthly_generation_date) + 86400;
  monthly_gen_query_str = monthly_generation_energy_query+"AND time > "+monthly_generation_date+"s AND time < "+monthly_generation_end_date+"s "+monthly_generation_energy_groupby;
  //alert(monthly_gen_query_str);
  //alert(monthly_generation_end_date);
  
  
//var obj = JSON.parse('[{"name":"scaback_csv","columns":["time","last"],"values":[["2020-01-28t05:00:46.314546553z",0.9]]}]');
  $.ajax( {
                  url:'http://pv-india.eu/usaportal/production/api.php?query_type=direct&query_str='+monthly_gen_query_str,
                  success:function(realdata) {
           //alert(realdata);         
           monthgen(realdata);
                  }
               });
}
          
 */    
//var a=JSON.stringify(obj[0].values[0]);


  function monthgen(mytestdata){
    //alert("in test function");
//alert(mytestdata);
    // Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv2a", am4charts.XYChart);

// Export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.filePrefix = "SDSI_month";
    //alert(mytestdata);
    //alert(mytestdata);
    //console.log(mytestdata);
    series = JSON.parse(mytestdata);
   /*[{"name":"v","columns":["time","mean"],"values":[["2020-02-08T00:00:00Z",185.27858405596],["2020-03-09T00:00:00Z",146.52633922773],["2020-04-08T00:00:00Z",142.21535513506],["2020-05-08T00:00:00Z",149.57406825825],["2020-06-07T00:00:00Z",126.74245426379],["2020-07-07T00:00:00Z",null]]}]*/
    if(series.length == 0){
      //
      chart.data = [];
      chart.validateData();
      //return
    }

    var i;
    var data = [];
      for (i = 0; i < series[0].values.length; i++){
        //alert(series[0].values[i]);
        tmpObj = {};
        tmpObj["month"]   = series[0].values[i][0].substring(8,10);
        tmpObj["export"] = series[0].values[i][1];
		tmpObj["import"] = series[1].values[i][1];
        data.push(tmpObj);
      }
    
   // alert(series[1].values[0][1]);
  
console.log(data);


/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "month";
categoryAxis.renderer.minGridDistance = 30;

/* Create value axis */
//var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.dataFields.value = "energy";




/* Create series */
/*var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "Grid Import energy";
columnSeries.dataFields.valueY = "energy";
columnSeries.fill = am4core.color("#FB191F");

columnSeries.dataFields.categoryX = "month";

columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";
*/
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "Solar energy";
columnSeries.dataFields.valueY = "import";
columnSeries.fill = am4core.color("#60f763");
columnSeries.dataFields.categoryX = "month";
columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";

var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "Solar Active power";
lineSeries.dataFields.valueY = "export";
lineSeries.dataFields.categoryX = "month";
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

// Add legend
chart.legend = new am4charts.Legend();

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.data = data;

//Updating the graph to show the new data

        
}
//});

//chart.validateData();





  });
</script>

<!-- Chart code for systemview -->
<script>
 $( function() {





    $( "#datepickersys" ).datepicker({
        onSelect:function(selectedDate){
          
          calendarSelDate = selectedDate.split("/");
          var selTimestamp = new Date(calendarSelDate[2], calendarSelDate[0]-1, calendarSelDate[1], 0, 0, 0, 0).getTime() / 1000;
          load_day_generation(selTimestamp+19800);
          //alert(seconds);
        }
    });





   



var day_generation_energy_query = '<?php echo addslashes($day_generation_energy_query); ?>';
var day_generation_energy_groupby = '<?php echo addslashes($day_generation_energy_groupby); ?>';
var day_generation_date = '<?php echo addslashes($day_generation_date); ?>';
//var daily_generation_end_date = '<?php echo addslashes($daily_generation_end_date); ?>';


load_day_generation(day_generation_date);

function load_day_generation(day_generation_date){
  //alert(daily_generation_date);
  //$("#daily_generation_query").val();
  //$("#daily_generation_groupby").val();
  //$("#daily_generation_date").val();
  //$("#daily_generation_end_date").val();
  day_generation_end_date = parseInt(day_generation_date) + 86400;
  day_gen_query_str = day_generation_energy_query+"AND time > "+day_generation_date+"s AND time < "+day_generation_end_date+"s "+day_generation_energy_groupby;
   
  //alert(day_gen_query_str);
  
  

//var obj = JSON.parse('[{"name":"scaback_csv","columns":["time","last"],"values":[["2020-01-28t05:00:46.314546553z",0.9]]}]');
  $.ajax( {
                  url:'http://pv-india.eu/usaportal/production/api.php?query_type=direct&query_str='+day_gen_query_str,
                  success:function(real) {
           //alert(real);         
           daygen(real);
		  
		   
                  }
               });
}

           
     
//var a=JSON.stringify(obj[0].values[0]);


  function daygen(mytestdata){
    //alert("in test function");

    // Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv3", am4charts.XYChart);

// Export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.filePrefix = "SDSI_systemview";
    

    //alert(mytestdata);
    //alert(mytestdata);
    //console.log(mytestdata);
    series = JSON.parse(mytestdata);
    /*[{"name":"v","columns":["time","mean"],"values":[["2020-02-08T00:00:00Z",185.27858405596],["2020-03-09T00:00:00Z",146.52633922773],["2020-04-08T00:00:00Z",142.21535513506],["2020-05-08T00:00:00Z",149.57406825825],["2020-06-07T00:00:00Z",126.74245426379],["2020-07-07T00:00:00Z",null]]}]*/
    if(series.length == 0){
      //
      chart.data = [];
      chart.validateData();
      //return
    }

    var i;
    var data = [];
      for (i = 0; i < series[0].values.length; i++){
        //alert(series[0].values[i]);
        tmpObj = {};
        tmpObj["sample"]   = series[0].values[i][0].substring(11,16);
        tmpObj["temp"] = series[0].values[i][1];
		tmpObj["export"] = series[1].values[i][1];
		tmpObj["import"] = series[2].values[i][1];
        data.push(tmpObj);
      }

    //var a=JSON.parse(mytestdata);
    //var b=JSON.stringify(a[0].values[i]);
    //var d=JSON.stringify(a[0].values[i+1]);
    //var c=b.substring(10,12);
    //var e=d.substring(10,12);
    

    
  
     /*var data=[{
  "hour":c,
  "energy":a[0].values[i][1]
     
     },
   {
  "hour":e,
  "energy":a[0].values[i+1][1]
     
     }];*/
  
console.log(data);


/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "sample";
categoryAxis.renderer.minGridDistance = 30;

/* Create value axis */
//var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.dataFields.value = "export";




/* Create series */
/*
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
*/
var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "Solar Energy";
lineSeries.dataFields.valueY = "import";
lineSeries.dataFields.categoryX = "sample";

lineSeries.stroke = am4core.color("#60f763");
lineSeries.strokeWidth = 3;
lineSeries.propertyFields.strokeDasharray = "lineDash";
lineSeries.tooltip.label.textAlign = "middle";

var bullet = lineSeries.bullets.push(new am4charts.Bullet());
bullet.fill = am4core.color("#60f763"); // tooltips grab fill from parent by default
bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
var circle = bullet.createChild(am4core.Circle);
circle.radius = 2;
circle.fill = am4core.color("#fff");
circle.strokeWidth = 2;




var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "Solar Active Power";
lineSeries.dataFields.valueY = "export";
lineSeries.dataFields.categoryX = "sample";

lineSeries.stroke = am4core.color("#f7a90c");
lineSeries.strokeWidth = 3;
lineSeries.propertyFields.strokeDasharray = "lineDash";
lineSeries.tooltip.label.textAlign = "middle";

var bullet = lineSeries.bullets.push(new am4charts.Bullet());
bullet.fill = am4core.color("#f7a90c"); // tooltips grab fill from parent by default
bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
var circle = bullet.createChild(am4core.Circle);
circle.radius = 2;
circle.fill = am4core.color("#fff");
circle.strokeWidth = 2;

var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "Temperature";
lineSeries.dataFields.valueY = "temp";
lineSeries.dataFields.categoryX = "sample";

lineSeries.stroke = am4core.color("#6666ff");
lineSeries.strokeWidth = 3;
lineSeries.propertyFields.strokeDasharray = "lineDash";
lineSeries.tooltip.label.textAlign = "middle";

var bullet = lineSeries.bullets.push(new am4charts.Bullet());
bullet.fill = am4core.color("#6666ff"); // tooltips grab fill from parent by default
bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff font-size: 20px]{valueY2}[/]"
var circle = bullet.createChild(am4core.Circle);
circle.radius = 2;
circle.fill = am4core.color("#fff");
circle.strokeWidth = 2;

// Add legend
chart.legend = new am4charts.Legend();

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.data = data;

//Updating the graph to show the new data

        
}
//});

//chart.validateData();





  });

 




</script>
 <script>
/*function selFunction(){
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
}*/

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





    $( "#daydatepicker" ).datepicker({
        onSelect:function(selectedDate){
          
          calendarSelDate = selectedDate.split("/");
          var selTimestamp = new Date(calendarSelDate[2], calendarSelDate[0]-1, calendarSelDate[1], 0, 0, 0, 0).getTime() / 1000;
          load_daily_generation(selTimestamp+19800);
          //alert(seconds);
        }
    });





   



var daily_generation_energy_query = '<?php echo addslashes($daily_generation_energy_query); ?>';
var daily_generation_energy_groupby = '<?php echo addslashes($daily_generation_energy_groupby); ?>';
var daily_generation_date = '<?php echo addslashes($daily_generation_date); ?>';
//var daily_generation_end_date = '<?php echo addslashes($daily_generation_end_date); ?>';


load_daily_generation(daily_generation_date);

function load_daily_generation(daily_generation_date){
  //alert(daily_generation_date);
  //$("#daily_generation_query").val();
  //$("#daily_generation_groupby").val();
  //$("#daily_generation_date").val();
  //$("#daily_generation_end_date").val();
  daily_generation_end_date = parseInt(daily_generation_date) + 86400;
  daily_gen_query_str = daily_generation_energy_query+"AND time > "+daily_generation_date+"s AND time < "+daily_generation_end_date+"s "+daily_generation_energy_groupby;
   
  //alert(daily_gen_query_str);
  
  

//var obj = JSON.parse('[{"name":"scaback_csv","columns":["time","last"],"values":[["2020-01-28t05:00:46.314546553z",0.9]]}]');
  $.ajax( {
                  url:'http://pv-india.eu/usaportal/production/api.php?query_type=direct&query_str='+daily_gen_query_str,
                  success:function(realdata) {
           //alert(realdata);         
           test(realdata);
		  
		   
                  }
               });
}

           
     
//var a=JSON.stringify(obj[0].values[0]);


  function test(mytestdata){
    //alert("in test function");

    // Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv1", am4charts.XYChart);

// Export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.filePrefix = "SDSI_daily";
    

    //alert(mytestdata);
    //alert(mytestdata);
    //console.log(mytestdata);
    series = JSON.parse(mytestdata);
    /*[{"name":"v","columns":["time","mean"],"values":[["2020-02-08T00:00:00Z",185.27858405596],["2020-03-09T00:00:00Z",146.52633922773],["2020-04-08T00:00:00Z",142.21535513506],["2020-05-08T00:00:00Z",149.57406825825],["2020-06-07T00:00:00Z",126.74245426379],["2020-07-07T00:00:00Z",null]]}]*/
    if(series.length == 0){
      //
      chart.data = [];
      chart.validateData();
      //return
    }

    var i;
    var data = [];
      for (i = 0; i < series[0].values.length; i++){
        //alert(series[0].values[i]);
        tmpObj = {};
        tmpObj["hour"]   = series[0].values[i][0].substring(11,13);
        tmpObj["export"] = series[0].values[i][1];
		tmpObj["import"] = series[1].values[i][1];
        data.push(tmpObj);
      }

    //var a=JSON.parse(mytestdata);
    //var b=JSON.stringify(a[0].values[i]);
    //var d=JSON.stringify(a[0].values[i+1]);
    //var c=b.substring(10,12);
    //var e=d.substring(10,12);
    

    
  
     /*var data=[{
  "hour":c,
  "energy":a[0].values[i][1]
     
     },
   {
  "hour":e,
  "energy":a[0].values[i+1][1]
     
     }];*/
  
console.log(data);


/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "hour";
categoryAxis.renderer.minGridDistance = 30;

/* Create value axis */
//var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.dataFields.value = "energy";




/* Create series */
/*
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
*/
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "Solar Energy";
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
lineSeries.name = "Solar Active Power";
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

// Add legend
chart.legend = new am4charts.Legend();

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.data = data;

//Updating the graph to show the new data

        
}
//});

//chart.validateData();





  });

  /*$( function() {
    $( "#daydatepicker" ).datepicker();
    $( "#datepickersys" ).datepicker();
    $( "#datepickerfrom" ).datepicker();   
    $( "#datepickerfromyear" ).datepicker();
  } );*/
  






  </script>
  <script>
   $.ajax( {
                  url:'http://pv-india.eu/usaportal/production/meter_details.php?widget_id=topwidget',
                  success:function(topdata) {
           //alert(realdata);         
           widgettop(topdata);
		  
		   
                  }
               }); 
			   
	function widgettop(data){
		
		
		 var seriestop = JSON.parse(data);
		lastcomm=seriestop[3].values[0][1];
		document.getElementById("lastcomm").innerHTML=lastcomm;
		temp=(seriestop[1].values[0][1]*9/5)+32;
		tempr=parseFloat(temp).toFixed(2);
		document.getElementById("temp").innerHTML=tempr;
		comm=seriestop[0].values[0][1];
		if(comm==1){
			var a=document.createElement("button");
			a.setAttribute('class','btn btn-success');
			document.body.appendChild(a);
		document.getElementById("comm").appendChild(a);
		}else{
			var b=document.createElement("button");
			b.setAttribute('class','btn btn-danger');
			document.body.appendChild(b);
		document.getElementById("comm").appendChild(b);
			
		}
		
		power=seriestop[2].values[0][1];
		if (power > 0 || comm==1){
			var c=document.createElement("button");
			c.setAttribute('class','btn btn-success');
			document.body.appendChild(c);
		document.getElementById("status").appendChild(c);
		}else if(power <=0 || comm==1 ){
			var d=document.createElement("button");
			d.setAttribute('class','btn btn-warning');
			document.body.appendChild(d);
		document.getElementById("status").appendChild(d);
			}else{
				var e=document.createElement("button");
			e.setAttribute('class','btn btn-danger');
			document.body.appendChild(e);
		document.getElementById("status").appendChild(e);
			}
			
	}
  $.ajax( {
                  url:'http://pv-india.eu/usaportal/production/meter_details.php?widget_id=daywidget',
                  success:function(realdata) {
           //alert(realdata);         
           widgetday(realdata);
		  
		   
                  }
               }); 
			   
	function widgetday(mydata){
		
		
		 var series = JSON.parse(mydata);
		daypeak=series[2].values[0][1];
		document.getElementById("dayPeakPower").innerHTML=daypeak;
		dayact=series[0].values[0][1];
		document.getElementById("dayActPower").innerHTML=dayact;
		daypro=series[1].values[0][1];
		document.getElementById("daySolarProduction").innerHTML=daypro;
		document.getElementById("dayGridImportEnergy").innerHTML=0;
	}


$.ajax( {
                  url:'http://pv-india.eu/usaportal/production/meter_details.php?widget_id=monthwidget',
                  success:function(datareal) {
           //alert(realdata);         
           widgetmonth(datareal);
		  
		   
                  }
               }); 
			   
	function widgetmonth(mydatareal){
		
		
		 var seriesmonth = JSON.parse(mydatareal);
		monthpeak=seriesmonth[2].values[0][1];
		document.getElementById("monthPeakPower").innerHTML=monthpeak;
		monthact=seriesmonth[0].values[0][1];
		document.getElementById("monthActPower").innerHTML=monthact;
		monthpro=seriesmonth[1].values[0][1];
		document.getElementById("monthSolarProduction").innerHTML=monthpro;
		
	}

$.ajax( {
                  url:'http://pv-india.eu/usaportal/production/meter_details.php?widget_id=lifetimewidget',
                  success:function(data) {
           //alert(realdata);         
           widgetlifetime(data);
		  
		   
                  }
               }); 
			   
	function widgetlifetime(datareal){
		
		
		 var serieslifetime = JSON.parse(datareal);
		
		lifeact=serieslifetime[0].values[0][1];
		
		document.getElementById("lifetimepower").innerHTML=lifeact;
		lifepro=serieslifetime[1].values[0][1];
		document.getElementById("lifetimeenergy").innerHTML=lifepro;
		
	}
</script>	
 <script type="text/javascript">
		
		$.ajax( {
                  url:'http://pv-india.eu/usaportal/production/meter_details.php?widget_id=yeartablewidget',
                  success:function(datas) {
           //alert(realdata);         
           widgetyeartable(datas);
		  
		   
                  }
               }); 
			   
	function widgetyeartable(datareal){
		
		
		 var seriesyeartable = JSON.parse(datareal);
		 
		 var i;
    
      for (i = 0; i < 12; i++){
		  yeartable1=seriesyeartable[0].values[0][0].substring(0,4);
		  document.getElementById("yeartablea0").innerHTML=yeartable1;
         peakpower1=seriesyeartable[2].values[0][1];
		document.getElementById("yeartableb0").innerHTML=peakpower1;
         production1=seriesyeartable[0].values[0][1];
		document.getElementById("yeartablec0").innerHTML=production1;
		 energy1=seriesyeartable[1].values[0][1];
		document.getElementById("yeartabled0").innerHTML=energy1;
		
		yeartable2=seriesyeartable[3].values[0][0].substring(0,4);
		  document.getElementById("yeartablea1").innerHTML=yeartable2;
         peakpower2=seriesyeartable[5].values[0][1];
		document.getElementById("yeartableb1").innerHTML=peakpower2;
         production2=seriesyeartable[3].values[0][1];
		document.getElementById("yeartablec1").innerHTML=production2;
		 energy2=seriesyeartable[4].values[0][1];
		document.getElementById("yeartabled1").innerHTML=energy2;
		
		yeartable3=seriesyeartable[6].values[0][0].substring(0,4);
		  document.getElementById("yeartablea2").innerHTML=yeartable3;
         peakpower3=seriesyeartable[8].values[0][1];
		document.getElementById("yeartableb2").innerHTML=peakpower3;
         production3=seriesyeartable[6].values[0][1];
		document.getElementById("yeartablec2").innerHTML=production3;
		 energy3=seriesyeartable[7].values[0][1];
		document.getElementById("yeartabled2").innerHTML=energy3;
		
		yeartable4=seriesyeartable[9].values[0][0].substring(0,4);
		  document.getElementById("yeartablea3").innerHTML=yeartable4;
         peakpower4=seriesyeartable[11].values[0][1];
		document.getElementById("yeartableb3").innerHTML=peakpower4;
         production4=seriesyeartable[9].values[0][1];
		document.getElementById("yeartablec3").innerHTML=production4;
		 energy4=seriesyeartable[10].values[0][1];
		document.getElementById("yeartabled3").innerHTML=energy4;
	   
	   yeartable5=seriesyeartable[12].values[0][0].substring(0,4);
		  document.getElementById("yeartablea4").innerHTML=yeartable5;
         peakpower5=seriesyeartable[14].values[0][1];
		document.getElementById("yeartableb4").innerHTML=peakpower5;
         production5=seriesyeartable[12].values[0][1];
		document.getElementById("yeartablec4").innerHTML=production5;
		 energy5=seriesyeartable[13].values[0][1];
		document.getElementById("yeartabled4").innerHTML=energy5;
	  }
		
	}	

    
		</script>
		<script type="text/javascript">
		
		$.ajax( {
                  url:'http://pv-india.eu/usaportal/production/meter_details.php?widget_id=monthtablewidget',
                  success:function(data) {
           //alert(realdata);         
           widgetmonthtable(data);
		  
		   
                  }
               }); 
			   
	function widgetmonthtable(datareal){
		
		
		 var seriesmonthtable = JSON.parse(datareal);
		 
		 var i;
    
      for (i = 0; i < 12; i++){
		  monthtable1=seriesmonthtable[0].values[0][0].substring(0,7);
		  document.getElementById("monthtablea0").innerHTML=monthtable1;
         peakpower1=seriesmonthtable[2].values[0][1];
		document.getElementById("monthtableb0").innerHTML=peakpower1;
         production1=seriesmonthtable[0].values[0][1];
		document.getElementById("monthtablec0").innerHTML=production1;
		 energy1=seriesmonthtable[1].values[0][1];
		document.getElementById("monthtabled0").innerHTML=energy1;
		
		monthtable2=seriesmonthtable[0].values[1][0].substring(0,7);
		  document.getElementById("monthtablea1").innerHTML=monthtable2;
         peakpower2=seriesmonthtable[2].values[1][1];
		document.getElementById("monthtableb1").innerHTML=peakpower2;
         production2=seriesmonthtable[0].values[1][1];
		document.getElementById("monthtablec1").innerHTML=production2;
		 energy2=seriesmonthtable[1].values[1][1];
		document.getElementById("monthtabled1").innerHTML=energy2;
		
		monthtable3=seriesmonthtable[0].values[2][0].substring(0,7);
		  document.getElementById("monthtablea2").innerHTML=monthtable3;
         peakpower3=seriesmonthtable[2].values[2][1];
		document.getElementById("monthtableb2").innerHTML=peakpower3;
         production3=seriesmonthtable[0].values[2][1];
		document.getElementById("monthtablec2").innerHTML=production3;
		 energy3=seriesmonthtable[1].values[2][1];
		document.getElementById("monthtabled2").innerHTML=energy3;
		
		monthtable4=seriesmonthtable[0].values[3][0].substring(0,7);
		  document.getElementById("monthtablea3").innerHTML=monthtable4;
         peakpower4=seriesmonthtable[2].values[3][1];
		document.getElementById("monthtableb3").innerHTML=peakpower4;
         production4=seriesmonthtable[0].values[3][1];
		document.getElementById("monthtablec3").innerHTML=production4;
		 energy4=seriesmonthtable[1].values[3][1];
		document.getElementById("monthtabled3").innerHTML=energy4;
	   
	   monthtable5=seriesmonthtable[0].values[4][0].substring(0,7);
		  document.getElementById("monthtablea4").innerHTML=monthtable5;
         peakpower5=seriesmonthtable[1].values[4][1];
		document.getElementById("monthtableb4").innerHTML=peakpower5;
         production5=seriesmonthtable[0].values[4][1];
		document.getElementById("monthtablec4").innerHTML=production5;
		 energy5=seriesmonthtable[2].values[4][1];
		document.getElementById("monthtabled4").innerHTML=energy5;
		
		monthtable6=seriesmonthtable[0].values[5][0].substring(0,7);
		  document.getElementById("monthtablea5").innerHTML=monthtable6;
         peakpower6=seriesmonthtable[2].values[5][1];
		document.getElementById("monthtableb5").innerHTML=peakpower6;
         production6=seriesmonthtable[0].values[5][1];
		document.getElementById("monthtablec5").innerHTML=production6;
		 energy6=seriesmonthtable[1].values[5][1];
		document.getElementById("monthtabled5").innerHTML=energy6;
		
		monthtable7=seriesmonthtable[0].values[6][0].substring(0,7);
		  document.getElementById("monthtablea6").innerHTML=monthtable7;
         peakpower7=seriesmonthtable[2].values[6][1];
		document.getElementById("monthtableb6").innerHTML=peakpower7;
         production7=seriesmonthtable[0].values[6][1];
		document.getElementById("monthtablec6").innerHTML=production7;
		 energy7=seriesmonthtable[1].values[6][1];
		document.getElementById("monthtabled6").innerHTML=energy7;
		
		monthtable8=seriesmonthtable[0].values[7][0].substring(0,7);
		  document.getElementById("monthtablea7").innerHTML=monthtable8;
         peakpower8=seriesmonthtable[2].values[7][1];
		document.getElementById("monthtableb7").innerHTML=peakpower8;
         production8=seriesmonthtable[0].values[7][1];
		document.getElementById("monthtablec7").innerHTML=production8;
		 energy8=seriesmonthtable[1].values[7][1];
		document.getElementById("monthtabled7").innerHTML=energy8;
		
		monthtable9=seriesmonthtable[0].values[8][0].substring(0,7);
		  document.getElementById("monthtablea8").innerHTML=monthtable9;
         peakpower9=seriesmonthtable[2].values[8][1];
		document.getElementById("monthtableb8").innerHTML=peakpower9;
         production9=seriesmonthtable[0].values[8][1];
		document.getElementById("monthtablec8").innerHTML=production9;
		 energy9=seriesmonthtable[1].values[8][1];
		document.getElementById("monthtabled8").innerHTML=energy9;
	   
	   monthtable10=seriesmonthtable[0].values[9][0].substring(0,7);
		  document.getElementById("monthtablea9").innerHTML=monthtable10;
         peakpower10=seriesmonthtable[2].values[9][1];
		document.getElementById("monthtableb9").innerHTML=peakpower10;
         production10=seriesmonthtable[0].values[9][1];
		document.getElementById("monthtablec9").innerHTML=production10;
		 energy10=seriesmonthtable[1].values[9][1];
		document.getElementById("monthtabled9").innerHTML=energy10;
		
		 monthtable11=seriesmonthtable[0].values[10][0].substring(0,7);
		  document.getElementById("monthtablea10").innerHTML=monthtable11;
         peakpower11=seriesmonthtable[2].values[10][1];
		document.getElementById("monthtableb10").innerHTML=peakpower11;
         production11=seriesmonthtable[0].values[10][1];
		document.getElementById("monthtablec10").innerHTML=production11;
		 energy11=seriesmonthtable[1].values[10][1];
		document.getElementById("monthtabled10").innerHTML=energy11;
		
		 monthtable12=seriesmonthtable[0].values[11][0].substring(0,7);
		  document.getElementById("monthtablea11").innerHTML=monthtable12;
         peakpower12=seriesmonthtable[2].values[11][1];
		document.getElementById("monthtableb11").innerHTML=peakpower12;
         production12=seriesmonthtable[0].values[11][1];
		document.getElementById("monthtablec11").innerHTML=production12;
		 energy12=seriesmonthtable[1].values[11][1];
		document.getElementById("monthtabled11").innerHTML=energy12;
	  }
		
	}	

    
		</script>
	<script>
function export1(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
function export2(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
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
              <a href="index.html" class="site_title"><span>SDSI</span></a>
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
                            <li><a href=""><i class="fa fa-file-word-o"></i> Documents.docx</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-pdf-o"></i> Drawings.pdf</a>
                            </li>
                           <!--<li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                            </li>
                            <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                            </li>-->
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
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
                      <a class="dropdown-item"  href="login.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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
                        <li style="width:24%;">
                          <span class="name"> Plant Status </span>
                          <span class="value text-success" id="status">  </span>
                        </li>
						
                        <li style="width:24%;">
                          <span class="name"> Latest Interval Data Read </span>
                          <span class="value text-none" id="lastcomm"><b></b></span>
                        </li>
						
						
						<li style="width:24%;">
                          <span class="name"> Temperature (F) </span>
                          <span class="value text-none" id="temp"><b></b></span>
                        </li>
						
						
                        <li class="hidden-phone" style="width:24%;">
                          <span class="name"> Communication status </span>
                          <span class="value text-success" id="comm">  </span>
                        </li>
                      </ul>
                      <br />
            
                        <h3 align="left">Daily Generation</h3>
                      <!--<div id="mainb" style="height:350px;"></div>-->
            
          <p align="center">Select Date: <input type="text" id="daydatepicker" placeholder="Choose a Date"></p>
          
            
            <br>
            
            <br>
            <h6 align="right">Export</h6>
            <div id="chartdiv1" style="width:100%;"><img src="images/loading.gif" id="dayloading"></div>
            
            <div class="col-md-12 col-sm-12" >

                      <ul class="stats-overview">
                        <li style="width:24%">
                          <span class="name"> Peak Power (kW)</span>
                          <span class="value text-warning"><p id="dayPeakPower"></p></span>
                        </li>
                        <li style="width:24%">
                          <span class="name"> Solar Active Power (kW)</span>
                          <span class="value text-warning"><p id="dayActPower"></p> </span>
                        </li>
                        <li style="width:24%">
                          <span class="name">Grid Import Energy (kWh)</span>
                          <span class="value text-danger"><p id="dayGridImportEnergy"></p></span>
                        </li>
             <li style="width:24%">
                          <span class="name">Solar Production (kWh)</span>
                          <span class="value text-success"><p id="daySolarProduction"></p></span>
                        </li>
                      </ul>
            
            </div>
        
            <br>
                    <br>
           <br>
           <br>
           <h3 align="left">Systemview Graph</h3>
           
                     <div class="col-md-4 col-sm-4  tile">
           <!--
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
        <br> -->
              
  
           
            </div>
            <p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Date: <input type="text" id="datepickersys" placeholder="Choose a Date"></p>
            <br>
            <br>
             <h6 align="right">Export</h6>
           <div id="chartdiv3" style="height:300px;width:100%;" ></div>
           <br>
           <br>
         
           
            <h3 align="left">Monthly Generation</h3>
           <!--<div class="col-md-4 col-sm-4  tile">
           
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
            <br>--->
            
            <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Date: <input type="text" id="datepickerfrom" placeholder="Choose a Date"></p>
            
           <br>
           <br>
            <div class="row">
			<h6 class="ex3">Export</h6>
			<input type="button" name="Export" OnClick="export1('monthtable','monthdata')" style="text-align:right" class="ex4" value="..."></input>
          </div>
             <div class="row">     
          <div id="chartdiv2a" style="height:300px;width:70%;"></div>
          
          <div class="table table-bordered" id="monthtable">
          <table>
          
          <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;"><u>Month-Wise</td><td style="padding:2.5px; margin:0px;"><u>Peak (kW)</td><td style="padding:2.5px; margin:0px;"><u>Solar prd.(kWh)</td><td style="padding:2.5px; margin:0px;"><u>Grid import(kWh)</td></u></tr>
            <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea0"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb0"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec0"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled0"></td></tr>
            <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea1"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb1"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec1"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled1"></td></tr>
		    <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea2"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb2"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec2"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled2"></td></tr>
			<tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea3"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb3"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec3"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled3"></td></tr>
	        <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea4"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb4"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec4"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled4"></td></tr>
            <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea5"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb5"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec5"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled5"></td></tr>
            <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea6"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb6"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec6"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled6"></td></tr>
		    <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea7"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb7"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec7"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled7"></td></tr>
			<tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea8"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb8"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec8"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled8"></td></tr>
	        <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea9"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb9"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec9"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled9"></td></tr>
			<tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea10"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb10"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec10"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled10"></td></tr>
			<tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="monthtablea11"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtableb11"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtablec11"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="monthtabled11"></td></tr>
	
         </table>
         
          

                    </div>
					</div>
					<br>
					<div class="col-md-12 col-sm-12" >

                      <ul class="stats-overview">
                        
                        <li style="width:33%">
                          <span class="name"> Peak Power (kW)</span>
                          <span class="value text-warning"><b><p id="monthPeakPower"></p>  </b></span>
                        </li>
                        <li style="width:33%">
                          <span class="name">Solar Active Power (kW)</span>
                          <span class="value text-warning"><b><p id="monthActPower"></p>  </b></span>
                        </li>
             <li style="width:33%">
                          <span class="name">Solar Production (kWh)</span>
                          <span class="value text-success"> <b> <p id="monthSolarProduction"></p> </b> </span>
                        </li>
                      </ul>
            
            </div>
			<br>
			<br>
				
<br>
<br>
<br>
				<h3 align="left">Yearly Generation</h3>
					
            <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Date: <input type="text" id="datepickerfromyear" placeholder="Choose a Date"></p>
            <br>
           <br>
            <div class="row">
			<h6 class="ex3">Export</h6>
			<input type="button" name="Export" OnClick="export2('yeartable','yeardata')" style="text-align:right" class="ex4"value="..."></input>
          </div>
					<div class="row">
		 <div id="chartdiv2" style="height:300px;width:70%;"></div>			
          <div class="table" id="yeartable" >
          <table>
          <tr>
          <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;"><u>Year-Wise</td>&nbsp;<td style="padding:2.5px; margin:0px;"><u>Peak (kW)</td>&nbsp;<td style="padding:2.5px; margin:0px;"><u>Solar prod.(kW)</td>&nbsp;<td style="padding:2.5px; margin:0px;"><u>Solar Energy(kWh)</td></u></tr>
            <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="yeartablea0"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartableb0"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartablec0"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartabled0"></td></tr>
            <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="yeartablea1"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartableb1"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartablec1"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartabled1"></td></tr>
		    <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="yeartablea2"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartableb2"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartablec2"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartabled2"></td></tr>
			<tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="yeartablea3"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartableb3"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartablec3"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartabled3"></td></tr>
	        <tr style="padding:2.5px; margin:0px;"><td style="padding:2.5px; margin:0px;" id="yeartablea4"> </td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartableb4"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartablec4"></td>&nbsp;<td style="padding:2.5px; margin:0px;" id="yeartabled4"></td></tr>
          
          </tr>
         </table>
        
          

                    </div>
					</div>
 <div class="col-md-12 col-sm-12" >

                      <ul class="stats-overview">
                        
                        
                        <li style="width:49%">
                          <span class="name">Lifetime Solar Active Power (kW)</span>
                          <span class="value text-warning"><b> <p id="lifetimepower"></p> </b></span>
                        </li>
             <li style="width:49%">
                          <span class="name">Lifetime Solar Production (kWh)</span>
                          <span class="value text-success"> <b> <p id="lifetimeenergy"></p> </b> </span>
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
