<!DOCTYPE html>
<html>
<head>
	<title>Számok, sok</title>
	<style>
		li {
			margin-left: 30pt;
		}
	</style>
</head>
<body>


		<?php

		$numb = new Numbers();
		$numb->Controller(1,1000000);

		?>
		
	
</body>
</html>


<?php

class Numbers 
{

	private $egyesek = ['egy', 'kettő', 'három', 'négy', 'öt', 'hat', 'hét', 'nyolc', 'kilenc'];
	private $tizesek = ['tíz', 'húsz', 'harminc', 'negyven', 'ötven', 'hatvan', 'hetven', 'nyolcvan', 'kilencven'];

	public function Controller($min, $max) 
	{

		$this->EchoBasic($min, $max);

	}

	private function EchoBasic($min, $max)
	{

		echo "<h1>Számok {$min}-től {$max}-ig</h1>";
		echo "<ol>";

		$this->Millioig();

		echo "</ol>";

	}

	private function EchoLi($val)
	{

		echo "\n\t\t<li>";
		echo $val;
		echo "</li>";

	}

	private function Tizig()
	{

		for ($i = 0; $i < 9; $i++) {

			if (func_num_args()) {

				$numb = func_get_arg(0) . $this->egyesek[$i];

				$this->EchoLi($numb);

			}

			else {

				$this->EchoLi($this->egyesek[$i]);

			}

		}

	}

	private function Szazig()
	{

		for ($i = 0; $i < 9; $i++) {

			$val = $this->tizesek[$i];

			if (func_num_args()) {

				$val = func_get_arg(0) . $val;

			}

			$this->EchoLi($val);	//10, 20, 30, 40, 50, 60, 70, 80, 90

			if ($i == 0) {

				if (func_num_args()) {

					$val = func_get_arg(0) . "tizen";
					
				}

			}
			elseif ( $i == 1) {

				if (func_num_args()) {

					$val = func_get_arg(0) . "huszon";
					
				}

			}
			
			$this->Tizig($val);

		}

	}

	private function Ezerig()
	{

		for ($i = 0; $i < 9; $i++) {

			if (func_num_args()) {

				$val = func_get_arg(0) . $this->egyesek[$i] . "száz ";

			}
			else {

				$val = $this->egyesek[$i] . "száz ";
				
			}

			$this->EchoLi($val);

			$this->Tizig($val);

			$this->Szazig($val);

		}

	}

	private function Tizezerig()
	{

		for ($i = 0; $i < 9; $i++) {			

			if (func_num_args()) {

				$val = func_get_arg(0) . $this->egyesek[$i] . "ezer ";
				
			}
			else {

				$val = $this->egyesek[$i] . "ezer ";

			}

			$this->EchoLi($val);

			$this->Tizig($val);

			$this->Szazig($val);

			$this->Ezerig($val);

		}

	}

	private function Szazezerig()
	{

		for ($i = 0; $i < 9; $i++) {

			$val = $this->tizesek[$i] . "ezer ";
			$val_n = $this->tizesek[$i]; 	//ezer mentes érték

			if (func_num_args()) {

				$val = func_get_arg(0) . $val;

			}

			$this->EchoLi($val);	//10, 20, 30, 40, 50, 60, 70, 80, 90
;
			$this->Tizig($val);
			$this->Szazig($val);
			$this->Ezerig($val);

			if ($i == 0) {

				if (func_num_args()) {

					$val_n = func_get_arg(0) . "tizen";
					
				}

				else {

					$val_n = "tizen";

				}

			}
			elseif ( $i == 1) {

				if (func_num_args()) {

					$val_n = func_get_arg(0) . "huszon";
					
				}

				else {

					$val_n = "huszon";

				}

			}
			
			$this->Tizezerig($val_n);

		}
	}

	private function Millioig() 
	{

		$this->Tizig();
		$this->Szazig();
		$this->Ezerig();
		$this->Tizezerig();
		$this->Szazezerig();

		for ($i = 0; $i < 9; $i++) {

			if (func_num_args()) {

				$val = func_get_arg(0) . $this->egyesek[$i] . "százezer ";
				$val_n = func_get_arg(0) . $this->egyesek[$i] . "száz";

			}
			else {

				$val = $this->egyesek[$i] . "százezer ";
				$val_n = $this->egyesek[$i] . "száz";
				
			}

			$this->EchoLi($val);
			$this->Tizig($val);
			$this->Szazig($val);
			$this->Ezerig($val);
			$this->Tizezerig($val_n);
			$this->Szazezerig($val_n);

		}

	}

}