$(document.body).ready(function () {
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
                console.log("about");
                setTimeout(function(){
                      $('#about').removeClass('hidden');
                      $("#logo").addClass('hidden');
                  }, 500);
            }
        });
        $(document).on('mouseleave', '#about', function(event){
            setTimeout(function(){
                $('#about').addClass('hidden');
                $("#logo").removeClass('hidden');
            }, 500);
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
    $(document).on('mouseleave', '#hide-toggle-activation-button', function(event){
      $('#hide-toggle-activation-button').addClass("hidden");
      $('#show-toggle-activation-button').removeClass("hidden");
    });
    $(document).on('mouseover', '#show-toggle-activation-button', function(event){
      $('#show-toggle-activation-button').addClass("hidden");
      $('#hide-toggle-activation-button').removeClass("hidden");
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
