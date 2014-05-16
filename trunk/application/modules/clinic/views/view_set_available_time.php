<?php
	//var_dump($jsoncode);
?>
<script type="text/javascript" charset="utf-8">	
	function init() {
		
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.config.first_hour = 7;
		scheduler.config.details_on_dblclick=true;
		scheduler.config.details_on_create=true;
		scheduler.config.dblclick_create = true;
		scheduler.config.drag_resize = 0;
		scheduler.config.drag_move = 0;
		//scheduler.config.readonly = true;
		//Customer lightbox section lable
		scheduler.locale.labels.section_quantity = 'Quantity';


		//Save attachEvent
		scheduler.attachEvent("onEventSave",function(id,event){
			if (!event.text) {
				alert(event.start_date);
				return false;
			}
			else{
				window.location.href ="setuptime/updateData?ngay_kham="+id+"&start_date="+event.start_date+"&end_date="+event.end_date+"&so_luong_kham="+event.text;
			}
			return true;
		});
		//end save action
		//Delete attachEvent
		scheduler.attachEvent("onEventDeleted",function(id,event){			
				//window.location.href ="clinic/deleteAppointment?id_lichkham="+id;
			return true;
		});
		//end delete action
		scheduler.templates.lightbox_header = function(start, end, event){
			return "Create new availabletime";
		}
		scheduler.attachEvent("onEventCreated", function(id){
			scheduler.getEvent(id).text = "5";
		});
		var restricted_lightbox = [
				{ name: "time", height: 50, map_to: "auto", type: "time"},
				{ name: "quantity", height: 50, map_to: "text", type: "textarea", focus:true},
			];

		scheduler.config.lightbox.sections = restricted_lightbox
		scheduler.init('scheduler_here',new Date(),"week");
		var events = <?php echo $jsoncode ; ?>;
		scheduler.parse(events,"json");
		}
</script>	



