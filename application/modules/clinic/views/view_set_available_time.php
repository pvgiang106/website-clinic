<script type="text/javascript" charset="utf-8">	
	function init() {
		
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.config.first_hour = 7;
		scheduler.config.details_on_dblclick=true;
		scheduler.config.details_on_create=true;
		scheduler.config.dblclick_create = true;
		scheduler.config.drag_resize = 0;
		scheduler.config.drag_move = 0;
		scheduler.config.drag_create = 0;
		//Customer lightbox section lable
		scheduler.locale.labels.section_reason = 'Reason';
		scheduler.locale.labels.section_symptoms = 'Symptoms';
		scheduler.locale.labels.section_temperature = 'Temperature';
		scheduler.locale.labels.section_bloodpressure = 'Blood pressure';
		scheduler.locale.labels.section_pulse= 'Pulse';
		scheduler.locale.labels.section_diagnosis = 'Diagnosis';
		scheduler.locale.labels.section_advice = 'Advice';
		scheduler.locale.labels.section_costs = 'Cost';

		//Save attachEvent
		scheduler.attachEvent("onEventSave",function(id,event){
			if (!event.reason) {
				alert("Reason must not by empty");
				return false;
			}
			else{
				//window.location.href ="clinic/updateData?id_lichkham="+id+"&lidokham="+event.reason;
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
			return "Details "+event.email+" time = "+event.id;
		}
		var restricted_lightbox = [
				{ name: "time", height: 50, map_to: "auto", type: "time", focus: true},
				{ name: "reason", height: 50, map_to: "reason", type: "textarea", focus: true},
				{ name: "symptoms", height: 100, map_to: "trieu_chung", type: "textarea", focus: true},
				{ name: "temperature", height: 30, map_to: "nhiet_do", type: "textarea", focus: true},
				{ name: "bloodpressure", height: 30, map_to: "huyet_ap", type: "textarea", focus: true},
				{ name: "pulse", height: 30, map_to: "mach", type: "textarea", focus: true},
				{ name: "diagnosis", height: 100, map_to: "text", type: "textarea", focus: true},
				{ name: "advice", height: 100, map_to: "loi_khuyen", type: "textarea", focus: true},
				{ name: "costs", height: 30, map_to: "trieu_chung", type: "textarea", focus: true}
			];

		scheduler.config.lightbox.sections = restricted_lightbox
		scheduler.init('scheduler_here',new Date(),"week");
		//var events = <?php //echo $jsoncode ; ?>;
		//scheduler.parse(events,"json");
		}
</script>	



