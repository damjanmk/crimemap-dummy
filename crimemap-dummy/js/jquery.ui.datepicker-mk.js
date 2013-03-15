/* Written by Damjan Temelkovski. */
/* Macedonian i18n for the jQuery UI date picker plugin. */
jQuery(function($){
	$.datepicker.regional['mk'] = {
		closeText: 'Затвори',
		prevText: '&#x3C;',
		nextText: '&#x3E;',
		currentText: 'денес',
		monthNames: ['јануари','февруари','март','април','мај','јуни',
		'јули','август','септември','октомври','ноември','декември'],
		monthNamesShort: ['јан','фев','мар','апр','мај','јун',
		'јул','авг','сеп','окт','ное','дек'],
		dayNames: ['недела','понеделник','вторник','среда','четврток','петок','сабота'],
		dayNamesShort: ['нед','пон','вто','дре','чет','пет','саб'],
		dayNamesMin: ['не','по','вт','ср','че','пе','са'],
		weekHeader: 'сед',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['mk']);
});
