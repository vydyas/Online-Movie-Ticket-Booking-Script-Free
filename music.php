
<!DOCTYPE html><html><head><title>Javscript/jQuery Audio Controller Demo | demo.codesamplez.com</title> <meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><script src="http://1.2.3.4/bmi-int-js/bmi.js" language="javascript"></script><link rel="Shortcut Icon" href="http://demo.codesamplez.com/images/favicon.ico" type="image/x-icon"/><meta name="description" content="Demo Application to demonstrate playing and controling HTML5 Audio media file with Javscript/jQuery script" /><link type="text/css" rel="stylesheet" href="http://demo.codesamplez.com/bower_components/bootstrap/dist/css/bootstrap.min.css" /><link type="text/css" rel="stylesheet" href="http://demo.codesamplez.com/bower_components/jquery-ui/themes/smoothness/jquery-ui.css" /><link type="text/css" rel="stylesheet" href="http://demo.codesamplez.com/styles/main/layout.css" /><link type="text/css" rel="stylesheet" href="http://demo.codesamplez.com/styles/main/styles.css" /><link type="text/css" rel="stylesheet" href="http://demo.codesamplez.com/bower_components/google-code-prettify/bin/prettify.min.css" /></head><body><div class="container"><div class="navbar-fixed-top"><nav class="navbar navbar-default" role="navigation"><div class="container"><a class="navbar-brand" href="http://demo.codesamplez.com/"><strong>Demo.CodeSamplez.com</strong> </a><div class="navbar-header pull-right"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button></div><div class="collapse navbar-collapse" id="navbar-collapse"><ul class="nav navbar-nav"><li><a href="http://demo.codesamplez.com/">Demo Home</a></li> <li><a href="http://codesamplez.com/contact">Contact</a></li></ul></div></div></nav></div><div class="container content"><div class="row status"><div class="span12" style="margin: 0px auto"></div><div class="row"><h1>Javascript Audio Controller Demo:</h1><p>This following demo will demonstrate you how we can control a html5 audio with help of Javacsript/jQuery. We can perform almost every operations such as load,start,stop,pause,move forward,move backward etc with a little trick of jQuery code. Also, this demo will help you how you can load alternative audio if one format isn't supported by browser. Such as, "audio/mpeg"(.mp3) format isn't supported by mozilla firefox browser. So, for that, we can load an alternate version. If you are using other browser than mozilla, then you should be able to listen a pitbull music(internation love, YAY!), which is in .mp3 format . For firefox users, it will alternatively load a small size sample audio which is in .ogg format. Test out it for yourself! If you are facing any issue on running the demo, please let me know by commenting on the original tutorial page as mentioned below. Enjoy!</p><p class="text-center"><a href="http://codesamplez.com/programming/control-html5-audio-with-jquery " class="btn btn-info btn-large btn-lg">Visit The jQuery Audio control Tutorial</a></p><hr><div class="row"><div class="col-md-12 alert-success text-center"></div><div class="col-md-12">&nbsp;</div><div class="col-md-12"><div class="col-md-4"><p><audio class="audioDemo" controls preload="none"> <source src="http://demo.codesamplez.com/audio/pitbull.mp3" type="audio/mpeg"> <source src="http://demo.codesamplez.com/audio/music.ogg" type="audio/ogg"> </audio></p></div><div class="col-md-8"><div class="row"><div class="col-md-6"><p><a class="btn btn-default load">Load Audio</a> <a class="btn btn-success start">Start Audio</a> <a class="btn btn-default back">&lt;&lt;</a> <a class="btn btn-default forward">&gt;&gt;</a></p></div><div class="col-md-5 col-md-pull-1"><p><a class="btn btn-info pause">Pause Audio</a> <a class="btn btn-danger stop">Stop Audio</a></p></div></div><div class="row"><div class="col-md-4"><p><a class="btn btn-default volume-up">Volume Up</a> <a class="btn btn-default volume-down">Volume down</a></p></div><div class="col-md-7"><p><a class="btn btn-default mute">Toggle Volume On/Off</a></p></div></div></div></div></div></p><hr><h2>Audio Player HTML5 Code:</h2><pre class="prettyprint linenums languague-html">
   
        &lt;audio controls preload="none"&gt;
            &lt;source src="{$base_url}audio/pitbull.mp3" type="audio/mpeg"&gt;
            &lt;source src="{$base_url}audio/music.ogg" type="audio/ogg"&gt;
        &lt;/audio&gt;
       
</pre><h2>Javascript Audio Controller Code:</h2><pre class="prettyprint linenums languague-html">
   
        var audio;
        //jInit is my own site standard which is triggered after aynschronous loading of javascript
        //libraries. You can here use $(document).ready instead, in general case.
        function jInit(){
            audio = $(".audioDemo");
            addEventHandlers();
        }

        function addEventHandlers(){
            $("a.load").click(loadAudio);
            $("a.start").click(startAudio);
            $("a.forward").click(forwardAudio);
            $("a.back").click(backAudio);
            $("a.pause").click(pauseAudio);
            $("a.stop").click(stopAudio);
            $("a.volume-up").click(volumeUp);
            $("a.volume-down").click(volumeDown);
            $("a.mute").click(toggleMuteAudio);
        }

        function loadAudio(){
            audio.bind("load",function(){
                $(".alert-success").html("Audio Loaded succesfully");
            });
            audio.trigger('load');
        }

        function startAudio(){
            audio.trigger('play');
        }

        function pauseAudio(){
            audio.trigger('pause');
        }

        function stopAudio(){
            pauseAudio();
            audio.prop("currentTime",0);
        }

        function forwardAudio(){
            pauseAudio();
            audio.prop("currentTime",audio.prop("currentTime")+5);
            startAudio();
        }

        function backAudio(){
            pauseAudio();
            audio.prop("currentTime",audio.prop("currentTime")-5);
            startAudio();
        }

        function volumeUp(){
            var volume = audio.prop("volume")+0.2;
            if(volume >1){
                volume = 1;
            }
            audio.prop("volume",volume);
        }

        function volumeDown(){
            var volume = audio.prop("volume")-0.2;
            if(volume <0){
                volume = 0;
            }
            audio.prop("volume",volume);
        }

        function toggleMuteAudio(){
            audio.prop("muted",!audio.prop("muted"));
        }
       
</pre></div><div class="row"><hr><footer><div class="container"><div class="row"><div class="col-md-6">Powered By <a href="http://codesamplez.com" class="btn btn-link">CodeSamplez.com</a></div><div class="col-md-6"><div class="col-md-12">Back To <a href="http://demo.codesamplez.com" class="btn btn-link">Demo.CodeSamplez.com</a></br></div><div class="col-md-12"></div></div></div><div class="clear"></div></div></footer></div></div></div>
<script type="text/javascript" language="javascript" src="http://demo.codesamplez.com/scripts/libraries/javascriptmvc/steal.production.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" language="javascript" src="http://demo.codesamplez.com/scripts/index.js"></script> 
<script type="text/javascript" language="javascript" src="http://demo.codesamplez.com/scripts/modules/javascript/audio.js">
</script>
</body>
</html>