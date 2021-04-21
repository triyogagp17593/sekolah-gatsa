<style type="text/css">
 .main {
    margin:auto 10%;
    padding-top: 8%;
    text-align: center;
    color: #696969;
  }
  h4 {
    margin-bottom: 40px;
    font-size: 10px;
    color: #fff;
  }
  #clock > div {
    border-radius: 5px;
    background: #ffa500;
    padding: 10px 10px 5px 10px;
    color: #fff;
    display: inline-block;
  }
  #clock > div > p {
    font-size: 10px;
  }
  #days, #hours, #minutes, #seconds {
    padding: 15px;
    font-size: 10px;
    background: #fb8e00;
    display: inline-block;
    width: 40px;
  }
  span.turn {
    animation: turn 0.7s ease;
  }
  @keyframes turn {
    0% {transform: rotateX(0deg)}
    100% {transform: rotateX(360deg)}
  }
</style>
<div id="clock">
  <div><span id="days"></span><p>Hari</p></div>
  <div><span id="hours"></span><p>Jam</p></div>
  <div><span id="minutes"></span><p>Menit</p></div>
  <div><span id="seconds"></span><p>Detik</p></div>
</div>
<script type="text/javascript">
   function animation(span) {
       span.className = "turn";
       setTimeout(function () {
           span.className = ""
       }, 700);
   }

   function Countdown() {
 
       setInterval(function () {

          var hari    = document.getElementById("days");
          var jam     = document.getElementById("hours");
          var menit   = document.getElementById("minutes");
          var detik   = document.getElementById("seconds");
             
          var deadline    = new Date("May 17, 2020 23:59:59");
          var waktu       = new Date();
          var distance    = deadline - waktu;
             
          var days    = Math.floor((distance / (1000*60*60*24)));
          var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
             
          if (days < 10)
          {
             days = '0' + days;
          }
          if (hours < 10)
          {
             hours = '0' + hours;
          }
          if (minutes < 10)
          {
             minutes = '0' + minutes;
          }
          if (seconds < 10)
          {
             seconds = '0' + seconds;
          }

          hari.innerHTML    = days;
          jam.innerHTML     = hours;
          menit.innerHTML   = minutes;
          detik.innerHTML   = seconds;
          //animation
          animation(detik);
          if (seconds == 0) animation(menit);
          if (minutes == 0) animation(jam);
          if (hours == 0) animation(hari);

       }, 1000);
   }

   Countdown();
 
</script>