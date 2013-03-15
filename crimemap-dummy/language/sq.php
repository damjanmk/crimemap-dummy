<?php
$lang = array(
		'Crime Map Macedonia' => "Harta e krimit në Maqedoni",

		'damjan' => 'Damjan Temelkovski',
		'Home' => 'Shtëpi',
		'All' => 'Të gjitha',
		'Filter' => 'Filtro',
		'Data' => 'Të dhëna',
		'Contact' => 'Kontakt',
		'About' => 'Për ne',

		'random' => "<span id='new_random' style='text-align: center; display: block;'><strong>Случаен настан</strong></span><br />
		Притисни на копчето за да видиш нов случаен настан од прикажаните на картата.<br /><br />
		Притисни на описот на настанот за да го видиш на картата.",
		
		'info' => "<span style='text-align: center; display: block;'><strong>Детали за системот</strong></span><br />
		Системот се состои од два дела: <br />1) анализа на множеството настани и полнење на база на податоци <br />2) приказ на податоците од базата на географска карта.
		<br /><br />
		Податоците за настаните се читаат автоматски од веб страницата на МВР поточно
		<a id='a_bilten' href='http://www.mvr.gov.mk/DesktopDefault.aspx?tabindex=0&tabid=209' target='_blank' >днвените е-билтени</a>.
		Овие настани се објавени во неструктурирана форма и во природен јазик, па првиот дел од системот го анализира секој настан и го запишува во структурирана форма во база на податоци.
		Секој настан се анализира збор по збор сѐ до првото совпаѓање со некој клучен збор, при што системот може да донесе погрешен заклучок ако во текстот се појавува некој друг град пред градот на случување на настанот и слично.
		Затоа доколку забележите ваква грешка ве молам пријавете ја со притискање на знакот на картата, преку страницата што ги прикажува податоците или пополнувајќи го контакт формуларот.
		Исто така, поради лошиот начин на објавување на дневните е-билтени, настаните од некои денови може да се пропуштени. 
		Ако забележите некој настан да постои во е-билтените, а не на оваа карта, ве молам пријавете го.
		Локацијата на настанот на картата не е секогаш точната локација на случувањето, туку најчесто улицата која е објавена за настанот од страна на МВР.
		<br /><br />
		Во базата на податоци се чуваат информации за локацијата и видот на секој настан. 
		Целата база може да ја преземете од страницата што ги прикажува податоците во неколку формати и слободно да ги користите.
		Вториот дел од системот ги прикажува овие настани на географска карта. 
		Поради евентуални недоразбирања околу приватноста, картата може да се разгледува како карта со знаци или топлинска карта.
		Првичниот приказ ги прикажува настаните од последните 30 денови, а може да се видат сите настани или тие да се филтрираат по разни основи, како на пример градот, видот на настанот и слично.
		<br /><br />
		Системот се заснова на идејата за слободни податоци и затоа целото множество на податоци за настаните е слободно достапно и сите идеји и совети се добредојдени.
		Серверскиот дел на системот е изработен во PHP, за приказ на настаните на географската карта се користи JavaScript (и jQuery), а базата е mySQL.",
		
		'Heat Map' => 'Harta e nxehtësisë',
		'Marker Map' => 'Harta me shenja',

		'img_finki' => '../img/Logo_FINKI_MK.jpg',
		
		'Showing' => 'Janë shfaqur',
		'events' => 'ngjarjet',

		'leave_comment' => 'Plotësoni në këtë formë, nëse ju doni të lënë një koment, ose të na kontaktoni.',
		'name' => 'Emër',
		'message' => 'Mesazh',
		'send' => 'Dërgoj',
		'success_m' => 'Mesazhi juaj u dërgua! Faleminderit për kontributin tuaj.',
		'delivery_m' => 'Një gabim ka ndodhur në ofrimin.',
		'email_m' => 'Emaili juaj nuk është në formatin e duhur.',
		'incomplete_m' => 'Ju lënë jashtë fushave të detyrueshme: ',
		'enter_captcha' => 'Shkruaj tekstin qe ndodhet lart ',
		'captcha_m' => 'Kodi CAPTCHA keni futur nuk ishte e saktë.',

		'Берово' => 'Berovë',
		'Битола' => 'Manastir',
		'Богданци' => 'Bogdanci',
		'Валандово' => 'Valandovë',
		'Велес' => 'Veles',
		'Виница' => 'Vinicë',
		'Гевгелија' => 'Gjevgjeli',
		'Гостивар' => 'Gostivar',
		'Дебар' => 'Dibër',
		'Делчево' => 'Delçevë',
		'Демир Капија' => 'Demir Kapi',
		'Демир Хисар' => 'Demir Hisar',
		'Кавадарци' => 'Kavadar',
		'Кичево' => 'Kërçovë',
		'Кочани' => 'Koçanë',
		'Кратово' => 'Kratovë',
		'Крива Паланка' => 'Kriva Pallankë',
		'Крушево' => 'Krushevë',
		'Куманово' => 'Kumanovë',
		'Македонски Брод' => 'Makedonski Brod',
		'Македонска Каменица' => 'Makedonska Kamenicë',
		'Охрид' => 'Ohër',
		'Пехчево' => 'Pehçevë',
		'Прилеп' => 'Prilep',
		'Пробиштип' => 'Probishtip',
		'Радовиш' => 'Radovish',
		'Ресен' => 'Resen',
		'Свети Николе' => 'Sveti Nikollë',
		'Скопје' => 'Shkup',
		'Струга' => 'Strugë',
		'Струмица' => 'Strumicë',
		'Тетово' => 'Tetovë',
		'Штип' => 'Shtip',

		'weapons' => 'armë',
		'violence' => 'dhunë',
		'theft' => 'vjedhje',
		'documents' => 'dokumente',
		'drugs' => 'drogë',
		'traffic' => 'trafik',
		'other' => 'të tjera',

		'Monday' => 'e hënë',
		'Tuesday' => 'e martë',
		'Wednesday' => 'e mërkurë',
		'Thursday' => 'e enjte',
		'Friday' => 'e premte',
		'Saturday' => 'e shtunë',
		'Sunday' => 'e diel',

		'from' => 'prej',
		'to' => 'deri',


		'report' => 'Paraqit',
		'type' => 'lloj',
		'city' => 'qytet',
		'address' => 'adresë',
		'date(bulletin)' => 'data(pub.)',
		'date' => 'data',
		'lat' => 'gjerësi',
		'lng' => 'gjatësi',
		'description' => 'përshkrim',

		'Error!' => "Gabim!",
		'Please select an item' => "Ju lutemi zgjidhni një artikull",
		'Success!' => "Sukses!",
		'The error was successfully reported. Thank you:)' => "Gabimi është raportuar me sukses. Faleminderit:)",
		'Download all the data' => "Shkarko të gjitha të dhënat",
		'Last check!' => "Kontrolli i fundit!",
		'Delete forever?' => "Fshij përgjithmonë?",
		'Change the values' => "Ndryshoni vlerat",
		'Showing up to 30 items from page:' => "Janë paraqitur deri 30 artikuj nga faqja:",
		'Precise lat/lng' => "Gjerësi/gjatësi gjeo. të sakta",

		'where' => 'ku',
		'the city is' => 'qyteti është',
		'the type of crime is' => 'lloji i krimit është',
		'the day of week is' => 'dita e javës është',
		'the date is between' => 'data është mes',
		'and' => 'dhe',
		'for the last 30 days' => 'për 30 ditët e fundit',


		'about-1' => array(
				'Damjan Temellkovski',
				'e bëri këtë sistem si pjesë e',
				'punimit diplomik(mk)',
				'bashkë me',
				'm-r Millosh Jovanoviq',
				'me mentor',
				'prof. Dimitar Trajanov',
				'Gjithashtu, një ',
				'letër shkencore mbi këtë temë është publikuar në konferencën CIIT në vitin 2012(en)',
				'së bashku me ',
				'Prof. Igor Mishkovski'
		),
		'about-2' => array(
				'Në këtë veb faqe mund ta hulumtoni hartën e parë interaktive të kriminalit në Maqedoni. Në prapavi sistemi lexon të dhëna për ngjarjet nga',
				'e-biltenet ditore',
				'të publikuara në veb faqen oficiale të Ministrisë së punëve të brendshme, që janë të shkruara në gjuhë natyrore, mandej i analizon dhe i kodon në hartë prej',
				'Ngjarjet mund t\'i filtroni sipas qytetit në të cilin kanë ndodhur, llojit të ngjarjes, datës kur kanë ndodhur si dhe sipas asaj se në cilën ditë të javës kanë ndodhur. Mund të bëni edhe nënbashkësi me kombinime të këtyre parametrave.',
				'Biltenet e MPB publikohen çdo ditë dhe paraqesin një pjesë të ngjarjeve që kanë ndodhur një ditë para, duke filluar nga 21.06.2011 e deri më sot. Kështu që, ky sistem nuk është hartë e plotë e krimit, por paraqet informata me vlerë statistikore. Përveç për analizë të shablloneve kriminele, kjo hartë mund të shërbejë edhe si mjet parandalues për uljen dhe parandalimin e krimit në shtet.',
				'Të dhënat janë tani më publike në veb faqen e MPB-së, megjithatë ju përkujtojmë se çfarëdo keqpërdorimi i tyre paraqet vepër kriminele vetë më vete. Privatësia e qytetarëve është e garantuar me atë që nuk janë paraqitur me vendin e saktë të ndodhjes, por në mes të rrugës ose në mes të fshatit. Më tej harta është e paraqitur edhe në formë të harte nxehtësie ku ngjarjet shqyrtohen si grupë.',
				'Sistemi është i bazuar në idenë e të dhënave të lira (open data)  dhe prandaj e ndan tërë bazën me të gjitha të dhënat në disa formate.'
		),
		'about-3' => array(
				'Një sistem i ngjashëm interesant në Maqedoni është',
				'Reago!',
				'Dallimi mes këtyre dy sistemeve është se Reago paraqet hartë interaktive të qytetit të Shkupit, që paraqet informata të marra nga populli (crowdsourcing), ndërsa Harta e krmit në Maqedoni paraqet të dhëna oficiale të kontrolluara, të marra nga veb faqja e MPB-së.',
				'Harta e krimit në Maqedoni i mbështet dhe është e inspiruar nga disa projekte tjera të ngjashme në vendet tjera në botë, mes të cilave janë:'
		)
);
?>

