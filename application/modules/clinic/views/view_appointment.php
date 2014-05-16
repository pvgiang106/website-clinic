<?php
	//var_dump($jsoncode);
?>

<script type="text/javascript" charset="utf-8">	
	function init() {
		
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.config.first_hour = 7;
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
				window.location.href ="clinic/updateData?id_lichkham="+id+"&lidokham="+event.reason;
			}
			return true;
		});
		//end save action
		//Delete attachEvent
		scheduler.attachEvent("onEventDeleted",function(id,event){			
				window.location.href ="clinic/deleteAppointment?id_lichkham="+id;
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
		var events = <?php echo $jsoncode ; ?>;
		scheduler.parse(events,"json");
		}
</script>	


