<?php
    
    $feed_url = "http://blog.soulightapp.com/rss/";
    $error = '<p>RSS feed could not be retrieved.</p>';
    $content = @file_get_contents($feed_url);

    if($content != false) {
        
        $x = new SimpleXmlElement($content);
        if (isset($x->channel->item[0])) {
            $html = '';
            $i = 0;
            foreach($x->channel->item as $entry) {
                if($i == 3) break;
                $date = strtotime($entry->pubDate);
                $title = (strlen($entry->title) > 30) ? substr($entry->title,0,27).'...' : $entry->title;
                $description = strip_tags($entry->description);
                $description_short = (strlen($description) > 85) ? substr($description,0,82).'...' : $description;
                $html .= '<li> <a href="'.$entry->link.'">'; 
                $html .= '<div class="date"><h6><span>'.date("j", $date).'</span>'.date("M", $date).'</h6></div>';
                $html .= '<div class="post-description"><h5>'.$title.'</h5><p>'.$description_short.'</p></div>';
                $html .= '</a></li>';
                $i++;
            }
        }
        else {
            $html = $error;            
        }
    }
    else {
        $html = $error;
    }
    
?>

<!doctype html><html class=no-js><head><meta charset=utf-8><meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1"><title>Soulight – your mobile wellbeing companion</title><meta name=description><meta name=viewport content="width=device-width, initial-scale=1, user-scalable=no"><link rel=stylesheet href=styles/application.css><meta name=mobile-web-app-capable content=yes><meta name=apple-mobile-web-app-capable content=yes><meta name=apple-mobile-web-app-status-bar-style content=#54d9d7><meta name=apple-mobile-web-app-title content="Let’s Dance"></head><body><!--[if lt IE 9]>
 <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
 <![endif]--><div class=main><section><div class=bg></div><div class=signup><a class=icon href="http://musemantik.us2.list-manage.com/subscribe?u=d05d41c4c82e4f0bbcb05e518&id=34bf32dc57"><svg viewbox="0 0 512 512"><path d="M101.3 141.6v228.9h0.3 308.4 0.8V141.6H101.3zM375.7 167.8l-119.7 91.5 -119.6-91.5H375.7zM127.6 194.1l64.1 49.1 -64.1 64.1V194.1zM127.8 344.2l84.9-84.9 43.2 33.1 43-32.9 84.7 84.7L127.8 344.2 127.8 344.2zM384.4 307.8l-64.4-64.4 64.4-49.3V307.8z"></path></svg><span>Sign up to our newsletter</span></a></div><div class=social><a class=icon href=https://twitter.com/soulightapp><svg viewbox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg></a> <a class=icon href=https://www.facebook.com/pages/Soulight/230574356976514><svg viewbox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg></a> <a class=icon href="https://www.pinterest.com/soulightapp/"><svg viewbox="0 0 512 512"><path d="M266.6 76.5c-100.2 0-150.7 71.8-150.7 131.7 0 36.3 13.7 68.5 43.2 80.6 4.8 2 9.2 0.1 10.6-5.3 1-3.7 3.3-13 4.3-16.9 1.4-5.3 0.9-7.1-3-11.8 -8.5-10-13.9-23-13.9-41.3 0-53.3 39.9-101 103.8-101 56.6 0 87.7 34.6 87.7 80.8 0 60.8-26.9 112.1-66.8 112.1 -22.1 0-38.6-18.2-33.3-40.6 6.3-26.7 18.6-55.5 18.6-74.8 0-17.3-9.3-31.7-28.4-31.7 -22.5 0-40.7 23.3-40.7 54.6 0 19.9 6.7 33.4 6.7 33.4s-23.1 97.8-27.1 114.9c-8.1 34.1-1.2 75.9-0.6 80.1 0.3 2.5 3.6 3.1 5 1.2 2.1-2.7 28.9-35.9 38.1-69 2.6-9.4 14.8-58 14.8-58 7.3 14 28.7 26.3 51.5 26.3 67.8 0 113.8-61.8 113.8-144.5C400.1 134.7 347.1 76.5 266.6 76.5z"></path></svg></a></div><div class=slide-content><h1>S<span>o</span>ulight</h1><h2>your mobile wellbeing companion</h2><a href="https://play.google.com/store/apps/details?id=com.musemantik.soulight"><img class=launch-button src=./images/icon_googleplay.png></a> <a href="http://musemantik.us2.list-manage.com/subscribe?u=d05d41c4c82e4f0bbcb05e518&id=34bf32dc57"><img class="launch-button apple" src=./images/icon_appstore.svg></a></div><a class=scroll-down><span class=hidden>Scroll down</span></a><script src=https://apis.google.com/js/platform.js async defer></script><div class=gplusone><div class=g-plusone data-href="https://market.android.com/details?id=com.musemantik.soulight"></div></div></section><section><div class=slide-content><div class=lead-paragraph><h2>Welcome to Soulight</h2><h4>Soulight is a health and wellbeing app with real purpose</h4><ul class=features-list><li><h5>Discover your mood</h5><p>Become aware of your emotions and connect with your inner-self.</p></li><li><h5>Explore your mood</h5><p>Accept where you are and become mindful of your emotions.</p></li><li><h5>Lift your mood</h5><p>Head towards positive emotions and achieve your happiness potential.</p></li></ul></div></div></section><section><div class=slide-content><div class=stage-wrap><h2>The Soulight journey</h2><h4>Three steps to improved mental wellbeing.</h4><div class=stage-indicator><ul class=stagenav><li><a data-target=1 class=active>Find</a></li><li><a data-target=2>Explore</a></li><li><a data-target=3>Move</a></li></ul></div><div class=stage-smartphone><div class=phone>&nbsp;</div></div><div class=stage-description><div class="description-1 active"><h3>Begin by discovering where you are now</h3><p>In step one you’ll use a combination of colour, music, emoticons and words to discover your mood in a matter of seconds.</p></div><div class=description-2><h3>Next, explore and become mindful of your emotions</h3><p>In step two, music and colour lead you to explore, accept, reflect and connect with yourself.</p></div><div class=description-3><h3>Finally, take a journey towards your desired mood</h3><p>In step three you’ll choose your journey and let personalised music and colour guide you to where you want to be.</p></div></div></div></div></section><section><div class=slide-content><div class=find-out-more><h2>The story of Soulight</h2><h4>Soulight is made by <a href=http://musemantik.com>Musemantik</a> and powered by MusicFlow, a unique technology with innovative dynamic music capabilities.</h4><p>Embodying interdisciplinary concepts from artificial intelligence, music therapy, mindfulness and positive psychology, Soulight helps boost emotional wellbeing, prevent anxiety and stress, and alleviate depression.</p></div><div class=blog-list><h2>Follow our progress</h2><ul class=blog-posts><?php echo $html;?></ul>                        <h5 class="blog-read-more"><a href="http://blog.soulightapp.com">Visit the Soulight blog »</a></h5>
