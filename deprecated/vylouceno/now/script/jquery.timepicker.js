/* jQuery timepicker
 * replaces a single text input with a set of pulldowns to select hour, minute, and am/pm
 *
 * Copyright (c) 2007 Jason Huck/Core Five Creative (http://www.corefive.com/)
 * Change by Sandro Andrei Dinnebier - 2008-06-16 (add 24h and accept steps for minutes)
 * 
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) 
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Options:
 *   step - set step of minutes, default 15
 *   ampm - set use 12 or 24 hours, default true (use 12 with am/pm)
 *   
 * Version 1.1
 */

(function($){
	jQuery.fn.timepicker = function(settings){
		this.each(function(){

			// default settings
			settings = $.extend({
				step: 15,
				ampm: true
			}, settings);
			
			this.style.display='none';  // hide textbox
			
			// get the ID and value of the current element
			var i = this.id;
			var v = $(this).val();
	
			// the options we need to generate
			// choose 12 or 24 hours
			if (settings.ampm) {
				var hrs = new Array('01','02','03','04','05','06','07','08','09','10','11','12');
				var ap = new Array('am','pm');
			} else {
				var hrs = new Array('00', '01','02','03','04','05','06','07','08','09','10','11','12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23');
			}
			
			// mount minute options based in step settings
			var mins = new Array();
			for(j=0; j<60; j+=settings.step) {
				min = (j<10 ? '0'+j : j);
				mins[ min ] = min;
			}
			
			
			// default to the current time
			var d = new Date;
			var h = d.getHours();
			var m = d.getMinutes();
			
			// adjust hour to 12-hour format
			if (settings.ampm) {
				var p = (h >= 12 ? 'pm' : 'am');
				if(h > 12) h = h - 12;
			}
				
			// round minutes to nearest quarter hour
			for(mn in mins){
				if(m <= parseInt(mins[mn])){
					m = parseInt(mins[mn]);
					break;
				}
			}
			
			// increment hour if we push minutes to next 00
			if(m > 45){
				m = 0;
				
				switch(h){
					case(11):
						h += 1;
						p = (p == 'am' ? 'pm' : 'am');
						break;
						
					case(12):
						h = 1;
						break;
						
					default:
						h += 1;
						break;
				}
			}

			// override with current values if applicable
			if (settings.ampm) {
				if(v.length == 7){ // for use am/pm
					h = parseInt(v.substr(0,2));
					m = parseInt(v.substr(3,2));
					p = v.substr(5);
				}
			} else {
				if(v.length == 5){ // for use 24h
					h = parseInt(v.substr(0,2));
					m = parseInt(v.substr(3,2));
				}
			}
			
			// build the new DOM objects
			var output = '';
			
			output += '<select id="h_' + i + '" class="h timepicker">';				
			for(hr in hrs){
				output += '<option value="' + hrs[hr] + '"';
				if(parseInt(hrs[hr]) == h) output += ' selected';
				output += '>' + hrs[hr] + '</option>';
			}
			output += '</select>';
	
			output += '<select id="m_' + i + '" class="m timepicker">';				
			for(mn in mins){
				output += '<option value="' + mins[mn] + '"';
				if(parseInt(mins[mn]) == m) output += ' selected';
				output += '>' + mins[mn] + '</option>';
			}
			output += '</select>';				
	
			if (settings.ampm) {
				output += '<select id="p_' + i + '" class="p timepicker">';				
				for(pp in ap){
					output += '<option value="' + ap[pp] + '"';
					if(ap[pp] == p) output += ' selected';
					output += '>' + ap[pp] + '</option>';
				}
				output += '</select>';				
			}

			// hide original input and append new replacement inputs
			$(this).after(output);
		});
		
		$('select.timepicker').change(function(){
			var i = this.id.substr(2);
			var h = $('#h_' + i).val();
			var m = $('#m_' + i).val();

			if (settings.ampm) {
				var p = $('#p_' + i).val();
				var v = h + ':' + m + p;
			} else {
				var v = h + ':' + m;
			}
			$('#' + i).val(v);
		});
		
		return this;
	};
})(jQuery);



/* SVN: $Id: jquery.timepicker.js 456 2007-07-16 19:09:57Z Jason Huck $ */
