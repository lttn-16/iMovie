$(document).ready(function(){

    //user online
    // function loadUsersOnline(){
    //     $.get("admin_function.php?onlineusers=result", function(data){
    //         $(".useronline").text(data);
    //             });
    // }

    // setInterval(function(){
    //     loadUsersOnline();
    // }, 500);
    
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
    $('#example').DataTable();

    //CK Editor 5
    var editor = CKEDITOR.replace( 'editor' );
    CKFinder.setupCKEditor( editor );
   
});










