 // create Agora client
 var client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

 var localTracks = {
     videoTrack: null,
     audioTrack: null
 };
 var remoteUsers = {};
 // Agora client options
 var options = {
     appid: null,
     channel: null,
     uid: null,
     token: null
 };

 // the demo can auto join channel with params in url
 $(() => {
     var urlParams = new URL(location.href).searchParams;
     options.appid = urlParams.get("appid");
     options.channel = urlParams.get("channel");
     options.token = urlParams.get("token");
     if (options.appid && options.channel) {
         $("#appid").val(options.appid);
         $("#token").val(options.token);
         $("#channel").val(options.channel);
         $("#join-form").submit();
     }
 })

 function getCounterData(obj) {
     var hours = parseInt($('.e-m-hours', obj).text());
     var minutes = parseInt($('.e-m-minutes', obj).text());
     var seconds = parseInt($('.e-m-seconds', obj).text());
     return seconds + (minutes * 60) + (hours * 3600);
 }

 function setCounterData(s, obj) {
     var hours = Math.floor((s % (60 * 60 * 24)) / (3600));
     var minutes = Math.floor((s % (60 * 60)) / 60);
     var seconds = Math.floor(s % 60);

     console.log(hours, minutes, seconds);

     if(s % 60 == 0) {
         $.ajax({
             type:'POST',
             url:'/user_call',
             data:'_token = <?php echo csrf_token() ?>&call_id='+$("#channel").val(),
             success:function(data) {

             }
         });
     }

     $('.e-m-hours', obj).html(hours);
     $('.e-m-minutes', obj).html(minutes);
     $('.e-m-seconds', obj).html(seconds);
 }

 function timer() {

     var count = getCounterData($(".counter"));

     $("#success-alert-with-token").css("display", "block");
     var timer = setInterval(function() {
         count++;
         if (count == 0) {
             //clearInterval(timer);
             //return;
         }
         setCounterData(count, $(".counter"));
     }, 1000);

 }

 $("#join-form").submit(function (e) {
 //$(document).ready(function(){
     e.preventDefault();
     //$("#join").attr("disabled", true);

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': '{{csrf_token()}}'
         }
     });
     $.ajax({
         url:'{{ url("api/get_token_by_channel") }}',
         type:'POST',
         data: {
             channel: $("#channel").val()
         },
         success:async function(result){
             try {
                 options.appid = 'd88b2a459fb54b9c871f37ca55b5bea5';
                 options.token = result.token;
                 options.channel = result.channel;
                 await join();
                 if(options.token) {
                     timer();
                 } else {
                     $("#success-alert a").attr("href", `index.html?appid=${options.appid}&channel=${options.channel}&token=${options.token}`);
                     $("#success-alert").css("display", "block");
                 }
             } catch (error) {
                 console.error(error);
             } finally {
                 $("#leave").attr("disabled", false);
             }
         }
     });
 })

 $("#leave").click(function (e) {
     leave();
 })

 async function join() {

     // add event listener to play remote tracks when remote user publishs.
     client.on("user-published", handleUserPublished);
     client.on("user-unpublished", handleUserUnpublished);

     // join a channel and create local tracks, we can use Promise.all to run them concurrently
     [ options.uid, localTracks.audioTrack, localTracks.videoTrack ] = await Promise.all([
         // join the channel
         client.join(options.appid, options.channel, options.token || null),
         // create local tracks, using microphone and camera
         AgoraRTC.createMicrophoneAudioTrack(),
         AgoraRTC.createCameraVideoTrack()
     ]);

     // play local video track
     localTracks.videoTrack.play("local-player");
     //$("#local-player-name").text(`localVideo(${options.uid})`);
     $("#local-player-name").text(`{{ auth()->user()->name }}`);

     // publish local tracks to channel
     await client.publish(Object.values(localTracks));
     console.log("publish success");
 }

 async function leave() {
     for (trackName in localTracks) {
         var track = localTracks[trackName];
         if(track) {
             track.stop();
             track.close();
             localTracks[trackName] = undefined;
         }
     }

     // remove remote users and player views
     remoteUsers = {};
     $("#remote-playerlist").html("");

     // leave the channel
     await client.leave();

     $("#local-player-name").text("");
     $("#join").attr("disabled", false);
     $("#leave").attr("disabled", true);
     console.log("client leaves channel success");
 }

 async function subscribe(user, mediaType, name) {
     const uid = user.uid;
     // subscribe to a remote user
     await client.subscribe(user, mediaType);
     console.log("subscribe success");
     if (mediaType === 'video') {
         const player = $(`
   <div class="col-lg-6" id="player-wrapper-${uid}">
     <!--<p class="player-name">${name}</p>-->
     <div id="player-${uid}" class="player2"></div>
   </div>
 `);
         $("#remote-playerlist").append(player);
         user.videoTrack.play(`player-${uid}`);
     }
     if (mediaType === 'audio') {
         user.audioTrack.play();
     }
 }

 function handleUserPublished(user, mediaType) {
     const id = user.uid;
     remoteUsers[id] = user;
     const name = '{{auth()->user()->name}}';
     subscribe(user, mediaType, name);
 }

 function handleUserUnpublished(user) {
     const id = user.uid;
     delete remoteUsers[id];
     $(`#player-wrapper-${id}`).remove();
 }