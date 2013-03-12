<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Interage - Youtube</title>
        <script src="./js/jquery1.8.0.js"></script>
        <script src="./js/bootstrap.js"></script>
        <script src="./js/jquery.fancybox.js"></script>
        <link rel="stylesheet" href="./css/bootstrap.css" />
        <link rel="stylesheet" href="./css/main.css" />
        <link rel="stylesheet" href="./css/jquery.fancybox.css" />
        <script>
            function ajaxBusca(_q)
            {
                $("#divVideos").html("<div class='span12 text-center'><img src='img/load.gif' /></div>");
                if(typeof _ajax != 'undefined')
                {    
                    _ajax.abort();
                }
                _ajax = $.ajax(
                        {
                            type: "GET",
                            url: "ajax.php",
                            //async: false,
                            data:
                            {
                                q: _q,
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                //_num = data.size();
                                _html = new Array();
                                for(k in data)
                                {
                                    _title = data[k].title;
                                    _id = data[k].id;
                                    _thumb = data[k].thumb;
                                    _html.push('<div class="span6 divVideo">'
                                                  +'<a  data-fancybox-type="iframe" class="fancybox link" target="_blank" href="https://www.youtube.com/v/'+_id+'" title="'+_title+'" >'
                                                  +     '<img src="'+_thumb+'" />'
                                                  +     '<p>'+_title+'</p>'
                                                  +'</a>'
                                                  //+"<iframe src='https://www.youtube.com/v/"+_id+"' name='src' ></iframe><br />"
                                                  +'<a href="https://twitter.com/share" data-url="https://www.youtube.com/watch?v='+_id+'" data-text="'+_title+'" class="twitter-share-button" data-lang="en"></a>'
                                              +'</div>');
                                }
                                $("#divVideos").html(_html.join(""));
                                //$(".divVideo:odd").css({"background":"#F0F0F0"})
                                
                                //$(".divVideo:even").css({"background":"#FAFAFA"})
                                
                                $(".fancybox").fancybox();
                            	
                                $.getScript('http://platform.twitter.com/widgets.js', function()
                                {
                              		$('#divVideos').find('a.twitter-share-button').each(function(i)
                                    {
                            		    var loadedTweetButton = new twttr.TweetButton($(this).get(0));
                        			    loadedTweetButton.render();    
                                    });
                            	});
                            }    
                        })
            }
            $(document).ready(function()
            {
                $("#buscar").click(function()
                {
                    _q = typeof $("#pesquisa").val() != 'undefined' ? $("#pesquisa").val() : '';
                    ajaxBusca(_q);
                })
                $(".formBusca").submit(function()
                {
                    return false;
                })
            })
        
        </script>
    </head>

    <body>
        
            
                
                
                <div class="navbar navbar-inner barraBusca">
                
                    <div class="container-fluid">
                        <div class="row-fluid text-center">
                            <input type="text" class="span10" id="pesquisa" placeholder="Digite sua busca aqui..." title="Digite sua busca aqui..." />
                            <button type="submit" class="btn " id="buscar"><span class="icon-search"></span></button>
                        </div>
                    </div>
                </div>
                    
                
            
            
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div id="divVideos">
                            
                            </div>
                        </div>
                    </div>
                </div>
                
            
            
    </body>
</html>