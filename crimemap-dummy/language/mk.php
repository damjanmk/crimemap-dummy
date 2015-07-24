<?php
$lang = array(
		'Crime Map Macedonia' => "Карта на криминалот на Македонија",

		'damjan' => 'Дамјан Темелковски',
		'Home' => 'Дома',
		'All' => 'Сите',
		'Filter' => 'Филтрирај',
		'Data' => 'Податоци',
		'Contact' => 'Контакт',
		'About' => 'За нас',

		'random' => "<span id='new_random' style='text-align: center; display: block;'><strong>Случаен настан</strong></span><br />
		Притисни на копчето за да видиш нов случаен настан од прикажаните на картата.<br /><br />
		Притисни на описот на настанот за да го видиш на картата.",
		
		'info' => "<span style='text-align: center; display: block;'><strong>Детали за системот</strong></span><br />
		Системот се состои од два дела: <br />1) анализа на множеството настани и полнење на база на податоци <br />2) приказ на податоците од базата на географска карта.
		<br /><br />
		Податоците за настаните се читаат автоматски од веб страницата на МВР поточно
		<a id='a_bilten' href='http://www.mvr.gov.mk/dneven-bilten/91' target='_blank' >днвените е-билтени</a>.
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
		
		'Heat Map' => 'Топлинска карта',
		'Marker Map' => 'Карта со знаци',

		'img_finki' => '../img/Logo_FINKI_MK.jpg',
		
		'Showing' => 'Прикажани се',
		'events' => 'настани',

		'leave_comment' => 'Пополни го овој формулар ако сакаш да оставиш коментар или да нѐ контактираш.',
		'name' => 'Име',
		'message' => 'Порака',
		'send' => 'Испрати',
		'success_m' => 'Пораката беше успешно испратена! Благодарам за придонесот.',
		'delivery_m' => 'Настана грешка при испораката.',
		'email_m' => 'Е-адресата не е во добар формат',
		'incomplete_m' => 'Задолжителните полиња се празни: ',
		'enter_captcha' => 'Внесете го текстот ',
		'captcha_m' => 'Captcha кодот не е точен.',

		'Берово' => 'Берово',
		'Битола' => 'Битола',
		'Богданци' => 'Богданци',
		'Валандово' => 'Валандово',
		'Велес' => 'Велес',
		'Виница' => 'Виница',
		'Гевгелија' => 'Гевгелија',
		'Гостивар' => 'Гостивар',
		'Дебар' => 'Дебар',
		'Делчево' => 'Делчево',
		'Демир Капија' => 'Демир Капија',
		'Демир Хисар' => 'Демир Хисар',
		'Кавадарци' => 'Кавадарци',
		'Кичево' => 'Кичево',
		'Кочани' => 'Кочани',
		'Кратово' => 'Кратово',
		'Крива Паланка' => 'Крива Паланка',
		'Крушево' => 'Крушево',
		'Куманово' => 'Куманово',
		'Македонски Брод' => 'Македонски Брод',
		'Македонска Каменица' => 'Македонска Каменица',
		'Охрид' => 'Охрид',
		'Пехчево' => 'Пехчево',
		'Прилеп' => 'Прилеп',
		'Пробиштип' => 'Пробиштип',
		'Радовиш' => 'Радовиш',
		'Ресен' => 'Ресен',
		'Свети Николе' => 'Свети Николе',
		'Скопје' => 'Скопје',
		'Струга' => 'Струга',
		'Струмица' => 'Струмица',
		'Тетово' => 'Тетово',
		'Штип' => 'Штип',

		'weapons' => 'оружје',
		'violence' => 'насилство',
		'theft' => 'кражба',
		'documents' => 'документи',
		'drugs' => 'дрога',
		'traffic' => 'сообраќај',
		'other' => 'друго',

		'Monday' => 'понеделник',
		'Tuesday' => 'вторник',
		'Wednesday' => 'среда',
		'Thursday' => 'четврток',
		'Friday' => 'петок',
		'Saturday' => 'сабота',
		'Sunday' => 'недела',

		'from' => 'ОД',
		'to' => 'ДО',


		'report' => 'Пријави',
		'type' => 'вид',
		'city' => 'град',
		'address' => 'адреса',
		'date(bulletin)' => 'датум(обј.)',
		'date' => 'датум',
		'lat' => 'г. шир.',
		'lng' => 'г. дол.',
		'description' => 'опис',

		'Error!' => "Грешка!",
		'Please select an item' => "Ве молиме селектирајте ставка",
		'Success!' => "Успех!",
		'The error was successfully reported. Thank you:)' => "Грешката беше успешно пријавена. Ви благодариме:)",
		'Download all the data' => "Симнете ги сите податоци",
		'Last check!' => "Последна проверка!",
		'Delete forever?' => "Избриши засекогаш?",
		'Change the values' => "Сменете ги вредностите",
		'Showing up to 30 items from page:' => "Прикажани се до 30 ставки од стр:",
		'Precise lat/lng' => "Точни г.шир/г.дол.",

		'where' => 'каде што',
		'the city is' => 'градот е',
		'the type of crime is' => 'видот на криминал е',
		'the day of week is' => 'денот од неделате е',
		'the date is between' => 'датумот е помеѓу',
		'and' => 'и',
		'for the last 30 days' => 'за последните 30 дена',


		'about-1' => array(
				'Дамјан Темелковски',
				'го направи овој систем како дел од неговиот',
				'дипломски труд',
				'заедно со',
				'м-р Милош Јовановиќ',
				'и под менторство на',
				'проф. Димитар Трајанов',
				'За овој систем објавен е и',
				'научен труд на конференцијата CIIT во 2012 година(en)',
				'во соработка со ',
				'проф. Игор Мишковски'
		),
		'about-2' => array(
				'На оваа веб страница можете да ја истражувате првата интерактивна карта на криминалот на Македонија. Во позадина системот чита податоци за настаните од',
				'дневните е-билтени',
				'објавувани на официјалната веб страница на Министерството за внатрешни работи, кои се напишани во природен јазик, потоа ги анализира и ги кодира на карта од',
				'Настаните може да ги филтрирате по градот во кој се случиле, видот на настанот, датумот на случување, а и по тоа кој ден во неделата се случиле. Можете да направите и подмножества со комбинации од овие параметри.',
				'Билтените од МВР се објавуваат секојдневно и прикажуваат дел од случените настани за претходниот ден почнувајќи од 21.06.2011 па се до денес. Така што, овој систем не е целосно комплетна карта на криминалот, но прикажува статистички вредни информации. Освен за анализа на криминалните шаблони, оваа карта може да послужи и како превентивно средство за намалување и спречување на криминалот во државата.',
				'Податоците се веќе јавно достапни на веб страницата на МВР, сепак ве потсетуваме дека било каква нивна злоупотреба претставува криминално дело самото по себе. Приватноста на граѓаните е загарантирана со тоа што настаните не се прикажани на точната локација на случување, туку на средина на улицата или на средина на селото. Дополнително картата е прикажана и во вид на топлотна карта каде што настаните се разгледуваат како група.',
				'Системот е базиран на идејата за слободни податоци (open data) и затоа ја споделува целата база со сите податоци во неколку формати.'
		),
		'about-3' => array(
				'Сличен интересен систем во Македонија е',
				'Реагирај!',
				'Разликата меѓу овие два системи е што Реагирај прикажува интерактивна карта на градот Скопје, која прикажува информации добиени од народот (crowdsourcing), а Картата на криминалот на Македонија прикажува официјални проверени податоци преземени од веб страницата на МВР.',
				'Картата на криминалот на Македонија ги поддржува и е инспирирана од неколку други слични проекти во другите држави во светот, меѓу кои најзначајни се:'
		)
);
?>

