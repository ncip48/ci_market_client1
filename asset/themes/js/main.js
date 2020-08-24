function ChangeUrl(title, url) {
  if (typeof history.pushState != "undefined") {
    var obj = { Title: title, Url: url };
    history.pushState(obj, obj.Title, obj.Url);
  } else {
    alert("Browser does not support HTML5.");
  }
}

$(document).ready(function () {
  NProgress.configure({ showSpinner: false });
  function nospaces(t) {
    if (t.value.match(/\s/g)) {
      alert("Maaf, Username Tidak Boleh Menggunakan Spasi,..");
      t.value = t.value.replace(/\s/g, "");
    }
  }
  function toDuit(number) {
    var number = number.toString(),
      duit = number.split(".")[0],
      duit = duit
        .split("")
        .reverse()
        .join("")
        .replace(/(\d{3}(?!$))/g, "$1,")
        .split("")
        .reverse()
        .join("");
    return "Rp " + duit;
  }

  $(".right").click(function () {
    var position = $(".container-category").position();
    var r = position.left - $(window).width();
    $(".container-category").animate({
      left: "" + r + "px",
    });
  });

  $(".left").click(function () {
    var position = $(".container-category").position();
    var l = position.left + $(window).width();
    if (l <= 0) {
      $(".container-category").animate({
        left: "" + l + "px",
      });
    }
  });

  var length = $("div .container-category").children("div .contentContainer")
    .length;
  $(".container-category").width(length * 100 + "%");

  $( document ).on( "click", "#btn-search-bottom", function() {
    $("#show").toggle(500);
  });

  //console.log(window.history.back());

  $( document ).on( "click", "#btn-following-action", function() {
    var username = $(this).attr("data-username");
    var ur2 = $(this).attr("data-urls").split("/");
    var uri = window.location.pathname.split("/");
      var ur3 = window.location.origin + "/user/" + username + "/following";
      ChangeUrl("", ur3);
    $.ajax({
      url: "",
      success: function (data) {
        var dom = $(data);
        var modal = dom.filter(".root").html();
        var m = $(modal);
        var modals = m.filter(".modal-following").html();
        //console.log(m)
        $("#modal-body").html(modals);
        $("#modal-following").fadeIn(300);
        //alert('Load was performed.');
      },
    });
  });

  $( document ).on( "click", "#btn-follower-action", function() {
    var username = $(this).attr("data-username");
    var ur2 = $(this).attr("data-urls").split("/");
    var uri = window.location.pathname.split("/");
      var ur3 = window.location.origin + "/user/" + username + "/follower";
      ChangeUrl("", ur3);
    $.ajax({
      url: "",
      success: function (data) {
        var dom = $(data);
        var modal = dom.filter(".root").html();
        var m = $(modal);
        var modals = m.filter(".modal-follower").html();
        //console.log(m)
        $("#modal-body-follower").html(modals);
        $("#modal-follower").fadeIn(300);
        //alert('Load was performed.');
      },
    });
  });

  window.onpopstate = function (event) {
    //console.log('on popstate');
    $("#modal-following").fadeOut(300);
  };

  $( document ).on( "click", "#tutup-modal", function() {
    var uri = window.location.pathname.split("/");
    var ur3 = $(this).attr("data-url").split("/");
    if (ur3[4] === undefined) {
      var ur2 = window.location.origin;
      ChangeUrl("", ur2);
    } else {
      var ur2 = window.location.origin + "/user/" + ur3[4];
      window.history.replaceState(null, null, ur2);
    }
    $.ajax({
      url: "",
      success: function (data) {
        var dom = $(data);
        var modal = dom.filter(".root").html();
        var m = $(modal);
        var modals = m.filter(".modal-following").html();
        $("#modal-following").fadeOut(300);
        $("#modal-follower").fadeOut(300);
      },
    });
  });

  $("#showHidePw").on('click', function(event) {
    event.preventDefault();
    if($('#show_hide_password input').attr("type") == "text"){
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass( "fa-eye-slash" );
        $('#show_hide_password i').removeClass( "fa-eye" );
    }else if($('#show_hide_password input').attr("type") == "password"){
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass( "fa-eye-slash" );
        $('#show_hide_password i').addClass( "fa-eye" );
    }
});
});
