$(document).ready(function() {
  NProgress.configure({ showSpinner: false });
  function nospaces(t){
      if(t.value.match(/\s/g)){
          alert('Maaf, Username Tidak Boleh Menggunakan Spasi,..');
          t.value=t.value.replace(/\s/g,'');
      }
  }
  function toDuit(number) {
      var number = number.toString(), 
      duit = number.split('.')[0], 
      duit = duit.split('').reverse().join('')
          .replace(/(\d{3}(?!$))/g, '$1,')
          .split('').reverse().join('');
      return 'Rp ' + duit ;
  }

  
  $('.right').click(function () {
      var position = $('.container-category').position();
      var r=position.left-$(window).width()
      $('.container-category').animate({
          'left': ''+r+'px'
      });
  });    
      
  $('.left').click(function () {
      var position = $('.container-category').position();
      var l=position.left+$(window).width()
      if(l<=0)
      {
      $('.container-category').animate({
          'left': ''+l+'px'
      });
      }
  });    
  
  
  //Here we are getting the number of the divs with class contentContainer inside the div container
  var length = $('div .container-category').children('div .contentContainer').length;
  //Here we are setting the % width depending on the number of the child divs
  $(".container-category").width(length*100 +'%');

});
