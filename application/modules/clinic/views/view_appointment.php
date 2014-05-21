<?php
	//var_dump($json_appointment);
	//var_dump($json_availabletime);
	//var_dump($availabletime);
	if(isset($_GET['task'])) {$task = $_GET['task'];} else { $task = 'appointment'; }
	
	$temp_fh = substr($first_hour,0,2);
	$temp_lh = substr($last_hour,0,2);
	$temp_li = substr($last_hour,3,2);
	if($temp_li != '00'){$temp_lh++;}
	
?>
<script type="text/javascript" charset="utf-8">	
	function init() {
		var json_availabletime = <?php echo $json_availabletime;?>;
		//scale hours section
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
		//end scale hours
		var first_hour = <?php echo '\''.$temp_fh.'\''; ?>;
		var last_hour = <?php echo '\''.$temp_lh.'\'' ;?>;
		
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.config.first_hour = first_hour;
		scheduler.config.last_hour = last_hour;
		scheduler.config.time_step  = 15;
		scheduler.config.details_on_dblclick=true;
		scheduler.config.details_on_create=true;
		scheduler.config.dblclick_create = false;
		scheduler.config.drag_resize = 0;
		scheduler.config.drag_move = 0;
		scheduler.config.drag_create = 0;
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
				if ((ev.end_date - ev.start_date) / 60000 > 60) { // if event is longer than 40 minutes
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
		
		var size_availabletime = <?php echo sizeof($availabletime);?>;
		for(i=0;i<size_availabletime;i++){
			scheduler.addMarkedTimespan({  
				start_date: new Date(json_availabletime[i].start_date),
				end_date:   new Date(json_availabletime[i].end_date),      // marks the entire day
				css:   "green_section"					// the applied css style
			});
		}
		scheduler.templates.lightbox_header = function(start, end, event){
			return "Appoitment with : "+event.text;
		}
		var restricted_lightbox = [
				{ name: "reason", height: 200, map_to: "reason", type: "textarea", focus: true}
			];

		scheduler.config.lightbox.sections = restricted_lightbox
		scheduler.init('scheduler_here',new Date(),"week");
		
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
				window.location.href ="clinic/updateData?id_lichkham="+id+"&lidokham="+event.reason;
			}
		});
		//end save action
		//Delete attachEvent
		scheduler.attachEvent("onEventDeleted",function(id,event){			
			window.location.href = "clinic/deleteData?id_lichkham="+id;
		});
		//end delete action
		
		}
</script>	


