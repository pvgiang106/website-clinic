<?php 
	//var_dump($jsoncode);
	$arrayEmail = array();
	foreach($allemail as $row){		
		$temp['key'] = $row->email;
		$temp['label'] = $row->email;
		array_push($arrayEmail,$temp);
	}
	$jsonemail = json_encode($arrayEmail);
	$arrayIdlichkham = array();
	foreach($allid_lichkham as $row){		
		$temp['key'] = $row->id_lichkham;
		$temp['label'] = $row->id_lichkham;
		array_push($arrayIdlichkham,$temp);
	}
	$jsonid_lichkham = json_encode($arrayIdlichkham);

	//var_dump($jsonid_lichkham);
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
		scheduler.config.drag_create = 0;
		//Customer lightbox section lable
		scheduler.locale.labels.section_reason = 'Reason';
		scheduler.locale.labels.section_email = 'Email';
		scheduler.locale.labels.section_idlichkham = 'Examination schedule ID';
		scheduler.locale.labels.section_symptoms = 'Symptoms';
		scheduler.locale.labels.section_temperature = 'Temperature';
		scheduler.locale.labels.section_bloodpressure = 'Blood pressure';
		scheduler.locale.labels.section_pulse= 'Pulse';
		scheduler.locale.labels.section_diagnosis = 'Diagnosis';
		scheduler.locale.labels.section_advice = 'Advice';
		scheduler.locale.labels.section_costs = 'Cost';

		//Save attachEvent
		scheduler.attachEvent("onEventSave",function(id,event){
			if (!event.email || !event.id_lichkham || !event.reason || !event.trieu_chung || !event.nhiet_do || !event.huyet_ap || !event.mach || !event.text || !event.loi_khuyen || !event.chi_phi ) {
				alert("Please insert full infomation");
				return false;
			}
			else{
				window.location.href ="medicalprofile/updateData?id_chitiet="+id+"&email="+event.email+"&id_lichkham="+event.id_lichkham+"&reason="+event.reason+"&trieu_chung="+event.trieu_chung+"&nhiet_do="+event.nhiet_do+"&huyet_ap="+event.huyet_ap+"&mach="+event.mach+"&chuan_doan="+event.text+"&loi_khuyen="+event.loi_khuyen+"&chi_phi="+event.chi_phi;
			}
			return true;
		});
		//end save action
		//Delete attachEvent
		scheduler.attachEvent("onEventDeleted",function(id,event){			
				window.location.href ="medicalprofile/deleteData?id_chitiet="+id+"&email="+event.email;
			return true;
		});
		//end delete action
		scheduler.templates.lightbox_header = function(start, end, event){
			return "Details "+event.email+" time = "+event.id;
		}
		var restricted_lightbox = [
				{ name: "email", height: 50, map_to: "email", type: "select",options:<?php echo $jsonemail; ?>},
				{ name: "idlichkham", height: 50, map_to: "id_lichkham", type: "select",options:<?php echo $jsonid_lichkham; ?>},
				{ name: "reason", height: 50, map_to: "reason", type: "textarea", focus: true},
				{ name: "symptoms", height: 100, map_to: "trieu_chung", type: "textarea", focus: true},
				{ name: "temperature", height: 30, map_to: "nhiet_do", type: "textarea", focus: true},
				{ name: "bloodpressure", height: 30, map_to: "huyet_ap", type: "textarea", focus: true},
				{ name: "pulse", height: 30, map_to: "mach", type: "textarea", focus: true},
				{ name: "diagnosis", height: 100, map_to: "text", type: "textarea", focus: true},
				{ name: "advice", height: 100, map_to: "loi_khuyen", type: "textarea", focus: true},
				{ name: "costs", height: 30, map_to: "chi_phi", type: "textarea", focus: true}
			];

		scheduler.config.lightbox.sections = restricted_lightbox
		scheduler.init('scheduler_here',new Date(),"week");
		<?php if(isset($jsoncode)){ echo 'var events = '.$jsoncode.' ; scheduler.parse(events,"json");';}?>
		
		}
</script>




