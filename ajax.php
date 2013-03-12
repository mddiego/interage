<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
{
    ini_set("allow_url_fopen", 1); 
    ini_set("allow_url_include", 1); 
    $q = isset($_GET['q']) ? $_GET['q'] : '';
    
    //recupera XML atraves da url da API do youtube
    $html = file_get_contents("https://gdata.youtube.com/feeds/api/videos?q=".rawurlencode($q)."&max-results=30&v=2");
    //parseamento do XML em objetos
    $xml = new SimpleXMLElement($html);
    
    $videos = array();
    foreach($xml->entry as $video)
    {
        $media = $video->children('http://search.yahoo.com/mrss/');
        $attrs = $media->group->thumbnail[0]->attributes();
        $thumb = $attrs['url'];
        
        $url = (string)$video->link['href'];
        $parseUrl = parse_url($url);
        
        parse_str($parseUrl['query'],$gets);
        $videos[] = array
                    (
                        "id"     => (string)$gets['v']
                        ,"title" => (string)$video->title
                        ,"thumb" => (string)$thumb
                    );
    }            
    die(json_encode($videos));
}
?>


