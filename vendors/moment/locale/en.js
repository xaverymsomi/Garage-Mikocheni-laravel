//! moment.js locale configuration
//! locale : Danish [da]
//! author : Ulrik Nielsen : https://github.com/mrbase

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../moment')) :
   typeof define === 'function' && define.amd ? define(['../moment'], factory) :
   factory(global.moment)
}(this, (function (moment) { 'use strict';

    //! moment.js locale configuration

    var en = moment.defineLocale('en', {
        months: 'January_February_March_April_May_June_July_August_September_October_November_December'.split(
            '_'
        ), 
        monthsShort: 'Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec'.split('_'),
        weekdays: 'Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday'.split('_'),
        weekdaysShort: 'Sun_Mon_Tues_Wed_Thurs_Fri_Sat'.split('_'),
        weekdaysMin: 'sun_mo_tu_on_to_fr_sat'.split('_'),
        longDateFormat: {
            LT: 'HH:mm',
            LTS: 'HH:mm:ss',
            L: 'DD.MM.YYYY',
            LL: 'D. MMMM YYYY',
            LLL: 'D. MMMM YYYY HH:mm',
            LLLL: 'dddd [d.] D. MMMM YYYY [kl.] HH:mm',
        },
        calendar: {
            sameDay: '[today at] LT',
            nextDay: '[tomorrow at] LT',
            nextWeek: 'on dddd [at] LT',
            lastDay: '[yesterday at] LT',
            lastWeek: '[i] dddd[s kl.] LT',
            sameElse: 'L',
        },
        relativeTime: {
            future: 'about %s',
            past: '%s page',
            s: 'few seconds',
            ss: '%d seconds',
            m: 'et minute',
            mm: '%d minutes',
            h: 'one hour',
            hh: '%d timer',
            d: 'one day',
            dd: '%d days',
            M: 'one month',
            MM: '%d months',
            y: 'one year',
            yy: '%d years',
        },
        dayOfMonthOrdinalParse: /\d{1,2}\./,
        ordinal: '%d.',
        week: {
            dow: 1, // Monday is the first day of the week.
            doy: 4, // The week that contains Jan 4th is the first week of the year.
        },
    });

    return da;

})));
