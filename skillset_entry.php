<?php

include("manpower_class.php");
$newObj = new manpower();
$skills = $newObj->getSkills();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Skill Set Entry</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  
  <script>
	$(document).ready(function(){		
		GetSkills();
		$('#skills_table').DataTable();				
	})
	
	function GetSkills(){		
		
		$.ajax({
			type:"POST",
			url:"response_manpower.php",
			data:{
				type:'GetSkills'				
			},
			success:function(response){				
				resdata = $.parseJSON(response);				
				$('#skills_table').DataTable({
					"bDestroy":true,
					data:resdata,
					"columns":[
						
						{data:'skillset'},
						{data:'remarks'},
						{
							"mData": null,
							"bSortable": false,
						   "mRender": function (o) { return '<button class="btn btn-primary" onclick = EditSkills('+ o.sid + ') data-toggle="modal" data-target="#EditModal">Edit</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick = DeleteSkills('+ o.sid + ')>Delete</button>'; }
						}			
					]					
				});
			}
		});	
	
	}
	
	function EditSkills(id){
		
		if(id==''){
			
			alert('Add Skill Name');
			$('#skill_name').focus();			
			event.preventDefault();
		
		}else{
			
			$.ajax({
			  type: "POST",
			  url: "response_manpower.php",
			  data: {
				type:'EditSkills',
				sid:id
			  },
			  dataType: "json",       
			  success: function(response){
					$('#e_sid').val(response[0].sid);
					$('#e_skill_name').val(response[0].skillset);
					$('#e_remarks').val(response[0].remarks);					
				}  
			});
			
		}
	
	}
	
	function UpdateSkils(){
		
		var sid = $('#e_sid').val();
		var skill_name = $('#e_skill_name').val();
		var remarks = $('#e_remarks').val();
		if(skill_name==''){
			
			alert('Add Skill Name');
			$('#skill_name').focus();			
			event.preventDefault();
		
		}else if(remarks==''){
			
			alert('Add Remarks');
			$('#remarks').focus();			
			event.preventDefault();
			
		}else{
			
			$.ajax({
			  type: "POST",
			  url: "response_manpower.php",
			  data: {
				type:'UpdateSkills',
				sid:sid,
				skill_name:skill_name,
				remarks:remarks
			  },
			  dataType: "json",       
			  success: function(response){
					console.log(response);			
				}  
			});
			
		}	
		
	}
	
	
	function AddSkills() {
		
		var skill_name = $('#skill_name').val();
		var remarks = $('#remarks').val();
		if(skill_name==''){
			
			alert('Add Skill Name');
			$('#skill_name').focus();			
			event.preventDefault();
		
		}else if(remarks==''){
			
			alert('Add Remarks');
			$('#remarks').focus();			
			event.preventDefault();
			
		}else{
			
			$.ajax({
				
			  type: "POST",
			  url: "response_manpower.php",
			  data: {
				type:'AddSkills',
				skill_name:skill_name,
				remarks:remarks
			  },
			  dataType: "json",       
			  success: function(response){
				resdata = $.parseJSON(response);
				
				$('#exampleModal').modal('hide');				
				location.reload();				
			  }  
			
			});
			
		}	
		
	}
	
	function DeleteSkills(id){
		
		if(id==''){
			
			alert('Add Skill Name');
			$('#skill_name').focus();			
			event.preventDefault();
		
		}else{
			
			$.ajax({
			  type: "POST",
			  url: "response_manpower.php",
			  data: {
				type:'DeleteSkills',
				sid:id
			  },
			  dataType: "json",       
			  success: function(response){
				  resdata = $.parseJSON(response);
					if(resdata==1){
						
						alert('Skills Deleted');
						location.reload();	
						
					}else{
						
						alert('Skills Not Delete');
						location.reload();	
					}			
				}  
			});
			
		}
		
	}
	
	
	
	
	
  </script> 
<style>
a.editor-create {
        display: inline-block;
        margin-bottom: 0.5em;
    }
</style>  
</head>
<body>

<div class="container">
    <div class="col-md-12" style="padding-top:50px;">
        <div class="well">
            <h2>Skill Set Entry</h2>
			<button class="btn btn-primary" id="add_skills" data-toggle="modal" data-target="#exampleModal"> Add Sills </button>
        </div>
        <table id="skills_table" class="table" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Skill Name</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Skill Set</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		  <div class="form-group">
			<label for="exampleInputEmail1">Skill</label>
			<input type="text" class="form-control" id="skill_name" aria-describedby="emailHelp" placeholder="Enter Skill">    
		  </div>
		  <div class="form-group">
			<label for="exampleInputPassword1">Remarks</label>
			<input type="text" class="form-control" id="remarks" placeholder="Remarks">
		  </div>
		  
		  <button class="btn btn-primary" onclick="AddSkills();">Submit</button>
		
      </div>
      
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Skill Set</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		  <div class="form-group">
			<label for="exampleInputEmail1">Skill</label>
			<input type="text" class="form-control" id="e_skill_name" aria-describedby="emailHelp" placeholder="Enter Skill">    
			<input type="hidden" class="form-control" id="e_sid" aria-describedby="emailHelp" placeholder="Enter Skill"> 
		  </div>
		  <div class="form-group">
			<label for="exampleInputPassword1">Remarks</label>
			<input type="text" class="form-control" id="e_remarks" placeholder="Remarks">
		  </div>
		  
		  <button class="btn btn-primary" onclick="UpdateSkils();">Submit</button>
		
      </div>
      
    </div>
  </div>
</div>

</body>
</html>
