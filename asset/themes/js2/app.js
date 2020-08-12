$(document).ready(function() {
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
                        var html = dom.filter('.root').html();
                        var title = dom.filter('title').html();
                        var header = dom.filter('header').html();
                        $('.root').html(html);
                        $('title').html(title);
                        $('header').html(header);
                        $('footer').hide();
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
