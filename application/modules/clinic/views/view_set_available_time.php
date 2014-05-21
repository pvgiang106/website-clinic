<?php
	//var_dump($json_timeavailable);


?>
<script type="text/javascript" charset="utf-8">	
	function init() {
		
		var step = 60;
		var format = scheduler.date.date_to_str("%H:%i");

		scheduler.config.hour_size_px=(60/step)*88;
		scheduler.templates.hour_scale = function(date){
			html="";
			for (var i=0; i<60/step; i++){
				html+="<div style='height:10px;line-height:10px;'>"+format(date)+"</div>";
				date = scheduler.date.add(date,step,"minute");
			}
			return html;
		}
		
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.config.time_step  = 60;

		scheduler.config.details_on_dblclick=true;
		scheduler.config.details_on_create=true;
		scheduler.config.dblclick_create = true;
		scheduler.config.drag_resize = 0;
		scheduler.config.drag_move = 0;
		//scheduler.config.readonly = true;
		//Customer lightbox section lable
		scheduler.locale.labels.section_socakham = 'Số ca khám';
		scheduler.locale.labels.section_soluongkham = 'Số lượng khám';


		//Save attachEvent
		scheduler.attachEvent("onEventSave",function(id,event){
			if (!event.text) {
				alert(event.start_date);
				return false;
			}
			else{
				window.location.href ="setuptime/insertData?start_date="+event.start_date+"&end_date="+event.end_date+"&socakham="+event.socakham+"&soluongkham="+event.text;
			}
			return true;
		});
		//end save action
		//Delete attachEvent
		scheduler.attachEvent("onEventDeleted",function(id,event){			
				window.location.href ="setuptime/deleteData?start_date="+event.start_date+"&end_date="+event.end_date;
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
		var events = <?php echo $json_timeavailable ; ?>;
		scheduler.parse(events,"json");
		}
</script>	



