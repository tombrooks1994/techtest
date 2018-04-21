<?php 

class main {
	
	public function display_portal() {
		$portal = ''; 
		$portal .= "<div class='container'>";
			$portal .= '<h1>Welcome to the portal</h1>';
				$portal .= '<p>Please choose a portal</p>';
				$portal .= '<h3><a href="zoopla.php">Zoopla</a></h3>';
				$portal .= '<h3><a href="rightmove.php">Rightmove</a></h3>';
				$portal .= '<h3><a href="otm.php">On the market</a></h3>';
		return $portal;
	}
	
	public function __header() {
		
					$output = '<style>
						body {
							font-family:arial;							
						}
						td {
							border-right: 1px solid black;
						}
						th {
							border-right: 1px solid black;
							border-bottom: 1px solid black;
						}
						table {
							border: 1px solid black;
						}
				  </style>';
			
			return $output;
		
	}
	
	public function zoopla() {
		
		$xml=simplexml_load_file("../json_xml/example-zoopla.xml");
		$json = json_encode($xml);
		$array = json_decode($json, TRUE);
		
		//print_r($array);
		$output = '';
		if (isset($array['prpcode'])) {
			$output .= '<table>';
			$output .= '<thead>
						<th>Property Code</th>
						<th>Branch ID</th>
						<th>Address 1</th>
						<th>Address 2</th>
						<th>Address 3</th>
						<th>Address 4</th>
						<th>Postcode</th>
						<th>Landlord Title</th>
						<th>Landlord First Name</th>
						<th>Landlord Surname</th>
						<th>Landlord Phone</th>	
				  </thead>';
			$output .= '<tbody>
						<td>'. $array['prpcode'] .'</td>
						<td>'. $array['branch_id'] .'</td>
						<td>'. $array['address']['address_1'].'</td>
						<td>'. $array['address']['address_2'].'</td>';
						if ($array['address']['address_3'] != array()) { 
						$address_3 = $array['address']['address_3'];
						$output .= '<td>'. $array['address']['address_3'].'</td>';
						} else {
							$address_3 = 'n/a';
							$output .= '<td>'. $address_3 .'</td>';
						}
			$output .= '<td>'. $array['address']['address_4'].'</td>
						<td>'. $array['address']['postcode'].'</td>
						<td>'. $array['landlord']['title'].'</td>
						<td>'. $array['landlord']['first_name'].'</td>
						<td>'. $array['landlord']['surname'].'</td>
						<td>'. $array['phone'].'</td>
				  </tbody>';
			$output .= '</table>';
			
		} else {
			
			$output = 'No Property Code';
			
		}
		
		$file = fopen('../data/zoopla.csv', 'w');
 
		fputcsv($file, array(
								'Property Code', 
								'Branch ID', 
								'Address 1', 
								'Address 2', 
								'Address 3', 
								'Address 4', 
								'Postcode', 
								'Landlord Title', 
								'Landlord First Name', 
								'Landlord Surname', 
								'Landlord Phone'
							)
				);
 
		$data = array(
		array(
				$array['prpcode'], 
				$array['branch_id'],
				$array['address']['address_1'],
				$array['address']['address_2'],
				$address_3,
				$array['address']['address_4'],
				$array['address']['postcode'],
				$array['landlord']['title'],
				$array['landlord']['first_name'],
				$array['landlord']['surname'],
				$array['phone']				
			)
		);
 
		foreach ($data as $row){
			fputcsv($file, $row);
		}
		
		fclose($file);
		
		return $output;
	}
	
