<?php
	//var_dump($json_appointment);
	//var_dump($json_availabletime);
	//var_dump($availabletime);
	//var_dump($allCustomer);
	if(isset($_GET['task'])) {$task = $_GET['task'];} else { $task = 'appointment'; }
	
	$temp_fh = substr($first_hour,0,2);
	$temp_lh = substr($last_hour,0,2);
	$temp_li = substr($last_hour,3,2);
	if($temp_li != '00'){$temp_lh++;}
	if(isset($_GET['option'])){ $view = $_GET['option'];}else{$view = 'appointment';};

?>

<script type="text/javascript" charset="utf-8">	
	function init() {
		var json_availabletime = <?php echo $json_availabletime;?>;
		//scale hours section
		var step = 60;
		var format = scheduler.date.date_to_str("%H:%i");
		
		scheduler.config.hour_size_px=(60/step)*176;
		scheduler.templates.hour_scale = function(date){
			html="";
			for (var i=0; i<60/step; i++){
				html+="<div style='height:10px;line-height:10px;'>"+format(date)+"</div>";
				date = scheduler.date.add(date,step,"minute");
			}
			return html;
		}
		//end scale hours
		//get value form php varible
		var first_hour = <?php echo '\''.$temp_fh.'\''; ?>;
		var last_hour = <?php echo '\''.$temp_lh.'\'' ;?>;
		var task = <?php echo '\''.$view.'\'' ;?>;
		
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.config.first_hour = first_hour;
		scheduler.config.last_hour = last_hour;
		scheduler.config.time_step  = 30;
		scheduler.config.details_on_dblclick=true;
		scheduler.config.details_on_create=true;
		scheduler.config.dblclick_create = false;
		//scheduler.config.drag_resize = 0;
		//scheduler.config.drag_move = 0;
		//scheduler.config.drag_create = 0;
		scheduler.config.readonly = true;
	//test code section	
		scheduler.templates.event_class = function(start, end, event) {
				return "my_event";
			};
		scheduler.renderEvent = function(container, ev) {
			var container_width = container.style.width; // e.g. "105px"

			// move section
			var html = "<div class='dhx_event_move my_event_move' style='width: " + container_width + "'></div>";

			// container for event contents
			html+= "<div class='my_event_body'>";
				html += "<span class='event_date'>";
				// two options here: show only start date for short events or start+end for long
				if ((ev.end_date - ev.start_date) / 60000 > 14) { // if event is longer than 40 minutes
					html += scheduler.templates.event_header(ev.start_date, ev.end_date, ev);
					html += "</span><br/>";
				} else {
					html += scheduler.templates.event_date(ev.start_date) + "</span>";
				}
				// displaying event text
				html += "<span>" + scheduler.templates.event_text(ev.start_date, ev.end_date, ev) + "</span>";
			html += "</div>";

			// resize section
			html += "<div class='dhx_event_resize my_event_resize' style='width: " + container_width + "'></div>";

			container.innerHTML = html;
			return true; // required, true - we've created custom form; false - display default one instead
			};
	//end test code	
		scheduler.locale.labels.section_reason = 'Lí do khám';
		scheduler.locale.labels.section_name = 'Bệnh nhân';
		
		var size_availabletime = <?php echo sizeof($availabletime);?>;
		for(i=0;i<size_availabletime;i++){
			scheduler.addMarkedTimespan({  
				start_date: new Date(json_availabletime[i].start_date),
				end_date:   new Date(json_availabletime[i].end_date),      // marks the entire day
				css:   "green_section"					// the applied css style
			});
		}
		scheduler.templates.lightbox_header = function(start, end, event){
			return "Tạo lịch tái khám của : "+event.text;
		}
		var restricted_lightbox = [
				{ name: "time", height: 50, map_to: "auto", type: "time" },
				{ name: "name", height: 25, map_to: "text", type: "textarea", focus: true},
				{ name: "reason", height: 100, map_to: "reason", type: "textarea", focus: true}
				
			];

		scheduler.config.lightbox.sections = restricted_lightbox
		scheduler.init('scheduler_here',new Date(),"day");
		
		var events = <?php echo $json_appointment ; ?>;
				scheduler.parse(events,"json");
		
		//end setup time available
		//Save attachEvent
		scheduler.attachEvent("onEventSave",function(id,event){
			if (!event.reason) {
				alert("Reason must not by empty");
				return false;
			}
			else{
				window.location.href ="clinic/insertData?id_lichkham="+id+"&lidokham="+event.reason+"&start_date="+event.start_date+"&end_date="+event.end_date+"&email="+event.email;
			}
		});
		//end save action
		//Delete attachEvent
		scheduler.attachEvent("onEventDeleted",function(id,event){			
			window.location.href = "clinic/deleteData?id_lichkham="+id;
		});
		//end delete action
		//Click event
		scheduler.attachEvent("onClick", function (id, e){
			if(view = 'appointment'){
				$("#div_detail").show();
				$('#div_create').hide();
				var start_date = scheduler.getEventStartDate(id);
				var end_date = scheduler.getEventEndDate(id);
				var dateEvent = start_date.getDate();
				var monthEvent = start_date.getMonth()+1;
				var yearEvent = start_date.getFullYear();
				var start_hours = start_date.getHours();
				var end_hours = end_date.getHours();
				var start_time = start_date.getMinutes(); if(start_time == 0){start_time = '00';}
				var end_time = end_date.getMinutes(); if(end_time == 0){end_time = '00';}
				var lido = scheduler.getEvent(id).reason;
				var email = scheduler.getEvent(id).email
				var benhnhan = scheduler.getEvent(id).text
				
				//frm chi tietkham
				document.getElementById("ngay_kham").value = yearEvent+'-'+monthEvent+'-'+dateEvent;
				document.getElementById("thoigian").value = start_hours+':'+start_time+' - '+end_hours+':'+end_time;
				document.getElementById("lidokham").value = lido;
				document.getElementById("id_lichkham").value = id;				
				document.getElementById("email").value = email;
				//frm chi tiet cuoc hen
				document.getElementById("benhnhan").value = benhnhan;
				document.getElementById("ct_email").value = email;
				document.getElementById("ct_id_lichkham").value = id;
				document.getElementById("ct_ngay_kham").value = yearEvent+'-'+monthEvent+'-'+dateEvent;
				document.getElementById("ct_thoi_gian").value = start_hours+':'+start_time+' - '+end_hours+':'+end_time;
				document.getElementById("ct_ngaykham").value = yearEvent+'-'+monthEvent+'-'+dateEvent;
				document.getElementById("ct_thoigian").value = start_hours+':'+start_time+' - '+end_hours+':'+end_time;
				document.getElementById("ct_lido").value = lido;
				document.getElementById("ct_email").value = email;
				document.getElementById("link_user").href = "clinic/medicalprofile/medicaluserprofile?email="+email+"&name="+benhnhan;
				//frm hen lich tai kham
				document.getElementById("tk_id_lichkham").value = id;
				document.getElementById("tk_email").value = email;
				//alert(lido);
				var strDayEvent = yearEvent+'-'+monthEvent+'-'+dateEvent;
				var today = new Date();
				var intMonth = today.getMonth()+1
				var strToday = today.getFullYear()+'-'+intMonth+'-'+today.getDate();
				if(strDayEvent < strToday){
					$('#del_appointment').hide();
					$('#frm_gr_huy').hide();
				}

			}
			return true;
		});
		scheduler.attachEvent("onEmptyClick", function (date, e){
			//any custom logic here
			$("#div_detail").hide();
			$('#div_create').show();
		});
		//check submit deleteappointment
		$("#ct_appointment" ).submit(function(event) {
			var lidohuy = document.getElementById("ct_lidohuy").value;
			if(lidohuy == ""){
				alert("Cần phải điền lí do hủy");
				event.preventDefault();
			}else{
				return true;
			}
		});
		//check change date in create tai kham
		$( "#tk_ngaykham" ).change(function() {//chon ngay kham->set thoi gian kham vao #thoigiankham
			var size = <?php echo sizeof($availabletime); ?>;
			var ngay_kham = parseDate(document.getElementById("tk_ngaykham").value);
			var all_lichkham = json_availabletime ;
			var today = new Date();
			var intMonth = today.getMonth()+1
			var strToday = today.getFullYear()+'-'+intMonth+'-'+today.getDate();
			var i = 0;
			var html = "<option value='null'>Chọn thời gian khám</option>";
			for(i;i<size;i++){	
				var start_date = new Date(all_lichkham[i].start_date);
				var monthEvent = start_date.getMonth()+1;
				var yearEvent = start_date.getFullYear();
				var temp_date = start_date.getDate();
				var dateEvent = yearEvent+'-'+monthEvent+'-'+temp_date;
				if(dateEvent<strToday){
					continue;
				}else if(all_lichkham[i].text.substr(22) == all_lichkham[i].cur_regis){
					continue;
				}else{
					var end_date = new Date(all_lichkham[i].end_date);										
					var start_hours = start_date.getHours();
					var end_hours = end_date.getHours();
					var start_time = start_date.getMinutes(); if(start_time == 0){start_time = '00';}
					var end_time = end_date.getMinutes(); if(end_time == 0){end_time = '00';}
					var compate_date = parseDate(dateEvent);
					if(compate_date.getTime() == ngay_kham.getTime()){
						html+="<option value='"+start_hours+":"+start_time+"-"+end_hours+":"+end_time+"'>"+start_hours+":"+start_time+" - "+end_hours+":"+end_time+"</option>";
					}
				}
			}
			if(html=="<option value='null'>Chọn thời gian khám</option>"){
				html = "<option value='null'>Không có ca khám nào</option>"
			}
			document.getElementById('tk_thoigian').innerHTML=html;
		});
		function parseDate(str) {
			var mdy = str.split('-');
			return new Date(mdy[2], mdy[1], mdy[0]);
		};
		//check chagen name and email in create appointment
		$( "#tao_benhnhan" ).change(function() {//chon ngay kham->set thoi gian kham vao #thoigiankham
			var email_benhnhan = document.getElementById("tao_benhnhan").value
			document.getElementById("tao_email").value = email_benhnhan;
		});
		$( "#tao_email" ).change(function() {//chon ngay kham->set thoi gian kham vao #thoigiankham
			var email_benhnhan = document.getElementById("tao_email").value
			document.getElementById("tao_benhnhan").value = email_benhnhan;
		});
		$( "#tao_ngaykham" ).change(function() {//chon ngay kham->set thoi gian kham vao #thoigiankham
			var size = <?php echo sizeof($availabletime); ?>;
			var ngay_kham = parseDate(document.getElementById("tao_ngaykham").value);
			var all_lichkham = json_availabletime ;
			var today = new Date();
			var intMonth = today.getMonth()+1
			var strToday = today.getFullYear()+'-'+intMonth+'-'+today.getDate();
			var i = 0;
			var html = "<option value='null'>Chọn thời gian khám</option>";
			for(i;i<size;i++){
				var start_date = new Date(all_lichkham[i].start_date);
				var temp_date = start_date.getDate();
				var monthEvent = start_date.getMonth()+1;
				var yearEvent = start_date.getFullYear();
				var dateEvent = yearEvent+'-'+monthEvent+'-'+temp_date;
				if(dateEvent<strToday){
					continue;
				}else if(all_lichkham[i].text.substr(22) == all_lichkham[i].cur_regis){
					continue;
				}else{
					var start_date = new Date(all_lichkham[i].start_date);
					var end_date = new Date(all_lichkham[i].end_date);					
					var start_hours = start_date.getHours();
					var end_hours = end_date.getHours();
					var start_time = start_date.getMinutes(); if(start_time == 0){start_time = '00';}
					var end_time = end_date.getMinutes(); if(end_time == 0){end_time = '00';}
					var compate_date = parseDate(dateEvent);
					if(compate_date.getTime() == ngay_kham.getTime()){
						html+="<option value='"+start_hours+":"+start_time+"-"+end_hours+":"+end_time+"'>"+start_hours+":"+start_time+" - "+end_hours+":"+end_time+"</option>";
					}
				}
			}
			if(html=="<option value='null'>Chọn thời gian khám</option>"){
				html = "<option value='null'>Không có ca khám nào</option>"
			}
			document.getElementById('tao_thoigian').innerHTML=html;
		});
		};

</script>	


