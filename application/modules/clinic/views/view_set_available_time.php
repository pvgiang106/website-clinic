<?php
	//var_dump($json_timeavailable);


?>
<script type="text/javascript" charset="utf-8">	
	function init() {
		
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
		
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.config.time_step  = 30;
		scheduler.config.first_hour = 0;
		scheduler.config.details_on_dblclick=true;
		scheduler.config.details_on_create=true;
		scheduler.config.dblclick_create = true;
		scheduler.config.drag_resize = 0;
		scheduler.config.drag_move = 0;
		//scheduler.config.readonly = true;
		//Customer lightbox section lable
		scheduler.locale.labels.section_socakham = 'Số ca khám';
		scheduler.locale.labels.section_soluongkham = 'Số lượng khám tối đa/ Ca khám';
		scheduler.locale.labels.section_time = 'Chọn thời gian';


		//Save attachEvent
		scheduler.attachEvent("onEventSave",function(id,event){
			if (!event.text) {
				alert(event.start_date);
				return false;
			}
			else{
				window.location.href ="clinic/insertAvailableTime?start_date="+event.start_date+"&end_date="+event.end_date+"&socakham="+event.socakham+"&soluongkham="+event.text;
			}
			return true;
		});
		//end save action
		//Delete attachEvent
		scheduler.attachEvent("onEventDeleted",function(id,event){			
				window.location.href ="clinic/deleteAvailableTime?start_date="+event.start_date+"&end_date="+event.end_date;
			return true;
		});
		//end delete action
		scheduler.templates.lightbox_header = function(start, end, event){
			return "Cài đặt lịch khám";
		}
		scheduler.attachEvent("onEventCreated", function(id){
			scheduler.getEvent(id).text = "4";
		});
		var restricted_lightbox = [
				{ name: "time", height: 50, map_to: "auto", type: "time"},
				{ name: "socakham", height: 50, map_to: "socakham", type: "textarea",default_value: "1", focus:true},
				{ name: "soluongkham",height: 50, map_to: "text",type: "textarea"}
			];

		scheduler.config.lightbox.sections = restricted_lightbox
		scheduler.init('scheduler_here',new Date(),"week");
		var events = <?php echo $json_availabletime ; ?>;
		scheduler.parse(events,"json");
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
			var all_lichkham = <?php echo $json_availabletime ; ?> ;
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
				}else if(all_lichkham[i].text == all_lichkham[i].cur_regis){
					continue;
				}else{
					var start_date = new Date(all_lichkham[i].start_date);
					var end_date = new Date(all_lichkham[i].end_date);
					var temp_date = start_date.getDate();
					var monthEvent = start_date.getMonth()+1;
					var yearEvent = start_date.getFullYear();
					var dateEvent = yearEvent+'-'+monthEvent+'-'+temp_date
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
		function parseDate(str) {
			var mdy = str.split('-');
			return new Date(mdy[2], mdy[1], mdy[0]);
		};
		}
</script>	



