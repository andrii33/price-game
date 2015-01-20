$(function() {
   $(document).ready(function() {
       $("#game-form").on( "submit", function( event ) {
           event.preventDefault();
           var data = $(this).serialize();
           var url = "/index/?" + data.toString();
           setButtonText('Wait ...');
           console.log(data);
           $.ajax({
               url: url
           }).done(function(data) {
               if (data == 'ok') {
                   setResultColor('#63D73E');
                   setButtonText('You win');
                   restoreDefault();
               } else if (data == 'mistake') {
                   setResultColor('#D72927');
                   setButtonText('You lost');
                   restoreDefault();
               } else {
                   alert('error');
               }

           });
       });

   });

   function restoreDefault() {
       setTimeout(function() {
           setResultColor('#f4f4f4');
           setButtonText('Play');
       }, 2500);
   }

   function setButtonText(text) {
       $('.js-game-button').val(text);
   }

   function setResultColor($color) {
       $('.js-result').css('background', $color);
   }
});