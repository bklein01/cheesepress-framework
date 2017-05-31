<?php get_header(); ?>

<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>


<table class="gridtable">
    <tr>
        <th>#</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
    </tr>
    <tr>
        <td>1</td>
        <td>Honda</td>
        <td>Accord</td>
        <td>2009</td>
    </tr>

    <tr>
        <td>2</td>
        <td>Toyota</td>
        <td>Camry</td>
        <td>2012</td>
    </tr>

    <tr>
        <td>3</td>
        <td>Hyundai</td>
        <td>Elantra</td>
        <td>2010</td>
    </tr>
</table>

<?php get_sidebar(); ?>

<?php get_footer(); ?>