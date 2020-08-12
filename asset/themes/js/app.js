$(document).ready(function() {
    //var sourceImage = document.getElementById("ban1");
                /* var colorThief = new ColorThief();
                var color = colorThief.getColor(sourceImage);
                document.getElementById("main-nav-container").style.backgroundColor = "rgb(" + color + ")"; */

                /*$('#my-carousel').on('slid.bs.carousel', function () {  
                    var srchome = $('.active').find('img').attr('src');
                    //console.log (srchome);
                    var imageUrl = srchome;
                    $("#main-nav-container").css("background-image", "url(" + imageUrl + ")"); 
                    //$("#main-nav-container").css("background-image", "url(" + imageUrl + ")").prop("required", true); 
                    //$("#main-nav-container").attr("data-adaptive-background", '1');
                    //$("#main-nav-container").prop("required", true);
                }); */

                /* $('#my-carousel').on('slide.bs.carousel', function (e) {
                        var sourceImage=$(e.relatedTarget).find('img')[0]; //get the active sliding image
                        var colorThief=new ColorThief();
                        var color = colorThief.getColor(sourceImage);
                        document.getElementById("main-nav-container").style.backgroundColor = "rgb(" + color+")";
                }); */

    $(function(){
        var replacePage = function(url) {
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                beforeSend: function() {
                    NProgress.set(0.4);
                },
                success: function(data){
                    setTimeout(function() {
                        NProgress.done();
                        var dom = $(data);
                        //console.log(dom.filter('body').html());
                        var html = dom.filter('.root').html();
                        var title = dom.filter('title').html();
                        //var header = dom.filter('header').html();
                        $('.root').html(html);
                        $('title').html(title);
                        //$('header').html(header);
                        //$('footer').hide();
                    }, 1000);
                }
            });
        }
    
        $(document.body).on('click', "a" ,function(e){
            history.pushState(null, null, this.href);
            replacePage(this.href);
            e.preventDefault();
        });
    
        $(window).bind('popstate', function(){
            replacePage(location.pathname);
        });

    });
});
