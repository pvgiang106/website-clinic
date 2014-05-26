<?php
	//var_dump($waitingappoitment);
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
		//end scale hours
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.config.first_hour = 5;
		scheduler.config.details_on_dblclick=true;
		scheduler.config.details_on_create=true;
		scheduler.config.dblclick_create = false;
		scheduler.config.drag_resize = 0;
		scheduler.config.drag_move = 0;
		scheduler.config.drag_create = 0;
		scheduler.locale.labels.section_reason = 'Reason'

		//Save attachEvent
		scheduler.attachEvent("onEventSave",function(id,event){
				if (!event.reason) {
						alert("Reason must not by empty");
						return false;
				}
				else{
						window.location.href ="clinic/acceptAppointment?id_lichkham="+id;
				}
				return true;
		});
		//end save action
		//Delete attachEvent
		scheduler.attachEvent("onEventDeleted",function(id,event){                      
						window.location.href ="clinic/rejectAppointment?id_lichkham="+id;
				return true;
		});
		//end delete action
		scheduler.templates.lightbox_header = function(start, end, event){
				return "Appoitment with : "+event.text;
		}
		var restricted_lightbox = [
						{ name: "reason", height: 200, map_to: "reason", type: "textarea", focus: true}
				];

		scheduler.config.lightbox.sections = restricted_lightbox
		scheduler.init('scheduler_here',new Date(),"week");
		var events = <?php echo $json_wait_appointment ; ?>;
		scheduler.parse(events,"json");
		}
</script>       