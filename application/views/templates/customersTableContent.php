<?php

	foreach($customers as $customer){
		echo "<tr><td style='vertical-align: middle !important; width: 50px;'><img class='img-circle' src='".base_url().(!empty($customer->profilephoto) ? $customer->profilephoto : 'img/no_image.png')."' width='50'/></td><td style='vertical-align: middle !important;'><b>".$customer->firstname." ".$customer->lastname. "</b> born on <b>" . $customer->dateofbirth ."</b></td><td style='vertical-align: middle !important; width: 20px;'><a href='javascript:chooseCustomer(".$customer->id.",\"".$customer->firstname." ".$customer->lastname."\");' class='btn btn-xs btn-success'><i class='fa fa-check'></i></a></td></tr>";
	}

?>