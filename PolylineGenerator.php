<?php
	/*	
	__________      .__         .__  .__                  ________                                   __                
	\______   \____ |  | ___.__.|  | |__| ____   ____    /  _____/  ____   ____   ________________ _/  |_  ___________ 
	|     ___/  _ \|  |<   |  ||  | |  |/    \_/ __ \  /   \  ____/ __ \ /    \_/ __ \_  __ \__  \\   __\/  _ \_  __ \
	|    |  (  <_> )  |_\___  ||  |_|  |   |  \  ___/  \    \_\  \  ___/|   |  \  ___/|  | \// __ \|  | (  <_> )  | \/
	|____|   \____/|____/ ____||____/__|___|  /\___  >  \______  /\___  >___|  /\___  >__|  (____  /__|  \____/|__|   
						\/                  \/     \/          \/     \/     \/     \/           \/                   
	*/
	# Author: Marcos Torregrosa
	# Date: 2017-11-18

	require_once 'PolylineEncoder.php';

	# constructor 
	function buildPolyline ($vCoor){
		$polylineEncoder = new PolylineEncoder();

		$arrayCoords = explode (" ", $vCoor);

		foreach($arrayCoords as $plot)
	    {
	     	$arrPlot = explode (",",$plot);
	        $polylineEncoder->addPoint($arrPlot[1],$arrPlot[0]);
	    }
		
		return $polylineEncoder->encodedString($vCoor);
	}

	# print friendly results in HTML
	function buildFriendlyHTMLViewer ( $XMLsource ){
		
		if (file_exists($XMLsource)) {
			$xml = simplexml_load_file($XMLsource);

			foreach ($xml->Placemark as $nodo) 
			{
				$vProv = $nodo->provincia;
				$vPobl = $nodo->poblacion;
				$vCoor = $nodo->coordinates;

				printf("<table BORDER=1><tr><TD>PROVINCIA</TD><TD>" . $vProv . "</TD></TR>");
				printf("<tr><TD>POBLACION</TD><TD>" . $vPobl . "</TD></TR>");
				printf("<tr><TD>COORDENADAS</TD><TD>" . $vCoor . "</TD></TR>");

				// if there is a break line <br> we have to generate two polyline codes
				if(strpos($vCoor,"####") !== false){
					printf("<tr><TD>POLYLINE</TD><TD>");				
					$arrMultiple = explode ("####", $vCoor);
					for ($i=0;$i<count($arrMultiple); $i++){					
						printf(buildPolyline($arrMultiple[$i]));
						if ($i+1 < count($arrMultiple)){
							printf(htmlentities("<br>"));
						}
					}
					printf("</TD></TR>");
				}else{
					printf("<tEr><TD>POLYLIN</TD><TD>" . buildPolyline($vCoor) . "</TD></TR>");
				}

				printf("</TABLE><BR><BR>");
			}			
		} else {
			exit('Error opening xml file');
		}

	}

	# SQL insert generator
	function buildDmlScript ( $XMLsource ){
			
		
		if (file_exists($XMLsource)) {
		    $xml = simplexml_load_file($XMLsource);

		    foreach ($xml->Placemark as $nodo) 
			{
				$vProv = $nodo->provincia;
				$vPobl = $nodo->poblacion;
				$vCoor = $nodo->coordinates;

				$query = "INSERT INTO DB_INFORMES.dbo.DWH_MAPS_POB_TMP ( COD_PROV, DES_PROV, COD_POB, DES_POB, COORDS) VALUES( "NULL, '" . $vProv . "',"NULL, '". str_replace("'","''", $vPobl)."','";
				// print on screen
					print($query);
				// execute DML
					// to-do

				// if there is a break line <br> we have to generate two polyline codes
				if(strpos($vCoor,"####") !== false){
					$arrMultiple = explode ("####", $vCoor);
					for ($i=0;$i<count($arrMultiple); $i++){					
						printf(buildPolyline($arrMultiple[$i]));
						if ($i+1 < count($arrMultiple)){
							printf(htmlentities("<br>"));
						}
					}
					
				}else{
					printf( buildPolyline($vCoor) );
				}
				// print end of the insert query
				print(");")	
		}
		 
		} else {
		    exit('Error opening xml file');
		}
	}

	
	// run script
	// load XML file
	$XMLsource = "file.xml";
			
	// generate SQL script
	buildDmlScript( $XMLsource ); 

	// generate HTML friendly view
	buildFriendlyHTMLViewer ( $XMLsource );

	
?>