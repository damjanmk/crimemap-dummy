<?php
$lang = array(
		'Crime Map Macedonia' => "Crime Map of Macedonia",

		'damjan' => 'Damjan Temelkovski',
		'Home' => 'Home',
		'All' => 'All',
		'Filter' => 'Filter',
		'Data' => 'Data',
		'Contact' => 'Contact',
		'About' => 'About',
		
		'random' => "<span id='new_random' style='text-align: center; display: block;'><strong>Random Event</strong></span><br />
		Click on the button to see a new random event form those shown on the map. <br /><br />
		Click on the description of the event to see it on the map.",
		
		'info' => "<span style='text-align: center; display: block;'><strong>System Details</strong></span><br />
		The system consists of two parts: <br />1) analysis of the set of events and updating a database <br />2) showing the data on a map.
		<br /><br />
		The data for the events is read automatically from the website of the Ministry of Interior and their
		<a id='a_bilten' href='http://www.mvr.gov.mk/DesktopDefault.aspx?tabindex=0&tabid=209' target='_blank' >daily e-bulletins</a>.
		These events are published in an unstructured form and in a natural language, so the first part of the system analyses every event and writes it in a structured form in a database.
		Every event is analysed word-for-word until the firs matching with a keyword, so the system can make a wrong inference if a city that is not the one where the crime happened is mentioned first etc.
		If you notice such an error please report it by clicking on the marker on the map, the data page or by filling the contact form.
		Also, because of the way the e-bulletins are published, events for entire days can be missed.
		If you notice an event in the e-bulletins, but not on the map, please report it. 
		The location of the event on the map is not always the exact location of the crime, but usually the street published in the text by the police.		
		<br /><br />
		The database keeps data about the location and the type of crime for each event.
		The entire database can be downloaded from the data page in several formats and it can be used freely. 
		The second part of the system shows the events on a map.
		Because of potential privacy issues, you can view a map with markers or a heat map. 
		The home page shows the events from the last 30 days, but you can also see all the events and filter them based on different parameters, such as the city, the date etc.		
		<br /><br />
		The system is based on the idea for open data, so we made all the data for the events open and available and all ideas and advice you might have are very welcome.
		The server side of the system was made in PHP, the map is populated with JavaScript (and jQuery) and the database engine is mySQL.",
		
		'Heat Map' => 'Heat Map',
		'Marker Map' => 'Marker Map',
		
		'img_finki' => '../img/Logo_FINKI_EN.jpg',

		'Showing' => 'Showing',
		'events' => 'events',

		'leave_comment' => 'Fill in this form if you want to leave a comment or contact us.',
		'name' => 'Name',
		'message' => 'Message',
		'send' => 'Send',
		'success_m' => 'Your message was successfully sent! Thank you for your contribution.',
		'delivery_m' => 'An error occurred on delivery.',
		'email_m' => 'Your email is not in the right format.',
		'incomplete_m' => 'You left out mandatory fields: ',
		'enter_captcha' => 'Enter the text above ',
		'captcha_m' => 'The captcha code you entered was not correct.',

		'Берово' => 'Berovo',
		'Битола' => 'Bitola',
		'Богданци' => 'Bogdanci',
		'Валандово' => 'Valandovo',
		'Велес' => 'Veles',
		'Виница' => 'Vinica',
		'Гевгелија' => 'Gevgelija',
		'Гостивар' => 'Gostivar',
		'Дебар' => 'Debar',
		'Делчево' => 'Delchevo',
		'Демир Капија' => 'Demir Kapija',
		'Демир Хисар' => 'Demir Hisar',
		'Кавадарци' => 'Kavadarci',
		'Кичево' => 'Kichevo',
		'Кочани' => 'Kochani',
		'Кратово' => 'Kratovo',
		'Крива Паланка' => 'Kriva Palanka',
		'Крушево' => 'Krushevo',
		'Куманово' => 'Kumanovo',
		'Македонски Брод' => 'Makedonski Brod',
		'Македонска Каменица' => 'Makedonska Kamenica',
		'Охрид' => 'Ohrid',
		'Пехчево' => 'Pehchevo',
		'Прилеп' => 'Prilep',
		'Пробиштип' => 'Probishtip',
		'Радовиш' => 'Radovish',
		'Ресен' => 'Resen',
		'Свети Николе' => 'Sveti Nikole',
		'Скопје' => 'Skopje',
		'Струга' => 'Struga',
		'Струмица' => 'Strumica',
		'Тетово' => 'Tetovo',
		'Штип' => 'Shtip',

		'weapons' => 'weapons',
		'violence' => 'violence',
		'theft' => 'theft',
		'documents' => 'documents',
		'drugs' => 'drugs',
		'traffic' => 'traffic',
		'other' => 'other',

		'Monday' => 'Monday',
		'Tuesday' => 'Tuesday',
		'Wednesday' => 'Wednesday',
		'Thursday' => 'Thursday',
		'Friday' => 'Friday',
		'Saturday' => 'Saturday',
		'Sunday' => 'Sunday',

		'from' => 'From',
		'to' => 'To',


		'report' => 'Report',
		'type' => 'type',
		'city' => 'city',
		'address' => 'address',
		'date(bulletin)' => 'date(pub.)',
		'date' => 'date',
		'lat' => 'lat',
		'lng' => 'lng',
		'description' => 'description',

		'Error!' => "Error!",
		'Please select an item' => "Please select an item",
		'Success!' => "Success!",
		'The error was successfully reported. Thank you:)' => "The error was successfully reported. Thank you:)",
		'Download all the data' => "Download all the data",
		'Last check!' => "Last check!",
		'Delete forever?' => "Delete forever?",
		'Change the values' => "Change the values",
		'Showing up to 30 items from page:' => "Showing up to 30 items from page:",
		'Precise lat/lng' => "Precise lat/lng",

		'where' => 'where',
		'the city is' => 'the city is',
		'the type of crime is' => 'the type of crime is',
		'the day of week is' => 'the day of week is',
		'the date is between' => 'the date is between',
		'and' => 'and',
		'for the last 30 days' => 'for the last 30 days',


		'about-1' => array(
				'Damjan Temelkovski',
				'created this sistem as a part of his',
				'graduation thesis (mk)',
				'together with',
				'MSc Milos Jovanovik',
				'and under the mentorship of',
				'Prof. Dr Dimitar Trajanov',
				'Also, a ',
				'scientific paper on the subject was published at the CIIT conference in 2012',
				'together with ',
				'Prof. Dr Igor Mishkovski'
		),
		'about-2' => array(
				'This website lets you explore the first interactive crime map of Macedonia. In the background the system reads data from the',
				'daily e-bulletins',
				'published on the official website of the Ministry of Interior Affairs, which are written in natural language, then it analyses them and codes them on a map from',
				'You can filter the events by the city in which they occurred, the type of event, the date as well as the day of the week when they occured. You can make further subsets by combining these parameters.',
				'The MOI\'s e-bulletins are published every day and show a part of the events of the past day starting from 21/06/2011 up until today. Therefore, the system isn\'t a complete crime map, but it shows statistically valuable information. Apart from analysis of the crime patterns, this map can be used as a preventive measure to lower crime rates and stop crime in the country.',
				'The data are already publicly available on the MOI\'s website, but still we remind you that any kind of misuse represents an act of crime. The privacy of the citizens is further guaranteed by the fact that the events aren\'t shown on the exact location, but in the middle of the street or village. Also there is a heat map version where the events are grouped.',
				'The system is based on the idea of open data and that is why we share all the data in several formats.'
		),
		'about-3' => array(
				'Another similar and interesting system in Macedonia is',
				'React!',
				'The difference between these systems is that React! shows and interactive map of the city of Skopje, with information gained by crowdsourcing, and the Crime Map of Macedonia shows official checked data from MOI\'s website.',
				'The Crime Map of Macedonia supports and is inspired by several other similar projects in other countries, mainly:'
		)
);
?>