	public function rightmove() {
		
		$str = file_get_contents('../json_xml/example-rightmove.json');
		$json = json_decode($str, true);
		
		$output = '';
		if (isset($json['prpcode'])) {			
			$output .= '<table>';
			$output .= '<thead>
						<th>Property Code</th>
						<th>Branch ID</th>
						<th>Address 1</th>
						<th>Address 2</th>
						<th>Address 3</th>
						<th>Address 4</th>
						<th>Postcode</th>
						<th>Landlord Title</th>
						<th>Landlord First Name</th>
						<th>Landlord Surname</th>
						<th>Landlord Phone</th>	
				  </thead>';
			$output .= '<tbody>
						<td>'. $json['prpcode'] .'</td>
						<td>'. $json['branch_id'] .'</td>
						<td>'. $json['address']['address_1'].'</td>
						<td>'. $json['address']['address_2'].'</td>
						<td>'. $json['address']['address_3'].'</td>
						<td>'. $json['address']['address_4'].'</td>
						<td>'. $json['address']['postcode'].'</td>
						<td>'. $json['landlord']['title'].'</td>
						<td>'. $json['landlord']['first_name'].'</td>
						<td>'. $json['landlord']['surname'].'</td>
						<td>'. $json['phone'].'</td>
				  </tbody>';
			$output .= '</table>';
			
		} else {
			
			$output = 'No Property Code';
			
		}
		
		$file = fopen('../data/rightmove.csv', 'w');
 
		fputcsv($file, array(
								'Property Code', 
								'Branch ID', 
								'Address 1', 
								'Address 2', 
								'Address 3', 
								'Address 4', 
								'Postcode', 
								'Landlord Title', 
								'Landlord First Name', 
								'Landlord Surname', 
								'Landlord Phone'
							)
				);
 
		$data = array(
		array(
				$json['prpcode'], 
				$json['branch_id'],
				$json['address']['address_1'],
				$json['address']['address_2'],
				$json['address']['address_3'],
				$json['address']['address_4'],
				$json['address']['postcode'],
				$json['landlord']['title'],
				$json['landlord']['first_name'],
				$json['landlord']['surname'],
				$json['phone']				
			)
		);
 
		foreach ($data as $row){
			fputcsv($file, $row);
		}
		
		fclose($file);
		
		return $output;
	}
	
	public function otm() {
		
		$str = file_get_contents('../json_xml/example-on-the-market.json');
		$json = json_decode($str, true);

		$output = '';
		if (isset($json['code'])) {
			$output .= '<table>';
			$output .= '<thead>
						<th>Property Code</th>
						<th>Branch ID</th>
						<th>Address 1</th>
						<th>Address 2</th>
						<th>Town</th>
						<th>Postcode</th>
						<th>Landlord Title</th>
						<th>Landlord First Name</th>
						<th>Landlord Surname</th>
						<th>Landlord Phone</th>	
				  </thead>';
			$output .= '<tbody>
						<td>'. $json['code'] .'</td>
						<td>'. $json['branch'] .'</td>
						<td>'. $json['address']['address1'].'</td>
						<td>'. $json['address']['address2'].'</td>
						<td>'. $json['address']['town'].'</td>
						<td>'. $json['address']['postcode_1'].' '.$json['address']['postcode_2'].'</td>
						<td>'. $json['landlord']['title'].'</td>
						<td>'. $json['landlord']['first_name'].'</td>
						<td>'. $json['landlord']['surname'].'</td>
						<td>'. $json['landlord']['phone'].'</td>
				  </tbody>';
			$output .= '</table>';
			
		} else {
			$output = 'No Property Code';	
		}
		
		$postcode = $json['address']['postcode_1'] . $json['address']['postcode_2']; 
		
		$file = fopen('../data/otm.csv', 'w');
 
		fputcsv($file, array(
								'Property Code', 
								'Branch ID', 
								'Address 1', 
								'Address 2', 
								'Address 3', 
								'Postcode', 
								'Landlord Title', 
								'Landlord First Name', 
								'Landlord Surname', 
								'Landlord Phone'
							)
				);
 
		$data = array(
		array(
				$json['code'], 
				$json['branch'],
				$json['address']['address1'],
				$json['address']['address2'],
				$json['address']['town'],
				$postcode,
				$json['landlord']['title'],
				$json['landlord']['first_name'],
				$json['landlord']['surname'],
				$json['landlord']['phone']				
			)
		);
 
		foreach ($data as $row){
			fputcsv($file, $row);
		}
		
		fclose($file);
		
		return $output;
		//return $output .  '<pre>' . print_r($json, true) . '</pre>';

		
	}
	
	public function badrequest(){
		
		echo 'The request you have sent is invalid, please try again.';
		
	}
	
}

?> 