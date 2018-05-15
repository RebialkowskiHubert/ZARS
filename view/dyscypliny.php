<section id="dyscypliny" style="text-align: center;">
	<h1>Wybierz dyscyplinę</h1>
	<div class="container">
		<?php
		$dyscypliny=$DB->wybierz("dyscypliny", "*", "all", null, null, null);
		$kolory=['#FF7F00', '#FF3300'];
		$j=0;
		foreach ($dyscypliny as $i=>$dyscyplina) {
			if($i%3===2)
				echo '<div class="row">';

			echo '<div id="dys'.$dyscyplina["id_dyscyplina"].'" class="col-sm-4 dyscyplina" style="background-color: '.$kolory[$j].';">
					<p class="tytuldyscyplina">'.$dyscyplina["nazwa_dyscyplina"].'</p>
			</div>';

			if($i%3===2)
				echo '</div>';

			$j++;
			if($j===2)
				$j=0;
		}
		?>
	</div>
</section>