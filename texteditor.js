 function loadcss(jsdnowurl) {
   var head = document.getElementsByTagName('head')[0],
   link = document.createElement('link');
   link.type = 'text/css';
   link.rel = 'stylesheet';
   link.href = jsdnowurl;
   head.appendChild(link);
   return link;
 }
String.prototype.capitalize = function() {
    return this.replace(/\b\w/g, function(a) { return a.toUpperCase(); });
};

function getQueryVariable(variable)
{

//var query = url.substring(url.indexOf("#")+1);
var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
function replaceURLWithHTMLLinks(text) {
    var re = /(\(.*?)?\b((l)(https|ftp|file|http):\/\/[-a-z0-9+&@#\/%?=~_()|!:,.;]*[-a-z0-9+&@#\/%=~_()|])/ig;
    return text.replace(re, function(match, lParens, url) {
        var rParens = '';
        lParens = lParens || '';
        var lParenCounter = /\(/g;
        while (lParenCounter.exec(lParens)) {
            var m;
            if (m = /(.*)(\.\).*)/.exec(url) ||
                    /(.*)(\).*)/.exec(url)) {
                url = m[1];
                rParens = m[2] + rParens;
            }
        }
        return lParens + "<a href='" + url + "'>" + url + "</a>" + rParens;
    });
}

function imgengine() {

//var divedit = document.getElementById('jstextengine');
//divedit.innerHTML += '</br></br><a href="'+jsdcontenturl+'editor.php?file=' + yaziismi + '">Düzenle</a>';

$( jsdauthorid ).html(jsdauthor);


$(jsdtextareaid).html(function(index, html){
    return html.replace(/(http\S+\.(jpg|gif|png|bmp|jpeg|gif))/gim,'<a href="$1" data-rel="lightcase:scrollHor"><img class="jsresim" src="$1" /></a>');
});

$(jsdtextareaid).html(function(i, html) {

    return html.replace(/(?:http:\/\/|https:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/g, '<div class="videodiv"> <a href="//www.youtube.com/embed/$1?version=3" data-rel="lightcase"><i class="fa fa-play-circle playbutton" aria-hidden="true"></i><img class="videodiv" src="https://img.youtube.com/vi/$1/maxresdefault.jpg" alt="https://youtu.be/$1"></a></div>');
	
});
jQuery(document).ready(function($) {
$('a[data-rel^=lightcase]').lightcase();
});

var elm = document.getElementById('jstextengine');
elm.innerHTML = replaceURLWithHTMLLinks(elm.innerHTML);
document.body.innerHTML = document.body.innerHTML.replace(/lhttps/g, 'https');
document.body.innerHTML = document.body.innerHTML.replace(/lhttp/g, 'http');


}

loadcss(jsdthemeurl + "styles.css");
loadcss(jsdcontenturl + "style.css");
loadcss("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

$('.jsdfacebooklink').attr("href", jsdfacebookurl);
	$('.jsdtwitterlink').attr("href", jsdtwitterurl);
	$('.jsdyoutubelink').attr("href", jsdyoutubeurl);
	$('.jsdflickrlink').attr("href", jsdflickrurl);
	$('.jsdinstagramlink').attr("href", jsdinstagramurl);
	$('.jsdlinkedinlink').attr("href", jsdlinkedinurl);
	
	
jQuery(document).ready(function($) {
		$('a[data-rel^=lightcase]').lightcase();
		showSequenceInfo: false
	});