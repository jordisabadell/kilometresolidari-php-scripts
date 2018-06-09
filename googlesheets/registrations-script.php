<?php

$google_id="";
$google_sheet = 1;

$url = 'https://spreadsheets.google.com/feeds/list/'.$google_id.'/'.$google_sheet.'/public/values?alt=json';
$file= file_get_contents($url);
$json = json_decode($file);

//recuperar la informació del Google Drive, i agrupar-la per data
// 20/04/2016, 20/04/2016, 20/04/2016 
// 20/04/2016 => 3
//
$dates = array();
$rows = $json->{'feed'}->{'entry'};
foreach($rows as $row) {
  
	$date_str = $row->{'gsx$date'}->{'$t'};

	$date = DateTime::createFromFormat('d/m/Y', $date_str)->format('Ymd');
	
	if (array_key_exists($date, $dates)) {
	    $num = $dates[$date];
	    $dates[$date] = $num+1;
	}
	else {
		$dates[$date] = 1;
	}
}

//agrupar per anys per poder calcular la data d'inici i fi de cada serie
$years = array(2015, 2016, 2017);
foreach($years as $year) {

	$items = array();
	$ini = null;
	foreach($dates as $key => $value)
	{
		if(substr($key, 0, 4)==$year) { //si pertany a l'any en curs

			$items[$key] = $value;
			if($ini==null) {
				$ini = $key;
			}
			$fin = $key;
		}
	}

	//recórrer cada dia de la serie
	$data_ini = strtotime($ini);
	$data_fi = strtotime($fin);

	$num=1;
	$count=0;
	$result[$year] = array();
	for ($i = $data_ini; $i <= $data_fi; $i = $i + 86400) {
  		$key = date('Ymd', $i);

  		if(array_key_exists($key, $items)) {
  			$count += $items[$key];
  		}
  		//echo $key." = ".$count."\n";
  		$item = array($num++, $count);
  		array_push($result[$year], $item);
	}
}
$json_out = json_encode($result);

$file = fopen("../../data/registrations.json", "w");
fwrite($file, $json_out);
echo "done";
?>