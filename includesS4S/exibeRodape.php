<div id="footer">
	<div id='propagandasRodapeCentralizado'>
		<div id='propaganda1Rodape'>
				<?php
					mysql_select_db($database_mb, $mb);
					$sqlPropaganda5 = " select * from propagandas where local = 5 ";
					$propaganda5 = mysql_query($sqlPropaganda5, $mb) or die('Erro no banner!');
					$totalPropaganda5 = mysql_num_rows($propaganda5);
					
					if($totalPropaganda5 > 1){
						$rand = rand(1,$totalPropaganda5);
						$array5 = array();
						$array5Link = array();
						$i=0;

						while($rowPropaganda5 = mysql_fetch_assoc($propaganda5)){
							$array5[$i] = $rowPropaganda5['arquivo'];	
							$array5Link[$i] = $rowPropaganda5['link'];

							$i++;
						}
						
						$prop5 = $array5[$rand-1];
						$prop5Link = $array5Link[$rand-1];


						if($prop5Link != 'N'){
							if($prop5Link != ''){
								echo "<a href='".$prop5Link."' />";
									echo "<img src='adm/images/propagandas/".$prop5."' />";
								echo "</a>";
							} else {
								echo "<img src='adm/images/propagandas/".$prop5."' />";
							}
						} else {
								echo "<img src='adm/images/propagandas/".$prop5."' />";
						}

						
					} else {
						$rowPropaganda5 = mysql_fetch_assoc($propaganda5);

						if($rowPropaganda5['link'] != 'N'){
							if($rowPropaganda5['link'] != ''){
								echo "<a href='".$rowPropaganda5['link']."' />";
								echo "<img src='adm/images/propagandas/".$rowPropaganda5['arquivo']."' />";
								echo "</a>";
							} else {
								echo "<img src='adm/images/propagandas/".$rowPropaganda5['arquivo']."' />";
							}
						} else {
								echo "<img src='adm/images/propagandas/".$rowPropaganda5['arquivo']."' />";
						}

					}
				?>
		</div>

		<div id='propaganda2Rodape'>
				<?php
					mysql_select_db($database_mb, $mb);
					$sqlPropaganda6 = " select * from propagandas where local = 6";
					$propaganda6 = mysql_query($sqlPropaganda6, $mb) or die('Erro no banner!');
					$totalPropaganda6 = mysql_num_rows($propaganda6);
					
					if($totalPropaganda6 > 1){
						$rand = rand(1,$totalPropaganda6);
						$array6 = array();
						$array6Link = array();
						$i=0;

						while($rowPropaganda6 = mysql_fetch_assoc($propaganda6)){
							$array6[$i] = $rowPropaganda6['arquivo'];	
							$array6Link[$i] = $rowPropaganda6['link'];

							$i++;
						}
						
						$prop6 = $array6[$rand-1];
						$prop6Link = $array6Link[$rand-1];


						if($prop6Link != 'N'){
							if($prop6Link != ''){
								echo "<a href='".$prop6Link."' />";
									echo "<img src='adm/images/propagandas/".$prop6."' />";
								echo "</a>";
							} else {
								echo "<img src='adm/images/propagandas/".$prop6."' />";
							}
						} else {
								echo "<img src='adm/images/propagandas/".$prop6."' />";
						}

						
					} else {
						$rowPropaganda6 = mysql_fetch_assoc($propaganda6);

						if($rowPropaganda6['link'] != 'N'){
							if($rowPropaganda6['link'] != ''){
								echo "<a href='".$rowPropaganda6['link']."' />";
								echo "<img src='adm/images/propagandas/".$rowPropaganda6['arquivo']."' />";
								echo "</a>";
							} else {
								echo "<img src='adm/images/propagandas/".$rowPropaganda6['arquivo']."' />";
							}
						} else {
								echo "<img src='adm/images/propagandas/".$rowPropaganda6['arquivo']."' />";
						}

					}
				?>
		</div>

		<div id='propaganda3Rodape'>
				<?php
					mysql_select_db($database_mb, $mb);
					$sqlPropaganda7 = " select * from propagandas where local = 7 ";
					$propaganda7 = mysql_query($sqlPropaganda7, $mb) or die('Erro no banner!');
					$totalPropaganda7 = mysql_num_rows($propaganda7);
					
					if($totalPropaganda7 > 1){
						$rand = rand(1,$totalPropaganda7);
						$array7 = array();
						$array7Link = array();
						$i=0;

						while($rowPropaganda7 = mysql_fetch_assoc($propaganda7)){
							$array7[$i] = $rowPropaganda7['arquivo'];	
							$array7Link[$i] = $rowPropaganda7['link'];

							$i++;
						}
						
						$prop7 = $array7[$rand-1];
						$prop7Link = $array7Link[$rand-1];


						if($prop7Link != 'N'){
							if($prop7Link != ''){
								echo "<a href='".$prop7Link."' />";
									echo "<img src='adm/images/propagandas/".$prop7."' />";
								echo "</a>";
							} else {
								echo "<img src='adm/images/propagandas/".$prop7."' />";
							}
						} else {
								echo "<img src='adm/images/propagandas/".$prop7."' />";
						}

						
					} else {
						$rowPropaganda7 = mysql_fetch_assoc($propaganda7);

						if($rowPropaganda7['link'] != 'N'){
							if($rowPropaganda7['link'] != ''){
								echo "<a href='".$rowPropaganda7['link']."' />";
								echo "<img src='adm/images/propagandas/".$rowPropaganda7['arquivo']."' />";
								echo "</a>";
							} else {
								echo "<img src='adm/images/propagandas/".$rowPropaganda7['arquivo']."' />";
							}
						} else {
								echo "<img src='adm/images/propagandas/".$rowPropaganda7['arquivo']."' />";
						}

					}
				?>
		</div>

	 </div>

		<div id='recicle_img_rodape'>
			<img src='images/recicle_rod.png' />
		</div>
	
</div>