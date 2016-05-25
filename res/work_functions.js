        $( document ).ready(function() {
            //Gömmer alla jobbdetaljrutor
            $(".jobDetails").hide();
            
            //Sätter startdatumet till det nuvarande datumet
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day);
           $('#date_from').val(today);
            
            //Sätter slutdatumet till en vecka från nu
            var twoWeeksFromNow = new Date();
            var _day = ("0" + twoWeeksFromNow.getDate()).slice(-2);
            var _month = ("0" + (twoWeeksFromNow.getMonth() + 2)).slice(-2);
            var _today = twoWeeksFromNow.getFullYear()+"-"+(_month)+"-"+(_day);
            $('#date_to').val(_today);
        });
            
        $( ".jobHeader" ).click(function() {
            //Roterar pluset till ett minus
            if($(this).next().is(":hidden")){
                $(this).find(".plus").css({
                     '-webkit-transform' : 'rotate(90deg)',
                      '-moz-transform'    : 'rotate(90deg)',
                      '-ms-transform'     : 'rotate(90deg)',
                      '-o-transform'      : 'rotate(90deg)',
                      'transform'         : 'rotate(90deg)'
                });
            //Roterar minuset till ett plu
            }else{
                $(this).find(".plus").css({
                     '-webkit-transform' : 'rotate(0deg)',
                      '-moz-transform'    : 'rotate(0deg)',
                      '-ms-transform'     : 'rotate(0deg)',
                      '-o-transform'      : 'rotate(0deg)',
                      'transform'         : 'rotate(0deg)'
                }); 
            }
            $(this).next().animate({
                height: "toggle"
                }, 300, function() {
            });
        });