<?php
/*
Plugin Name: Your categories with pie chart
Plugin URI: http://www.webania.net/category-chart/
Description: Category chart plugin lets you to put your categories chart to any post or page.
Version: 1.2.1
Author: Elvin Haci
Author URI: http://www.webania.net
License: GPL2
*/
/*  Copyright 2011,  Elvin Haci  (email : elvinhaci@hotmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
 
function category_chart($atts,$content = '') {
	
//Author: Elvin Haci
//Author url: http://webania.net
$ch_cats = get_categories(array('orderby'=>'count','order'=>'desc') );
$sayy= count($ch_cats);
$chd=''; $chl='';
for ($i=1;$i<=$sayy;$i++)
{

$chd=$chd.','."['".$ch_cats[$i-1]->name."', ".$ch_cats[$i-1]->count."]";
}
$chd=substr($chd,1);
$ch_title="My blog categories by post count"; 


$replacement='

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          [\'Category\', \'Posts\'],
          '.$chd.'
        ]);

        var options = {
          title: \''.$ch_title.'\'
        };

        var chart = new google.visualization.PieChart(document.getElementById(\'chart_div\'));
        chart.draw(data, options);
      }
    </script>

    <div id="chart_div" style="width: 450px; height: 250px;"></div>
';
	
	return $replacement;
}




add_shortcode('category-chart', 'category_chart'); 

?>
