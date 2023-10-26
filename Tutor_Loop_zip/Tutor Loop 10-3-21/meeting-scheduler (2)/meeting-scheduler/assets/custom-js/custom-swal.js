
    
    /* afte add or update record this function will work */
    function swalSuccess(msg)
    {  
      return swal({
        title: "", text:msg, type:"success", confirmButtonColor:"#16BF49"
        });
    }  
    /* if record already exist then this function will work */
    function swalAlreadyExist()
    {
      return swal({
        title: "", text:"Record already exist!", type:"error", confirmButtonColor:"#FF0000"
        });   
    }
     /* if email/mobile already exist then this function will work */
     function swalAnyAlreadyExist(title="")
     {
       return swal({
         title: "", text:title+" Already exist!", type:"error", confirmButtonColor:"#FF0000"
         });   
     }
      /* if uploaded file is not  exist then this function will work */
      function swalFileUploadError(title="")
      {
        return swal({
          title: "", text:title+" !", type:"error", confirmButtonColor:"#FF0000"
          });   
      }
   
    /* if ajax request not completed thrn this function will work */
    function noAjaxRequest(){
      return  swal({
        title: "", text:"Ajax Request not completed. \n Kindly try again!", type:"warning", confirmButtonColor:"#304ffe"
        }); 
    }
    /* if server issue or no internet conn then this function will work */
    function serverIssue(){
      return swal({
        title: "", text:"Server issue or check net connection. \n Kindly try again!", type:"error", confirmButtonColor:"#FF0000"
        }); 
    }

    /* if no response from controller then this function will work  */
    function noResponse(){
      return  swal({
        title: "", text:"Request not completed. \n Kindly try again!", type:"warning", confirmButtonColor:"#304ffe"
        }); 
    }

     /* no rights message for view button */ 
    function swalNoViewRights(title="")
     {
       return swal({
         title: "", text:" No permission to view ! "+title, type:"", confirmButtonColor:"#FF0000"
         });   
     }

      

    /* no rights message for add button */ 
    function swalNoAddRights(title="")
    {
      return swal({
        title: "", text:"NO ADD RIGHTS"+title, type:"", confirmButtonColor:"#FF0000"
        });   
    }
    /* no rights message for edit button */ 
    function swalNoEditRights(title="")
    {
      return swal({
        title: "", text:" No permission to edit ! "+title, type:"", confirmButtonColor:"#FF0000"
        });   
    }
    /* no rights message for delete button */ 
    function swalNoDeleteRights(title="")
    {
      return swal({
        title: "", text:" No permission to delete data ! ", type:"", confirmButtonColor:"#FF0000"
        });   
    }
     /* no rights message for status button */ 
     function swalNoStatusRights(title="")
     {
       return swal({
         title: "", text:" No permission to change status ! ", type:"", confirmButtonColor:"#FF0000"
         });   
     }

    /*pn notification*/ 
    function pnSuccess(title="")
     {
        new PNotify({
        title: '<b>Success</b>',
        text: title,
        type: 'success',
        shadow: true,
        buttons: {
        sticker: false
        }
      });
     }

      function pnStatusSuccess(title="")
     {
        new PNotify({
        title: '<b>Success</b>',
        text: "Status changed successfully.!",
        type: 'success',
        shadow: true,
        buttons: {
        sticker: false
        }
      });
     }
      function pnDeleteSuccess(title="")
     {
        new PNotify({
        title: '<b>Success</b>',
        text: "Record deleted successfully.!",
        type: 'success',
        shadow: true,
        buttons: {
        sticker: false
        }
      });
     }

     function pnAlreadyExist(title="")
     {
        new PNotify({
        title: '<b>Warning</b>',
        text: "<b>"+title+" already exist..!</b>",
        type: 'warning',
        shadow: true,
        buttons: {
        sticker: false
        }
      });
     }

      function pnnoAjaxRequest(){

       new PNotify({
        title: '<b>Error</b>',
        text: "<b>Ajax Request not completed. \n Kindly try again..!</b>",
        type: 'error',
        shadow: true,
        buttons: {
        sticker: false
        }
      }); 

       
    }
    /* if server issue or no internet conn then this function will work */
    function pnserverIssue(){

       new PNotify({
        title: '<b>Error</b>',
        text: "<b>Server issue or check net connection. \n Kindly try again..!</b>",
        type: 'error',
        shadow: true,
        buttons: {
        sticker: false
        }
      }); 
     
    }

    /* if no response from controller then this function will work  */
    function pnnoResponse(){
       new PNotify({
        title: '<b>Error</b>',
        text: "<b>Request not completed. \n Kindly try again..!</b>",
        type: 'error',
        shadow: true,
        buttons: {
        sticker: false
        }
      }); 
      
    }

    /*not exist*/
    function pnNotExist(title="")
     {
        new PNotify({
        title: '<b>Error</b>',
        text: title,
        type: 'error',
        shadow: true,
        buttons: {
        sticker: false
        }
      });
     }

   
    /* function to get success text */
    function successText(btn_text)
    {
      if(btn_text=="Add") return msg = "<b>Record added succesfully!</b>";
      else if(btn_text=="Update") return msg = "<b>Record updated succesfully!</b>";
      else return msg = "<b>Record saved succesfully!</b>";
    }

    function btnDisabled(btn_id)
    {
      return document.getElementById(btn_id).disabled = true;
    }
    function btnEnabled(btn_id)
    {
      return document.getElementById(btn_id).disabled = false;
    }
    function btnProcessing(btn_id)
    {
      return $(btn_id).html('<span class="fa fa-spinner fa-spin"></span> Processing...');
    }


    /*no rights notification*/
    /* no rights message for add button */ 
    function swalNoRights(title="")
    {
      return swal({
        title: "", text:"No "+title+" Permission..!", type:"", confirmButtonColor:"#FF0000", customClass: 'no-rights-swal-wide',
        });   
    }

    function pnFileNotAllowed(title="")
    {
        new PNotify({
        title: '<b>Error</b>',
        text: "<b>"+title+"</b>",
        type: 'error',
        shadow: true,
        buttons: {
        sticker: false
        }
      });
    }

    /*function pnDontHaveRight(title="")
     {
        new PNotify({
        title: '<b>No '+title+' Rights</b>',
        text: "<b>Contact Your Admin!</b>",
        type: 'warning',
        shadow: true,
        buttons: {
        sticker: false
        }
      });
     }    */