</div></div><h6 class=thanks><strong><a href=http://letsdance.agency>Website and branding by Let’s Dance</a></strong><span><br>Supported by Nominet Trust, the Digital Health Institute and New Media Scotland’s Alt-w Fund with investment from the Scottish Government. Part of the Ginsberg ecosystem.</span></h6></section></div><script src=scripts/main.min.js></script><script src=scripts/vendor.min.js></script><script>
            onePageScroll(".main", {
                responsiveFallback: 600,
                easing: "cubic-bezier(.55,0,.1,1)",
                animationTime: 1000
            });
        </script><!--[if lt IE 9]>
 <script src="scripts/rem.min.js"></script>
 <script src="scripts/html5shiv.min.js"></script>
 <script src="scripts/respond.min.js"></script>
 <![endif]--><script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-63330992-1', 'auto');
            ga('send', 'pageview');
        </script><script type=text/javascript>
            var sc_project=788705; 
            var sc_invisible=1; 
            var sc_security="71cf02d8"; 
            var sc_https=1; 
            var sc_remove_link=1; 
            var scJsHost = (("https:" == document.location.protocol) ?
            "https://secure." : "http://www.");
            document.write("<sc"+"ript type='text/javascript' src='" +
            scJsHost+
            "statcounter.com/counter/counter.js'></"+"script>");
        </script></body></html>