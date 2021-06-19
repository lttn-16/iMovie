$(document).ready(function(){

    
    //Select all checkbox
    $('#selectAllBoxes').click(function(e){
        
      if(this.checked){
          $('.checkBoxes').each(function(){
              this.checked = true;
          })
      } else {
          $('.checkBoxes').each(function(){
              this.checked = false;
          })
      }
    });

    //Data Table
    $('#example').DataTable({
        "order": [[ 0, "desc" ]]
    });


    //CK Editor 5
    var editor = CKEDITOR.replace( 'editor' );
    CKFinder.setupCKEditor( editor );
   
});










