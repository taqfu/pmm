$(document.body).ready(function () {
    if($("#logo").length > 0){
        window.setInterval(function(){
            $("#logo").css("border", "1px #d9d9d9 dotted");
            setTimeout(function(){
                $("#logo").css("border", "0px none rgb(33, 37, 41)");
            }, 750);




        }, 3000);

    }
        $(document).on('click', ".replace-with", function(event){
            id = event.target.id;
            strArr = id.split("-");
            idNum = strArr[strArr.length-1];
            replaceMode = true;
            replaceStr  = "";
            withStr = "";
            strArr.forEach (function(str){
                if (str == "with"){
                    replaceMode = false;
                }
                if (str == "with" || str == "replace" || str == idNum){
                    return;
                }
                if (replaceMode){
                    replaceStr  = replaceStr.length>0
                      ? replaceStr + "-" + str
                      : str;
                } else {
                  withStr  = withStr.length>0
                    ? withStr + "-" + str
                    : str;
                }

            });
            $("#" + replaceStr + idNum).addClass('hidden');
            $("#" + withStr + idNum).removeClass('hidden');

        });
        $(document).on('change', '[name=messageType]', function(event){
            if($("[name=messageType]:checked").val()=='email'){
                $("#public-message-input").addClass('hidden');
                $("#email-input").removeClass('hidden');
            } else if($("[name=messageType]:checked").val()=='public'){
              $("#public-message-input").removeClass('hidden');
              $("#email-input").addClass('hidden');
            }
        });
        $(document).on('change', '[name=confirmPeriod]', function(event){
            if($("[name=confirmPeriod]:checked").val()=='immediately'){
                $("#confirm-iterations").addClass('hidden');
            } else {
                $("#confirm-iterations").removeClass('hidden');
            }

        });
        $(document).on('click', '#no-pin', function(event){
            $("#public-profile-without-pin").submit();
        });
        $(document).on('click', '.message-link', function(event){
            idBeginsWith = "message-link";
            id = event.currentTarget.id=="" ?
              searchElementForPartialParentID(event.currentTarget, idBeginsWith)
              : event.currentTarget.id;
            idNumber = id.substr(idBeginsWith.length);
            if ($("#message-body" + idNumber).hasClass('hidden')){
                $("#message-body" + idNumber).removeClass('hidden');
            } else {
                $("#message-body" + idNumber).addClass('hidden');
            }
        });
        $(document).on('click', '#logo', function(event){
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){
                console.log("about-mobile");
                $('#about-mobile').removeClass('hidden');
                $("#logo").addClass('hidden');
            }
        });
        $(document).on('click', '#about-mobile', function(event){
            $('#about-mobile').addClass('hidden');
            $("#logo").removeClass('hidden');
        });

        $(document).on('mouseover', '#logo', function(event){
            if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){

                      $('#about').removeClass('hidden');
                      $("#logo").addClass('hidden');

            }
        });

        $(document).on('mouseleave', '#about', function(event){

                $('#about').addClass('hidden');
                $("#logo").removeClass('hidden');

        });
        $(document).on('mouseexit', '#about', function(event){
          $('#about').addClass('hidden');
          $("#logo").removeClass('hidden');

        });

    $(document).on('change', '[name=checkInEvery]', function(event){
        if($("[name=checkInEvery]").val()==1){
            $(".plural").addClass('hidden');
        } else {
            $(".plural").removeClass('hidden');
        }

    });
    $(document).on('click', '.cancel-button', function(event){
        var id = event.target.id.substr(7, event.target.id.length-7);
        $("#" + id).addClass('hidden');
        $("#show-" + id).removeClass('hidden');
    });
    $(document).on('click', '.cover-button', function(event){
        var id = event.target.id.substr(6, event.target.id.length-6);
        $("#cover-" + id).addClass('hidden');
        $("#expose-" + id).removeClass('hidden');
        $("#" + id).addClass('hidden');
        $("#" + id + "-cover").removeClass('hidden');
    });
    $(document).on('click', '.expose-button', function(event){
        var id = event.target.id.substr(7, event.target.id.length-7);
        $("#cover-" + id).removeClass('hidden');
        $("#expose-" + id).addClass('hidden');
        $("#" + id).removeClass('hidden');
        $("#" + id + "-cover").addClass('hidden');
    });
    $(document).on('mouseleave', '.hide-toggle-activation-button', function(event){
      var preString = "hide-toggle-activation-button";
      messageID = event.target.id.substr(preString.length);
      $('#hide-toggle-activation-button' + messageID).addClass("hidden");
      $('#show-toggle-activation-button' + messageID).removeClass("hidden");
    });
    $(document).on('mouseover', '.show-toggle-activation-button', function(event){
      var preString = "show-toggle-activation-button";
      messageID = event.target.id.substr(preString.length);
      $('#show-toggle-activation-button' + messageID).addClass("hidden");
      $('#hide-toggle-activation-button' + messageID).removeClass("hidden");
    });
    $(document).on('click', '.replace-primary-button', function(event){
        var id = event.target.id.substr(16, event.target.id.length-16);
        $("#" + id + "-primary").addClass('hidden');
        $("#" + id + "-secondary").removeClass('hidden');
    });
    $(document).on('click', '.replace-secondary-button', function(event){
        var id = event.target.id.substr(18, event.target.id.length-18);
        $("#" + id + "-primary").removeClass('hidden');
        $("#" + id + "-secondary").addClass('hidden');
    });
    $(document).on('click', '.show-button', function(event){
        var id = event.target.id.substr(5, event.target.id.length-5);
        $("#" + id).removeClass('hidden');
        $("#show-" + id).addClass('hidden');
    });
    $(document).on('click', '.delete-message-button', function(event){
        var id = event.target.id.substr(14, event.target.id.length-14);
        if (confirm("Are you sure you want to delete this message?")) {
                $("form#delete-message" + id).submit();
        }
    });
});
function searchElementForPartialParentID(element, partialParentID){
    if (element.id == ""
        || (element.id.length>0 && element.id.substring(0, partialParentID.length) != partialParentID)){
        searchElementForParentID(element.parentElement, partialParentID);
    }
    else {
        return element.id;
    }
}
