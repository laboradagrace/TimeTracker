<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        
        <style>
          td{
            background-image: url("https://cdn.pixabay.com/photo/2016/09/07/11/37/tropical-1651426__340.jpg")
          }
          .container, .well{
            background-color: black;
          }
          form{
            
            margin: 10px 250px;
          }
          h3, h4,h2,label{
            text-align: center;
            color:white;
          }
          #divTime{
            color:white;
            border-style: solid;
            border-width: medium;
            border-color: #ff6600;
            border-radius: 1rem;
            width:35%;
            height:20%
            padding:10%;
            text-align: center;
          }
          #currentTime{
            color:#cc6600;
          }
          fieldset{
            margin-left:50px;
            margin-right:50px;
          }
          .btn-warning{
            width:100%;
          }
          #btntake{
            margin-top: 10px;
            margin-bottom: 30px;
          }
          .input-group-addon:first-child {
              border-right: 0;
              color: white;
              background-color: darkorange;
          }
        </style>
    </head>
    <body>
    <div class="container">
       <table class="table table-striped">
          <tbody>
             <tr>
                <td colspan="1">  
                   <form class="well form-horizontal">
                      <fieldset>
                        <h3><b>Time Tracker</b></h3>
                         <div class="form-group">
                            <label class="col-md-3 control-label">NAMES:</label>
                            <div class="col-md-9 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                  <select id="selectedName" class="selectpicker form-control">
                                    <option>default</option>
                                     <?php
                                        foreach($names as $name){  
                                          echo "<option value ='".$name->id."'>".$name->name."</option>";
                                        } 
                                     ?>
                                  </select>
                               </div>
                            </div>
                         </div>
                         <br>
                         <h2 id="currentTime"><b>HH:MM:SS</b></h2>
                         <br><br>
                         <div class = "row">
                           <div class= "col-md-4">
                              <button type="button" class ="btn btn-warning" id="in">Clock In</button>
                           </div>
                           <div class= "col-md-3" id="divTime">
                              <label id="getcurrentTimeIn">HH:MM:SS</label>
                           </div>
                         </div>
                         <hr>
                         <h4><b>BREAK</b></h4>
                         <div class= "row">
                            <div class= "col-md-4">
                              <button class ="btn btn-warning" type="button" id="start">START</button>
                            </div>
                            <div class= "col-md-3" id="divTime">
                              <label id="startBreak">HH:MM:SS</label>
                            </div> 
                         </div>
                         <br>
                         <div class= "row">
                            <div class= "col-md-4">
                              <button class ="btn btn-warning" type="button" onclick="end()">END</button>
                            </div>
                            <div class= "col-md-3" id="divTime">
                              <label id="endBreak">HH:MM:SS</label>
                            </div> 
                            <div class= "col-md-12">
                              <button class ="btn btn-warning" id="btntake" type="button" onclick="anotherBreak()">Take Another Break </button>
                              <br>
                            </div>
                         </div>
                         <div class = "row">
                           <div class= "col-md-4">
                              <button class ="btn btn-warning" type="button" id="out">ClockOut</button>
                           </div>
                           <div class= "col-md-3" id="divTime">
                              <label id="getcurrentTimeOut">HH:MM:SS</label>
                           </div>
                         </div>
                      </fieldset>
                   </form>
                </td>
             </tr>
          </tbody>
       </table>
    </div>
    </body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).ready(function() {
        var id = $('#selectedName').val();
        var id = parseInt(id);
        var time_id = 0;

         $('#in').click(function() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('getcurrentTimeIn').innerHTML = h + ":" + m +":"+s;
            t = setTimeout(function() {
                startTime()
              }, 500);
            
            $.post("/saveClockIn", { 
              user_id: id,
              clockIn: h + ":" + m +":"+s,
              clockOut: "default"
              }).then(response=>{
                time_id= response.id;
            });
         });
         $('#out').click(function() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('getcurrentTimeOut').innerHTML = h + ":" + m +":"+s;
            t = setTimeout(function() {
                startTime()
              }, 500);
            $.post("/saveClockOut", {
              user_id: id,
              clockOut:h + ":" + m +":"+s,
              id: time_id
            });
         });
         $('#start').click(function(){
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            // add a zero in front of numbers<10
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('startBreak').innerHTML = h + ":" + m +":"+s;
            t = setTimeout(function() {
              startTime()
            }, 500);
            $.post("/saveClockOut", {
              time_id: time_id,
              start:h + ":" + m +":"+s,
              end:"default"
              
            });
         })
    });
  function checkTime(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }


  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('currentTime').innerHTML = h + ":" + m +":"+s;
    t = setTimeout(function() {
      startTime()
    }, 500);
  }


  function end(){
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('endBreak').innerHTML = h + ":" + m +":"+s;
    t = setTimeout(function() {
      startTime()
    }, 500);
  }
  function anotherBreak(){
    document.getElementById('startBreak').innerHTML = "HH:MM:SS"; 
    document.getElementById('endBreak').innerHTML = "HH:MM:SS";
  }
  startTime();

  
</script>
