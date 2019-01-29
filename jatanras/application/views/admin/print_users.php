<style type="text/css">
	table {
    border-collapse: collapse;
    align-self: center;
}

table, th, td {
    border: 1px solid black;
    padding:8px;
}

</style>
<table border="1">
	<tr>
		<th>Username</th>
		<th>Password</th>
		<th>Cabang</th>
	</tr>

	
		<?php 

		foreach ($users as $rows) {
		?>
		<tr>
			<td><?php echo $rows->username?></td>
			<td><?php echo $rows->username?></td>
			<td><?php echo $rows->name?></td>
			</tr>
		<?php
			
		}
		?>
	
</table>